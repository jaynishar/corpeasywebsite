<?php
/*
 * ═══════════════════════════════════════════════════════════
 * CORPEASY — HOSTINGER DEPLOYMENT GUIDE
 * ═══════════════════════════════════════════════════════════
 * 
 * STEP 1 — DATABASE SETUP:
 *   a. Login to Hostinger hPanel → Hosting → Manage
 *   b. Go to Databases → MySQL Databases
 *   c. Create a new database and note the credentials
 *   d. Click phpMyAdmin → Select your database → SQL tab
 *   e. Paste contents of db_setup.sql and click Go
 * 
 * STEP 2 — CONFIGURE THIS FILE:
 *   a. Edit submit.php lines 48-56 with your real DB credentials
 *   b. Edit admin.php lines 10-13 with same DB credentials
 *   c. Change NOTIFICATION_EMAIL to your real email
 *   d. Change ALLOWED_ORIGIN to your real domain
 * 
 * STEP 3 — CREATE ADMIN USER:
 *   a. Upload all files to Hostinger via File Manager or FTP
 *   b. Visit: https://www.corpeasy.in/admin.php?setup=1
 *   c. Create your admin username and password
 *   d. Login at: https://www.corpeasy.in/admin.php
 * 
 * STEP 4 — SECURITY:
 *   a. Add this to your .htaccess to block direct DB file access:
 *      <Files "leads_backup.json">
 *        Order deny,allow
 *        Deny from all
 *      </Files>
 *   b. Replace GTM-XXXXXXX in index.html with real GTM ID
 * 
 * STEP 5 — HOSTINGER EMAIL:
 *   If PHP mail() doesn't work on Hostinger, go to hPanel →
 *   Email → Create an email account (e.g. no-reply@corpeasy.in)
 *   Then use Hostinger's SMTP settings in submit.php instead.
 * 
 * ═══════════════════════════════════════════════════════════
 */

// ═══════════════════════════════════════════════
// CORPEASY LEAD SUBMISSION HANDLER
// Place this file at the ROOT of your Hostinger website
// ═══════════════════════════════════════════════

// ═════════════════════════════════════════════════════════════════════
// ⚠️  EDIT THESE VALUES BEFORE DEPLOYING TO HOSTINGER  ⚠️
// ═════════════════════════════════════════════════════════════════════

// Database credentials from: hPanel → Databases → MySQL Databases
define('DB_HOST', 'localhost');                              // Usually 'localhost'
define('DB_NAME', 'u315885808_corpeasy_leads');                        // Your database name
define('DB_USER', 'u315885808_corpeasy');                   // Your DB username (u123...)
define('DB_PASS', 'C0rpeasy1');                      // Your DB password
define('DB_PORT', 3306);

// Your email for receiving lead notifications
define('NOTIFICATION_EMAIL', 'jaynishar@corpeasy.in');       // CHANGE THIS

define('SITE_NAME', 'CorpEasy');

// Your actual domain (e.g., https://corpeasy.in)
define('ALLOWED_ORIGIN', 'https://www.corpeasy.in');        // CHANGE THIS

// ── SECURITY HEADERS ────────────────────────────
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://www.corpeasy.in');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Origin: https://corpeasy.in');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// ── INPUT SANITIZATION ──────────────────────────
function sanitize(string $input): string
{
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    $data = $_POST; // fallback for form-encoded
}

$form_type = sanitize($data['form_type'] ?? 'unknown');
$full_name = sanitize($data['full_name'] ?? '');
$company_name = sanitize($data['company_name'] ?? '');
$email = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = sanitize($data['phone'] ?? '');
$requirement = sanitize($data['requirement'] ?? '');
$property_loc = sanitize($data['property_location'] ?? '');
$property_area = sanitize($data['property_area'] ?? '');
$message = sanitize($data['message'] ?? '');
$source_page = sanitize($data['source_page'] ?? '');

// Basic validation
if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Valid email required']);
    exit;
}

// ── SPAM HONEYPOT CHECK ─────────────────────────
if (!empty($data['website'])) { // hidden honeypot field
    http_response_code(200);
    echo json_encode(['success' => true]); // silent ignore
    exit;
}

