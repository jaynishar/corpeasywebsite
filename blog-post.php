<?php
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// Try to fetch post from database
$post = null;
try {
    require_once 'db_config.php';
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Try by slug column first, then by generated slug from title
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = :slug AND status = 'published' LIMIT 1");
    $stmt->execute(['slug' => $slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // Fallback: fetch all and match by generated slug
        $stmt = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published'");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $generatedSlug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($r['title'])), '-'));
            if ($generatedSlug === $slug) {
                $row = $r;
                break;
            }
        }
    }

    if ($row) {
        $post = [
            'title' => $row['title'],
            'category' => $row['category'] ?? 'Insights',
            'readTime' => $row['read_time'] ?? '5 Min Read',
            'image' => $row['image_url'] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
            'excerpt' => $row['excerpt'] ?? '',
            'content' => $row['content'] ?? '',
            'author' => $row['author'] ?? 'CorpEasy Team',
            'published_at' => $row['published_at'] ?? null
        ];
    }
} catch (Exception $e) {
    // DB failed, fall through to hardcoded
}

// Fallback to hardcoded posts
if (!$post) {
    $fallbackPosts = [
        'mumbai-workspace-guide' => [
            'title' => 'How to Find the Right Office Space in Mumbai: A Practical Guide for 2026.',
            'category' => 'Market Guide',
            'readTime' => '6 Min Read',
            'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
            'content' => '<p>Finding <strong>office space in Mumbai</strong> looks straightforward on paper but becomes complicated in practice. Between understanding micro-market rent differences, negotiating lease terms, coordinating furniture and IT setup, and managing multiple vendors, most companies spend far more time on it than they budgeted for. This guide walks through what the process actually looks like, and where things go wrong.</p> <h3>Start With the Right Micro-Market</h3> <p>Mumbai\'s commercial office market is not one market. It is several, each with its own rent levels, building quality, commute dynamics, and tenant profile. BKC commands the highest rents at roughly &#8377;450 to &#8377;750 per sq ft per month for Grade A space. Lower Parel and Worli sit in the &#8377;250 to &#8377;450 range with strong Western Railway access. Goregaon East, particularly around Nirlon Knowledge Park, suits tech and mid-size companies at &#8377;150 to &#8377;300. Andheri East offers airport proximity at &#8377;150 to &#8377;400. Powai is ideal for campus-style spaces at &#8377;115 to &#8377;310.</p> <p>The right location depends on where your team commutes from, whether clients visit your office, and your realistic monthly cost tolerance. Getting this wrong creates expensive problems downstream.</p> <h3>What Office Space in Mumbai Actually Costs</h3> <p>The headline rent is rarely the full cost. On top of base rent, budget for a security deposit of three to six months\' rent paid upfront, a maintenance charge of &#8377;15 to &#8377;30 per sq ft per month on top of rent, GST at 18% (claimable as ITC for most registered businesses), parking, and the workspace setup itself. If you take a bare shell and do your own fit-out, you can add &#8377;800 to &#8377;2,000 per sq ft and three to six months of setup time.</p> <h3>Why the Managed Office Model Is Growing</h3> <p>The managed office model exists because the traditional route is genuinely time-consuming. When a company takes a managed workspace, they are not dealing with the landlord, the furniture vendor, and the IT contractor as separate parties. They deal with one operator, pay one monthly fee, and move in to a workspace that is ready from Day 1.</p>'
        ],
        'bkc-vs-goregaon' => [
            'title' => 'BKC or Goregaon? Choosing the Right Mumbai Location for Your Office.',
            'category' => 'Market Trends',
            'readTime' => '5 Min Read',
            'image' => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200',
            'content' => '<p>One of the most common questions companies face when looking for <strong>office space in Mumbai</strong>: do we go to BKC for the address, or Goregaon for the value? Both are legitimate choices. The right answer depends on what actually matters for your business.</p> <h3>The Case for BKC</h3> <p>Bandra Kurla Complex is Mumbai\'s most recognised commercial address. It is home to major banks, global financial institutions, and professional services firms. If clients visit your office and an address shapes their perception of you, BKC is worth the premium. Metro Line 3 has improved access considerably, though road congestion during peak hours is a real issue for daily commuters. Rents currently run &#8377;450 to &#8377;750 per sq ft per month for Grade A space.</p> <h3>The Case for Goregaon</h3> <p>Goregaon East, particularly the Nirlon Knowledge Park and NESCO cluster, has matured significantly. It attracts tech companies, media businesses, and mid-size enterprises that need larger floor plates at prices that make operational sense. Rents typically sit at &#8377;150 to &#8377;300 per sq ft. This is a meaningful saving against BKC for equivalent building quality. Western Express Highway and Metro Line 2A provide solid western suburbs connectivity.</p>'
        ],
        'managed-office-explainer' => [
            'title' => 'What Is a Managed Office Space and Is It Right for Your Business?',
            'category' => 'Explainer',
            'readTime' => '4 Min Read',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200',
            'content' => '<p>The term "managed office" gets used loosely in the Indian commercial real estate market. Here is what it actually means, and what it does not.</p> <h3>What a Managed Office Actually Is</h3> <p>A <strong>managed office space</strong> is a commercially leased workspace that has been sourced, set up, and is maintained on your behalf by a workspace operator. Instead of you finding the property, negotiating with the landlord, coordinating workspace setup, and managing facility issues, all of that is handled by the operator. You pay a single monthly fee per seat and get a space that is ready to work in from Day 1. The key distinction from coworking is exclusivity: in a coworking space, you share with other companies. In a managed office, the space is yours alone.</p>'
        ],
        'gst-office-rental' => [
            'title' => 'GST on Commercial Office Rentals in Mumbai: What You Need to Know.',
            'category' => 'Finance & Compliance',
            'readTime' => '4 Min Read',
            'image' => 'https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800',
            'content' => '<p>GST on commercial property rentals comes up in most conversations about leasing <strong>office space in Mumbai</strong>. Understanding the basics saves confusion later in the process.</p> <h3>The Basics</h3> <p>Commercial office rentals in India attract GST at 18%. This is charged on top of your base rent. If your company is GST-registered and uses the office for business purposes, you are generally eligible to claim Input Tax Credit on the GST paid. This means it offsets your outward GST liability rather than being a pure additional cost. For most registered businesses, the effective net GST burden is significantly lower than the headline 18%.</p>'
        ]
    ];

    $post = $fallbackPosts[$slug] ?? null;
}

