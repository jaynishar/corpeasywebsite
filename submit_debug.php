<?php
// Debug submit.php - shows what's happening
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Simple test response
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'ok',
        'message' => 'submit.php is working!',
        'post_expected' => true
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'POST only']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

echo json_encode([
    'success' => true,
    'message' => 'Form received!',
    'received_data' => $data
]);
?>
