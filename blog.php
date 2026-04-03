<?php
// Category color mapping
function getCategoryColor($category) {
    $colors = [
        'Market Guide' => 'text-brand-violet',
        'Market Trends' => 'text-brand-cyan',
        'Finance & Compliance' => 'text-brand-rose',
        'Explainer' => 'text-brand-electric',
        'Insights' => 'text-brand-electric',
        'Industry News' => 'text-brand-amber',
        'Tips & Guide' => 'text-brand-emerald'
    ];
    return $colors[$category] ?? 'text-brand-electric';
}

// Try to fetch posts from database
$posts = [];
try {
    require_once 'db_config.php';
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $stmt = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($row['title'])), '-'));
        if (!empty($row['slug'])) $slug = $row['slug'];
        $posts[$slug] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'category' => $row['category'] ?? 'Insights',
            'readTime' => $row['read_time'] ?? '5 Min Read',
            'image' => $row['image_url'] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200&fm=webp',
            'excerpt' => $row['excerpt'] ?? '',
            'content' => $row['content'] ?? '',
            'author' => $row['author'] ?? 'CorpEasy Team',
            'published_at' => $row['published_at'] ?? null
        ];
    }
} catch (Exception $e) {
    // Fallback to hardcoded posts
}

// Fallback posts if DB fails or is empty
if (empty($posts)) {
    $posts = [
        'mumbai-workspace-guide' => [
            'title' => 'How to Find the Right Office Space in Mumbai: A Practical Guide for 2026.',
            'category' => 'Market Guide',
            'readTime' => '8 Min Read',
            'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200&fm=webp',
            'excerpt' => 'Finding office space in Mumbai looks straightforward on paper but becomes complicated in practice. This guide walks through what the process actually looks like.',
            'content' => ''
        ],
        'bkc-vs-goregaon' => [
            'title' => 'BKC or Goregaon? Choosing the Right Mumbai Location for Your Office.',
            'category' => 'Market Trends',
            'readTime' => '6 Min Read',
            'image' => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200&fm=webp',
            'excerpt' => 'One of the most common questions companies face when looking for office space in Mumbai: do we go to BKC for the address, or Goregaon for the value?',
            'content' => ''
        ],
        'managed-office-explainer' => [
            'title' => 'What Is a Managed Office Space and Is It Right for Your Business?',
            'category' => 'Explainer',
            'readTime' => '5 Min Read',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200&fm=webp',
            'excerpt' => 'The term managed office gets used loosely in the Indian commercial real estate market. Here is what it actually means, and what it does not.',
            'content' => ''
        ],
        'gst-office-rental' => [
            'title' => 'GST on Commercial Office Rentals in Mumbai: What You Need to Know.',
            'category' => 'Finance & Compliance',
            'readTime' => '5 Min Read',
            'image' => 'https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800',
            'excerpt' => 'GST on commercial property rentals comes up in most conversations about leasing office space in Mumbai. Understanding the basics saves confusion later.',
            'content' => ''
        ]
    ];
}

$postKeys = array_keys($posts);
$featuredKey = $postKeys[0] ?? null;
$featured = $featuredKey ? $posts[$featuredKey] : null;
$gridPosts = array_slice($posts, 1, null, true);

// Build ItemList schema for blog post collection
$itemListElements = [];
$pos = 1;
foreach ($posts as $postSlug => $p) {
    $itemListElements[] = [
        '@type' => 'ListItem',
        'position' => $pos++,
        'url' => 'https://www.corpeasy.in/blog/' . $postSlug,
        'name' => $p['title']
    ];
}

