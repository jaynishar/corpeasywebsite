<?php
header('Content-Type: application/json');

$db_host = 'localhost';
$db_name = 'u315885808_corpeasy_leads';
$db_user = 'u315885808_corpeasy';
$db_pass = 'C0rpeasy1';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $posts = $pdo->query("SELECT id, title, excerpt, content, image_url, author, category, published_at FROM blog_posts ORDER BY published_at DESC LIMIT 20")->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'posts' => $posts]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