// ── RATE LIMITING (simple IP-based) ─────────────
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$ip = explode(',', $ip)[0];
$rate_file = sys_get_temp_dir() . '/ce_rate_' . md5($ip) . '.json';
$now = time();
$rate_data = file_exists($rate_file) ? json_decode(file_get_contents($rate_file), true) : ['count' => 0, 'window_start' => $now];
if ($now - $rate_data['window_start'] < 3600) {
    if ($rate_data['count'] >= 5) { // max 5 submissions per hour per IP
        http_response_code(429);
        echo json_encode(['success' => false, 'error' => 'Too many requests. Please try again later.']);
        exit;
    }
    $rate_data['count']++;
} else {
    $rate_data = ['count' => 1, 'window_start' => $now];
}
file_put_contents($rate_file, json_encode($rate_data));

// ── DATABASE INSERT ──────────────────────────────
$saved_to_db = false;
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
    );

    $stmt = $pdo->prepare("
        INSERT INTO leads 
        (form_type, full_name, company_name, email, phone, requirement, 
         property_location, property_area, message, source_page, ip_address, user_agent)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $form_type,
        $full_name,
        $company_name,
        $email,
        $phone,
        $requirement,
        $property_loc,
        $property_area,
        $message,
        $source_page,
        $ip,
        $_SERVER['HTTP_USER_AGENT'] ?? ''
    ]);

    $saved_to_db = true;

} catch (PDOException $e) {
    // Log error but don't expose DB details
    error_log('CorpEasy DB Error: ' . $e->getMessage());
    // Fall through to email-only mode
}

// ── FALLBACK: SAVE TO JSON FILE if DB fails ─────
if (!$saved_to_db) {
    $fallback_file = __DIR__ . '/leads_backup.json';
    $lead_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'form_type' => $form_type,
        'name' => $full_name,
        'company' => $company_name,
        'email' => $email,
        'phone' => $phone,
        'requirement' => $requirement,
        'ip' => $ip
    ];
    $existing = file_exists($fallback_file) ? json_decode(file_get_contents($fallback_file), true) : [];
    $existing[] = $lead_entry;
    file_put_contents($fallback_file, json_encode($existing, JSON_PRETTY_PRINT));
}

// ── EMAIL NOTIFICATION ───────────────────────────
$subject = "🏢 New Lead: {$form_type} | {$company_name} — CorpEasy";
$body = "
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
NEW LEAD RECEIVED — CORPEASY
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Form Type:    {$form_type}
Time:         " . date('d M Y, h:i A') . " IST
Source Page:  {$source_page}

━━━━ CONTACT DETAILS ━━━━━━━━━━━━━━━━━━━

Name:         {$full_name}
Company:      {$company_name}
Email:        {$email}
Phone:        {$phone}
Requirement:  {$requirement}

";
if ($property_loc)
    $body .= "Property Location: {$property_loc}\n";
if ($property_area)
    $body .= "Property Area: {$property_area} sq ft\n";
if ($message)
    $body .= "Message: {$message}\n";
$body .= "
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
View all leads: https://www.corpeasy.in/admin.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
";

$headers = "From: no-reply@corpeasy.in\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

@mail(NOTIFICATION_EMAIL, $subject, $body, $headers);

// ── SEND AUTO-REPLY TO LEAD ──────────────────────
$auto_subject = "Thank you for contacting CorpEasy, {$full_name}";
$auto_body = "
Dear {$full_name},

Thank you for reaching out to CorpEasy.

We have received your enquiry and one of our enterprise workspace 
advisors will contact you within 4 business hours.

Your Enquiry Reference: CE-" . date('Ymd') . "-" . substr(md5($email . time()), 0, 6) . "

What happens next:
1. Our advisor will review your requirement
2. We will schedule a 30-minute discovery call
3. We will share a customised proposal within 24 hours

If you need immediate assistance:
📞 +91 98330 89993 (Dev Doshi)
📧 devdoshi@corpeasy.in
🏢 Office No. 30, 2nd Floor, Gopal Bhavan,
    Shamaldas Gandhi Marg, Marine Lines East,
    Mumbai, Maharashtra 400002

Best regards,
CorpEasy Enterprise Solutions
Mumbai's Premium Managed Workspace Operator
www.corpeasy.in
";

$auto_headers = "From: devdoshi@corpeasy.in\r\n";
$auto_headers .= "Reply-To: devdoshi@corpeasy.in\r\n";

@mail($email, $auto_subject, $auto_body, $auto_headers);

// ── RESPONSE ─────────────────────────────────────
echo json_encode([
    'success' => true,
    'message' => "Request received! We'll contact you within 4 business hours.",
    'reference' => 'CE-' . date('Ymd') . '-' . substr(md5($email . time()), 0, 6)
]);
?>