$page_id = 'blog';
$page_title = 'Managed Office Insights Mumbai | CorpEasy Blog';
$page_description = 'Expert articles on managed office space, commercial real estate, and workspace decisions in Mumbai. Written for business owners and operations teams.';
$page_canonical = 'https://www.corpeasy.in/blog';
$page_og_image = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200&fm=webp&h=630';
$page_schema = json_encode([
    '@type' => 'ItemList',
    'name' => 'CorpEasy Blog — Mumbai Office Space Insights',
    'description' => 'Practical articles on office space in Mumbai, commercial real estate, and workspace decisions.',
    'url' => 'https://www.corpeasy.in/blog',
    'itemListElement' => $itemListElements
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-6 py-24 reveal">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
<div class="max-w-2xl">
<div class="inline-flex items-center space-x-2 mb-8 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5">
<span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse"></span>
<span class="text-xs font-semibold uppercase tracking-wide text-brand-electric">Useful Reading</span>
</div>
<h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 leading-none">Mumbai <span class="text-gradient-vibrant">Office Space</span> Insights</h1>
<p class="text-xl text-slate-600 mt-8 leading-relaxed">Practical articles on office space in Mumbai, commercial real estate, and workspace decisions. Written plainly for business owners and operations teams.</p>
</div>
</div>

<?php if ($featured): ?>
<a href="/blog/<?php echo htmlspecialchars($featuredKey); ?>" class="group cursor-pointer mb-24 reveal delay-100 block">
<div class="glass-card p-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="rounded-[2rem] overflow-hidden h-[450px]">
<img fetchpriority="high" src="<?php echo htmlspecialchars($featured['image']); ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90">
</div>
<div class="p-6 lg:p-10">
<div class="flex items-center gap-4 mb-6">
<span class="px-4 py-1.5 bg-brand-electric text-white text-xs font-semibold rounded-full uppercase tracking-widest shadow-[0_0_15px_rgba(99,102,241,0.4)]">Featured Guide</span>
<span class="text-xs text-slate-600 font-bold flex items-center"><i class="far fa-clock mr-2"></i> <?php echo htmlspecialchars($featured['readTime']); ?></span>
</div>
<h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-8 leading-tight group-hover:text-brand-electric transition-colors"><?php echo htmlspecialchars($featured['title']); ?></h2>
<p class="text-lg text-slate-600 mb-10 leading-relaxed"><?php echo htmlspecialchars($featured['excerpt'] ?: substr(strip_tags($featured['content']), 0, 200)); ?>...</p>
<span class="text-sm font-black uppercase tracking-widest text-brand-electric flex items-center gap-4 group-hover:gap-6 transition-all">Read the Guide <i class="fas fa-arrow-right"></i></span>
</div>
</div>
</a>
<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
<?php $i = 0; foreach ($gridPosts as $key => $p): $delayClass = $i === 1 ? 'delay-100' : ($i === 2 ? 'delay-200' : ''); ?>
<a href="/blog/<?php echo htmlspecialchars($key); ?>" class="blog-card group cursor-pointer reveal <?php echo $delayClass; ?> block">
<div class="h-56 overflow-hidden rounded-t-[2rem]"><img loading="lazy" src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-80 group-hover:opacity-100"></div>
<div class="p-8">
<p class="text-xs font-medium <?php echo getCategoryColor($p['category']); ?> uppercase mb-3"><?php echo htmlspecialchars($p['category']); ?></p>
<h4 class="text-2xl font-bold text-slate-900 mb-4 leading-tight group-hover:text-brand-electric transition-colors"><?php echo htmlspecialchars($p['title']); ?></h4>
<p class="text-sm text-slate-600 mb-8 leading-relaxed"><?php echo htmlspecialchars($p['excerpt'] ?: substr(strip_tags($p['content']), 0, 150)); ?>...</p>
<span class="text-sm font-medium text-brand-electric flex items-center gap-2 group-hover:gap-4 transition-all">Read More <i class="fas fa-arrow-right"></i></span>
</div>
</a>
<?php $i++; endforeach; ?>
</div>
</section>

<section class="py-16 bg-white/40">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-3xl font-black text-slate-900 tracking-tight mb-4 text-center">What We Write About</h2>
<p class="text-slate-500 text-center max-w-2xl mx-auto mb-12">All articles are written for business owners, operations leads, and founders navigating commercial office decisions in Mumbai. No fluff, no generic content.</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
<div class="glass-card p-6">
<i class="fas fa-building text-brand-electric mb-4 text-xl"></i>
<h3 class="font-black text-slate-900 mb-2">Managed Office Space</h3>
<p class="text-sm text-slate-600 leading-relaxed">How managed office space works in Mumbai, who it suits, what it costs, and how it compares to coworking and traditional leases.</p>
</div>
<div class="glass-card p-6">
<i class="fas fa-map-marker-alt text-brand-cyan mb-4 text-xl"></i>
<h3 class="font-black text-slate-900 mb-2">Mumbai Micro-Markets</h3>
<p class="text-sm text-slate-600 leading-relaxed">Honest breakdowns of BKC, Lower Parel, Goregaon, Andheri, and Powai — rent levels, building quality, commute dynamics, and who each area suits.</p>
</div>
<div class="glass-card p-6">
<i class="fas fa-file-contract text-brand-violet mb-4 text-xl"></i>
<h3 class="font-black text-slate-900 mb-2">Leases and Costs</h3>
<p class="text-sm text-slate-600 leading-relaxed">What commercial leases actually say, what hidden costs to watch for, how GST applies to office rentals, and how to negotiate better terms.</p>
</div>
<div class="glass-card p-6">
<i class="fas fa-tools text-brand-gold mb-4 text-xl"></i>
<h3 class="font-black text-slate-900 mb-2">Facility Management</h3>
<p class="text-sm text-slate-600 leading-relaxed">Practical guides for managing office operations, vendor coordination, maintenance schedules, and running a productive 20–200 seat office in Mumbai.</p>
</div>
</div>
<div class="text-center">
<p class="text-slate-500 mb-6 text-sm">Looking for a managed office space in Mumbai? Start here.</p>
<div class="flex flex-wrap gap-4 justify-center">
<a href="/managed-office-space-mumbai" class="bg-brand-electric text-white px-6 py-3 rounded-lg text-sm font-semibold hover:scale-105 transition-all">Managed Office Space Mumbai</a>
<a href="/managed-office-bkc" class="glass-card px-6 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-brand-electric transition-colors">BKC</a>
<a href="/managed-office-lower-parel" class="glass-card px-6 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-brand-electric transition-colors">Lower Parel</a>
<a href="/managed-office-goregaon" class="glass-card px-6 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-brand-electric transition-colors">Goregaon</a>
<a href="/managed-office-andheri" class="glass-card px-6 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-brand-electric transition-colors">Andheri</a>
</div>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
