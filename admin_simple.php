<?php
// Super Simple Admin - Minimal Version
session_start();

$db_host = 'localhost';
$db_name = 'u315885808_corpeasy_leads';
$db_user = 'u315885808_corpeasy';
$db_pass = 'C0rpeasy1';

// LOGOUT
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_simple.php');
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
        <title>CorpEasy Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body { font-family: Arial; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
            .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 350px; }
            h1 { text-align: center; color: #333; margin-bottom: 30px; }
            input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
            button { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
            button:hover { background: #5a6fd6; }
            .error { color: red; text-align: center; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h1>CorpEasy Portal</h1>
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

// SHOW DASHBOARD
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $leads = $pdo->query("SELECT * FROM leads ORDER BY id DESC")->fetchAll();
    $total = count($leads);
} catch(PDOException $e) {
    $total = 0;
    $leads = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CorpEasy Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #667eea; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 20px; }
        .logout { background: rgba(255,255,255,0.2); color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .stats { display: flex; gap: 20px; margin-bottom: 30px; }
        .stat-box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); flex: 1; text-align: center; }
        .stat-box h2 { color: #667eea; font-size: 36px; }
        .stat-box p { color: #666; margin-top: 5px; }
        .table-box { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 12px 8px; text-align: left; font-weight: 600; color: #333; font-size: 12px; }
        td { padding: 10px 8px; border-top: 1px solid #eee; font-size: 13px; }
        tr:hover { background: #f8f9fa; cursor: pointer; }
        .badge { background: #667eea; color: white; padding: 3px 8px; border-radius: 20px; font-size: 11px; }
        .empty { text-align: center; padding: 50px; color: #666; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; }
        .modal.show { display: flex; align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 30px; border-radius: 15px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; }
        .modal h2 { margin-bottom: 20px; color: #333; }
        .modal-close { background: #667eea; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .detail-row { display: flex; padding: 10px 0; border-bottom: 1px solid #eee; }
        .detail-label { font-weight: 600; width: 150px; color: #666; }
        .detail-value { flex: 1; color: #333; }
    </style>
</head>
<body>
    <div class="header">
        <h1>CorpEasy Admin</h1>
        <a href="admin_simple.php?logout=1" class="logout">Logout</a>
    </div>
    
    <!-- Lead Detail Modal -->
    <div id="leadModal" class="modal">
        <div class="modal-content">
            <h2>Lead Details</h2>
            <div id="leadDetails"></div>
            <button class="modal-close" onclick="closeModal()">Close</button>
        </div>
    </div>
    
    <div class="container">
        <div class="stats">
            <div class="stat-box">
                <h2><?php echo $total; ?></h2>
                <p>Total Leads</p>
            </div>
        </div>
        
        <div class="table-box">
            <?php if($total > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                </tr>
                <?php foreach($leads as $lead): ?>
                <tr onclick="showLead(<?php echo htmlspecialchars(json_encode($lead)); ?>)">
                    <td>#<?php echo $lead['id']; ?></td>
                    <td><?php echo date('d M Y H:i', strtotime($lead['created_at'])); ?></td>
                    <td><?php echo htmlspecialchars($lead['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($lead['company_name']); ?></td>
                    <td><?php echo htmlspecialchars($lead['email']); ?></td>
                    <td><?php echo htmlspecialchars($lead['phone']); ?></td>
                    <td><span class="badge"><?php echo htmlspecialchars($lead['form_type']); ?></span></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php else: ?>
            <div class="empty">No leads yet</div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
    function showLead(lead) {
        let html = '';
        html += '<div class="detail-row"><div class="detail-label">ID</div><div class="detail-value">#' + lead.id + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Date</div><div class="detail-value">' + lead.created_at + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Name</div><div class="detail-value">' + (lead.full_name || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Company</div><div class="detail-value">' + (lead.company_name || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Email</div><div class="detail-value"><a href="mailto:' + lead.email + '">' + lead.email + '</a></div></div>';
        html += '<div class="detail-row"><div class="detail-label">Phone</div><div class="detail-value"><a href="tel:' + lead.phone + '">' + (lead.phone || '-') + '</a></div></div>';
        html += '<div class="detail-row"><div class="detail-label">Form Type</div><div class="detail-value"><span class="badge">' + (lead.form_type || '-') + '</span></div></div>';
        html += '<div class="detail-row"><div class="detail-label">Requirement</div><div class="detail-value">' + (lead.requirement || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Property Location</div><div class="detail-value">' + (lead.property_location || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Property Area</div><div class="detail-value">' + (lead.property_area || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Message</div><div class="detail-value">' + (lead.message || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">Source Page</div><div class="detail-value">' + (lead.source_page || '-') + '</div></div>';
        html += '<div class="detail-row"><div class="detail-label">IP Address</div><div class="detail-value">' + (lead.ip_address || '-') + '</div></div>';
        document.getElementById('leadDetails').innerHTML = html;
        document.getElementById('leadModal').classList.add('show');
    }
    
    function closeModal() {
        document.getElementById('leadModal').classList.remove('show');
    }
    
    document.getElementById('leadModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    </script>
</body>
</html>
