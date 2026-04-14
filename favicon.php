<?php
/**
 * CorpEasy — PNG Favicon Generator (run once to create static favicon files)
 * Access: https://www.corpeasy.in/favicon.php?generate
 * This creates favicon-192.png and favicon-48.png in the web root
 */

if (!isset($_GET['generate'])) {
    // Normal favicon serve mode
    header('Content-Type: image/png');
    header('Cache-Control: public, max-age=604800');
    $file = __DIR__ . '/favicon-192.png';
    if (file_exists($file)) {
        readfile($file);
    }
    exit;
}

// --- Generation mode: ?generate ---
if (!function_exists('imagecreatetruecolor')) {
    die('GD library not available. Upload favicon-192.png and favicon-48.png manually.');
}

function makeFavicon($size) {
    $img = imagecreatetruecolor($size, $size);
    imagealphablending($img, false);
    imagesavealpha($img, true);

    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $transparent);
    imagealphablending($img, true);

    // Navy background with rounded corners
    $navy = imagecolorallocate($img, 30, 58, 138);   // #1e3a8a
    $white = imagecolorallocate($img, 255, 255, 255);
    $cyan  = imagecolorallocate($img, 6, 182, 212);  // #06b6d4

    $r = intval($size * 0.18); // corner radius ~18% of size

    // Draw rounded rectangle
    imagefilledrectangle($img, $r, 0, $size - $r, $size, $navy);
    imagefilledrectangle($img, 0, $r, $size, $size - $r, $navy);
    imagefilledellipse($img, $r, $r, $r * 2, $r * 2, $navy);
    imagefilledellipse($img, $size - $r, $r, $r * 2, $r * 2, $navy);
    imagefilledellipse($img, $r, $size - $r, $r * 2, $r * 2, $navy);
    imagefilledellipse($img, $size - $r, $size - $r, $r * 2, $r * 2, $navy);

    // "CE" text — centered, white, bold look via multi-draw offset
    $font   = 5; // largest built-in GD font: 9×15px
    $fontW  = imagefontwidth($font);
    $fontH  = imagefontheight($font);
    $text   = 'CE';
    $scale  = max(1, intval($size / 48)); // scale based on icon size

    $textW  = strlen($text) * $fontW;
    $startX = intval(($size - $textW * $scale) / 2);
    $startY = intval($size * 0.25);

    // Bold simulation: draw at slight offsets
    for ($ox = 0; $ox <= $scale; $ox++) {
        for ($oy = 0; $oy <= $scale; $oy++) {
            imagestring($img, $font, $startX + $ox, $startY + $oy, $text, $white);
        }
    }

    // "corpeasy" small text below (only for 192px+)
    if ($size >= 96) {
        $subFont = 1;
        $sub     = 'corpeasy';
        $subW    = strlen($sub) * imagefontwidth($subFont);
        $subX    = intval(($size - $subW) / 2);
        $subY    = intval($size * 0.65);
        imagestring($img, $subFont, $subX, $subY, $sub, $cyan);
    }

    return $img;
}

$sizes = [192, 48];
$results = [];

foreach ($sizes as $size) {
    $img  = makeFavicon($size);
    $path = __DIR__ . "/favicon-{$size}.png";
    if (imagepng($img, $path)) {
        $results[] = "✅ Created: favicon-{$size}.png";
    } else {
        $results[] = "❌ Failed: favicon-{$size}.png (check folder permissions)";
    }
    imagedestroy($img);
}

// Also copy 192 as the standard favicon.png
if (file_exists(__DIR__ . '/favicon-192.png')) {
    copy(__DIR__ . '/favicon-192.png', __DIR__ . '/favicon.png');
    $results[] = "✅ Created: favicon.png (copy of 192px)";
}

header('Content-Type: text/plain');
echo implode("\n", $results);
echo "\n\nDone. You can now remove ?generate from the URL.";
?>
