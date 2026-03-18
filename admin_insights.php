<?php
session_start();

$db_host = 'localhost';
$db_name = 'u315885808_corpeasy_leads';
$db_user = 'u315885808_corpeasy';
$db_pass = 'C0rpeasy1';

// LOGOUT
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_insights.php');
    exit;
}

// LOGIN
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch();
        
        if($user && password_verify($_POST['password'], $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $user['username'];
        } else {
            $error = "Invalid username or password";
        }
    } catch(PDOException $e) {
        $error = "Database error";
    }
}

// SHOW LOGIN FORM
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>CorpEasy Insights Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body { font-family: Arial; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
            .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 350px; }
            h1 { text-align: center; color: #333; margin-bottom: 30px; }
            input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
            button { width: 100%; padding: 12px; background: #1e3a8a; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
            button:hover { background: #1e40af; }
            .error { color: red; text-align: center; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h1>CorpEasy Insights</h1>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// HANDLE FORM SUBMISSIONS
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    
    // CREATE
    if(isset($_POST['create_post'])) {
        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, excerpt, content, image_url, category, published_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['title'],
            $_POST['excerpt'],
            $_POST['content'],
            $_POST['image_url'],
            $_POST['category'],
            $_POST['published_at'] ?: date('Y-m-d H:i:s')
        ]);
        $message = "Post created successfully!";
    }
    
    // UPDATE
    if(isset($_POST['update_post'])) {
        $stmt = $pdo->prepare("UPDATE blog_posts SET title = ?, excerpt = ?, content = ?, image_url = ?, category = ?, published_at = ? WHERE id = ?");
        $stmt->execute([
            $_POST['title'],
            $_POST['excerpt'],
            $_POST['content'],
            $_POST['image_url'],
            $_POST['category'],
            $_POST['published_at'],
            $_POST['id']
        ]);
        $message = "Post updated successfully!";
    }
    
    // DELETE
    if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $pdo->prepare("DELETE FROM blog_posts WHERE id = ?")->execute([$_GET['delete']]);
        $message = "Post deleted successfully!";
    }
    
    // FETCH POSTS
    $posts = $pdo->query("SELECT * FROM blog_posts ORDER BY published_at DESC")->fetchAll();
    
    // FETCH SINGLE POST FOR EDIT
    $edit_post = null;
    if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
        $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
        $stmt->execute([$_GET['edit']]);
        $edit_post = $stmt->fetch();
    }
    
} catch(PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CorpEasy Insights Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #1e3a8a; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 20px; }
        .header-links { display: flex; gap: 15px; }
        .header-links a { color: white; text-decoration: none; padding: 8px 15px; background: rgba(255,255,255,0.1); border-radius: 5px; }
        .header-links a:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        .message { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .card { background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card h2 { margin-bottom: 20px; color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 10px; }
        .post-list { max-height: 600px; overflow-y: auto; }
        .post-item { padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .post-item:hover { background: #f8f9fa; }
        .post-item:last-child { border-bottom: none; }
        .post-info h4 { color: #333; margin-bottom: 5px; }
        .post-info span { font-size: 12px; color: #666; }
        .post-actions { display: flex; gap: 10px; }
        .btn { padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 13px; }
        .btn-edit { background: #1e3a8a; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-new { background: #28a745; color: white; padding: 12px 20px; display: inline-block; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #333; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .btn-submit { background: #1e3a8a; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .btn-cancel { background: #6c757d; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; text-decoration: none; }
        .empty { text-align: center; padding: 40px; color: #666; }
        .help-text { font-size: 12px; color: #666; margin-top: 3px; }
        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CorpEasy Insights Manager</h1>
        <div class="header-links">
            <a href="admin_simple.php">View Leads</a>
            <a href="admin_insights.php?logout=1">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        
        <a href="admin_insights.php" class="btn-new">+ New Post</a>
        
        <div class="grid">
            <!-- Post List -->
            <div class="card">
                <h2>All Posts (<?php echo count($posts); ?>)</h2>
                <?php if(count($posts) > 0): ?>
                <div class="post-list">
                    <?php foreach($posts as $post): ?>
                    <div class="post-item">
                        <div class="post-info">
                            <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                            <span><?php echo date('d M Y', strtotime($post['published_at'])); ?> • <?php echo htmlspecialchars($post['category']); ?></span>
                        </div>
                        <div class="post-actions">
                            <a href="admin_insights.php?edit=<?php echo $post['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="admin_insights.php?delete=<?php echo $post['id']; ?>" class="btn btn-delete" onclick="return confirm('Delete this post?')">Delete</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty">No posts yet. Create your first post!</div>
                <?php endif; ?>
            </div>
            
            <!-- Create/Edit Form -->
            <div class="card">
                <h2><?php echo $edit_post ? 'Edit Post' : 'Create New Post'; ?></h2>
                <form method="post">
                    <?php if($edit_post): ?>
                    <input type="hidden" name="update_post" value="1">
                    <input type="hidden" name="id" value="<?php echo $edit_post['id']; ?>">
                    <?php else: ?>
                    <input type="hidden" name="create_post" value="1">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label>Title *</label>
                        <input type="text" name="title" value="<?php echo $edit_post['title'] ?? ''; ?>" required placeholder="e.g., The 2026 Mumbai GCC Outlook">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category">
                                <option value="Insights" <?php echo (($edit_post['category'] ?? '') == 'Insights' ? 'selected' : ''); ?>>Insights</option>
                                <option value="Market Report" <?php echo (($edit_post['category'] ?? '') == 'Market Report' ? 'selected' : ''); ?>>Market Report</option>
                                <option value="Industry News" <?php echo (($edit_post['category'] ?? '') == 'Industry News' ? 'selected' : ''); ?>>Industry News</option>
                                <option value="Tips & Guide" <?php echo (($edit_post['category'] ?? '') == 'Tips & Guide' ? 'selected' : ''); ?>>Tips & Guide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Publish Date</label>
                            <input type="datetime-local" name="published_at" value="<?php echo $edit_post ? date('Y-m-d\TH:i', strtotime($edit_post['published_at'])) : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Image URL</label>
                        <input type="url" name="image_url" value="<?php echo $edit_post['image_url'] ?? ''; ?>" placeholder="https://images.unsplash.com/...">
                        <p class="help-text">Use Unsplash URLs: images.unsplash.com/photo-{id}?auto=format&fit=crop&q=80&w=1200</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Excerpt (Short Summary)</label>
                        <textarea name="excerpt" placeholder="Brief summary shown in cards..."><?php echo $edit_post['excerpt'] ?? ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Full Content (HTML allowed)</label>
                        <textarea name="content" style="min-height: 250px;" placeholder="<p>Full article content here...</p>"><?php echo $edit_post['content'] ?? ''; ?></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <button type="submit" class="btn-submit"><?php echo $edit_post ? 'Update Post' : 'Create Post'; ?></button>
                        <?php if($edit_post): ?>
                        <a href="admin_insights.php" class="btn-cancel">Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
