<?php
/**
 * PHP Built-in Server Router
 * Mimics .htaccess rules for local development (php -S localhost:8000 router.php)
 * Production still uses .htaccess on Apache; this file is dev-only.
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly (CSS, JS, images, etc.)
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

$clean = rtrim($uri, '/');
if ($clean === '') $clean = '/';

// Direct route map (matches .htaccess)
$routes = [
    '/'                                    => '/index.php',
    '/insights'                            => '/insights.php',
    '/insights/mumbai-workspace-guide'     => '/mumbai-workspace-guide.php',
    '/insights/bkc-vs-goregaon'            => '/bkc-vs-goregaon.php',
    '/insights/managed-office-explainer'   => '/managed-office-explainer.php',
    '/insights/gst-office-rental'          => '/gst-office-rental.php',
    '/managed-office-vs-coworking'         => '/managed-office-vs-coworking.php',
    '/what-is-a-managed-office'            => '/what-is-a-managed-office.php',
    '/office-space-cost-mumbai-2026'       => '/office-space-cost-mumbai-2026.php',
    '/managed-office-powai'                => '/managed-office-powai.php',
    '/managed-office-navi-mumbai'          => '/managed-office-navi-mumbai.php',
    '/managed-office-thane'                => '/managed-office-thane.php',
    '/about'                               => '/about.php',
    '/contact'                             => '/contact.php',
    '/faq'                                 => '/faq.php',
    '/submit'                              => '/submit.php',
    '/list-commercial-property-mumbai'     => '/list-commercial-property-mumbai.php',
    '/office-space-for-rent-mumbai'        => '/office-space-for-rent-mumbai.php',
    '/facility-management-mumbai'          => '/facility-management-mumbai.php',
    '/managed-office-space-mumbai'         => '/managed-office-space-mumbai.php',
    '/managed-office-bkc'                  => '/managed-office-bkc.php',
    '/managed-office-lower-parel'          => '/managed-office-lower-parel.php',
    '/managed-office-goregaon'             => '/managed-office-goregaon.php',
    '/managed-office-andheri'              => '/managed-office-andheri.php',
    '/office-for-rent-bkc'                 => '/office-for-rent-bkc.php',
    '/office-for-rent-lower-parel'         => '/office-for-rent-lower-parel.php',
    '/privacy-policy'                      => '/privacy-policy.php',
    '/blog'                                => '/insights.php',
];

if (isset($routes[$clean])) {
    $target = __DIR__ . $routes[$clean];
    if (file_exists($target)) { require $target; return true; }
}

// Dynamic insights slug → blog-post.php
if (preg_match('#^/insights/([^/]+)$#', $clean, $m)) {
    $_GET['slug'] = $m[1];
    require __DIR__ . '/blog-post.php';
    return true;
}

// Fallback: if the .php file exists at root, serve it
$asPhp = __DIR__ . $clean . '.php';
if (file_exists($asPhp)) { require $asPhp; return true; }

// 404
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) require __DIR__ . '/404.php';
return true;
