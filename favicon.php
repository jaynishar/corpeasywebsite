<?php
// Serve the static PNG favicon (192px), used as fallback if web server doesn't serve .png directly
header('Content-Type: image/png');
header('Cache-Control: public, max-age=604800'); // 7 days
readfile(__DIR__ . '/favicon-192.png');
