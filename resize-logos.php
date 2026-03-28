<?php
// One-time script to resize oversized logo images — DELETE AFTER USE
$secret = 'corpeasy-resize-2026';
if (!isset($_GET['token']) || $_GET['token'] !== $secret) {
    http_response_code(403);
    die('Forbidden');
}

function resizeWebP($src, $dst, $maxW, $maxH, $quality = 85) {
    if (!file_exists($src)) return "Source not found: $src";
    $info = getimagesize($src);
    if (!$info) return "Cannot read image: $src";
    $origW = $info[0];
    $origH = $info[1];
    $ratio = min($maxW / $origW, $maxH / $origH);
    $newW = (int)round($origW * $ratio);
    $newH = (int)round($origH * $ratio);

    $mime = $info['mime'];
    if ($mime === 'image/webp') {
        $img = imagecreatefromwebp($src);
    } elseif ($mime === 'image/png') {
        $img = imagecreatefrompng($src);
    } else {
        return "Unsupported format: $mime";
    }

    $resized = imagecreatetruecolor($newW, $newH);
    imagealphablending($resized, false);
    imagesavealpha($resized, true);
    imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

    // Save WebP
    $webpDst = preg_replace('/\.(webp|png)$/i', '-sm.webp', $dst);
    imagewebp($resized, $webpDst, $quality);
    $webpSize = filesize($webpDst);

    // Save PNG
    $pngDst = preg_replace('/\.(webp|png)$/i', '-sm.png', $dst);
    imagepng($resized, $pngDst, 9);
    $pngSize = filesize($pngDst);

    imagedestroy($img);
    imagedestroy($resized);

    return "OK: {$origW}x{$origH} → {$newW}x{$newH} | WebP: " . round($webpSize/1024, 1) . "KB | PNG: " . round($pngSize/1024, 1) . "KB";
}

echo "<h3>Resizing logos...</h3>";

// Header: max display 200x80 @ 2x retina = 400x160
echo "<p>Header: " . resizeWebP('CORPEASYHEADER.webp', 'CORPEASYHEADER.webp', 400, 225) . "</p>";
echo "<p>Header PNG: " . resizeWebP('CORPEASYHEADER.png', 'CORPEASYHEADER.png', 400, 225) . "</p>";

// Footer: max display 220x176 @ 2x retina = 440x352
echo "<p>Footer: " . resizeWebP('CORPEASYFOOTER.webp', 'CORPEASYFOOTER.webp', 440, 352) . "</p>";
echo "<p>Footer PNG: " . resizeWebP('CORPEASYFOOTER.png', 'CORPEASYFOOTER.png', 440, 352) . "</p>";

echo "<p><strong>Done. Now update HTML to use -sm.webp/-sm.png files, then delete this script.</strong></p>";
