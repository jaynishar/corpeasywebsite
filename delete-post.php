<?php
// One-time script — DELETE AFTER USE
$secret = 'corpeasy-delete-2026';
if (!isset($_GET['token']) || $_GET['token'] !== $secret) {
    http_response_code(403);
    die('Forbidden');
}

require_once 'db_config.php';
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Find matching post first
    $stmt = $pdo->prepare("SELECT id, title, slug FROM blog_posts WHERE title LIKE :title OR slug LIKE :slug");
    $stmt->execute(['title' => '%Beyond Four Walls%', 'slug' => '%beyond-four-walls%']);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        echo '<p>No matching post found in the database. Already clean.</p>';
    } else {
        foreach ($rows as $row) {
            $del = $pdo->prepare("DELETE FROM blog_posts WHERE id = :id");
            $del->execute(['id' => $row['id']]);
            echo '<p>Deleted: ID=' . $row['id'] . ' | "' . htmlspecialchars($row['title']) . '"</p>';
        }
        echo '<p><strong>Done. Now delete this file from your server.</strong></p>';
    }
} catch (Exception $e) {
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