// 404 if post not found
if (!$post) {
    http_response_code(404);
    $page_id = '404';
    $page_title = 'Post Not Found | CorpEasy Blog';
    $page_description = 'The blog post you are looking for could not be found.';
    $page_canonical = 'https://www.corpeasy.in/blog';
    include 'templates/header.php';
    echo '<section class="max-w-4xl mx-auto px-6 py-24 text-center"><h1 class="text-5xl font-black text-slate-900 mb-6">Post Not Found</h1><p class="text-xl text-slate-600 mb-10">The article you are looking for does not exist or has been removed.</p><a href="/blog" class="bg-brand-electric text-white px-10 py-5 rounded-lg font-medium text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:scale-105 transition-all inline-block">Back to Blog</a></section>';
    include 'templates/footer.php';
    exit;
}

// Dynamic SEO
$page_id = 'blog-post';
$page_title = htmlspecialchars($post['title']) . ' | CorpEasy Blog';
$page_description = substr(strip_tags($post['content']), 0, 160);
$page_canonical = 'https://www.corpeasy.in/blog/' . htmlspecialchars($slug);

// Article schema
$page_schema = json_encode([
    '@type' => 'Article',
    'headline' => $post['title'],
    'datePublished' => $post['published_at'] ?? '2026-03-01',
    'author' => [
        '@type' => 'Organization',
        'name' => 'CorpEasy'
    ],
    'publisher' => [
        '@id' => 'https://www.corpeasy.in/#organization'
    ],
    'image' => $post['image'],
    'url' => 'https://www.corpeasy.in/blog/' . $slug
], JSON_UNESCAPED_SLASHES);

include 'templates/header.php';
?>

<section class="max-w-4xl mx-auto px-6 py-12 lg:py-24">
    <a href="/blog" class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-electric transition-colors mb-12">
        <i class="fas fa-arrow-left"></i> Back to Insights
    </a>
    <div class="mb-12">
        <span class="px-4 py-1.5 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-xs font-medium rounded-full mb-6 inline-block"><?php echo htmlspecialchars($post['category']); ?></span>
        <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 mb-8 leading-tight"><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="flex items-center gap-6 text-slate-600 text-sm font-medium">
            <span><i class="far fa-clock mr-2 text-brand-electric"></i> <?php echo htmlspecialchars($post['readTime']); ?></span>
            <span><i class="far fa-calendar-alt mr-2 text-brand-electric"></i> <?php echo $post['published_at'] ? date('Y', strtotime($post['published_at'])) : '2026'; ?></span>
            <span><i class="far fa-user mr-2 text-brand-electric"></i> <?php echo htmlspecialchars($post['author'] ?? 'CorpEasy'); ?></span>
        </div>
    </div>
    <div class="rounded-[3rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.1)] h-[400px] lg:h-[550px] mb-16 border border-white/80">
        <img loading="lazy" src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-full object-cover">
    </div>
    <div class="prose-content"><?php echo $post['content']; ?></div>
    <div class="mt-24 pt-16 border-t border-white/80 flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <h4 class="text-xl font-bold text-slate-900 mb-4">Share this article</h4>
            <div class="flex gap-4">
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://www.corpeasy.in/blog/' . $slug); ?>" target="_blank" rel="noopener" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-linkedin-in text-lg"></i></a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://www.corpeasy.in/blog/' . $slug); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-twitter text-lg"></i></a>
                <a href="#" onclick="navigator.clipboard.writeText(window.location.href);return false;" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fas fa-link text-lg"></i></a>
            </div>
        </div>
        <a href="/contact" class="bg-brand-electric text-white px-10 py-5 rounded-lg font-medium text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:scale-105 transition-all inline-block">Talk to Us About Your Requirement</a>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
