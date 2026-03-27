<?php
$page_id = 'blog';
$page_title = 'Commercial Real Estate Insights Mumbai | CorpEasy Blog';
$page_description = 'Practical articles on office space in Mumbai, commercial real estate, and workspace decisions. Written for business owners and operations teams.';
$page_canonical = 'https://www.corpeasy.in/blog';

include 'templates/header.php';

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
            'image' => $row['image_url'] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
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
        'beyond-four-walls-how-managed-workspaces-power-business-growth' => [
            'title' => 'Beyond Four Walls: How Managed Workspaces Power Business Growth',
            'category' => 'Insights',
            'readTime' => '5 Min Read',
            'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200',
            'excerpt' => 'For growing businesses in Mumbai, the workspace has become a direct lever for talent attraction, operational efficiency, and client perception.',
            'content' => ''
        ],
        'mumbai-workspace-guide' => [
            'title' => 'How to Find the Right Office Space in Mumbai: A Practical Guide for 2026.',
            'category' => 'Market Guide',
            'readTime' => '6 Min Read',
            'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
            'excerpt' => 'Finding office space in Mumbai looks straightforward on paper but becomes complicated in practice. This guide walks through what the process actually looks like.',
            'content' => ''
        ],
        'bkc-vs-goregaon' => [
            'title' => 'BKC or Goregaon? Choosing the Right Mumbai Location for Your Office.',
            'category' => 'Market Trends',
            'readTime' => '5 Min Read',
            'image' => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200',
            'excerpt' => 'One of the most common questions companies face when looking for office space in Mumbai: do we go to BKC for the address, or Goregaon for the value?',
            'content' => ''
        ],
        'managed-office-explainer' => [
            'title' => 'What Is a Managed Office Space and Is It Right for Your Business?',
            'category' => 'Explainer',
            'readTime' => '4 Min Read',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200',
            'excerpt' => 'The term managed office gets used loosely in the Indian commercial real estate market. Here is what it actually means, and what it does not.',
            'content' => ''
        ],
        'gst-office-rental' => [
            'title' => 'GST on Commercial Office Rentals in Mumbai: What You Need to Know.',
            'category' => 'Finance & Compliance',
            'readTime' => '4 Min Read',
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
?>

<section class="max-w-7xl mx-auto px-6 py-24 reveal">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
<div class="max-w-2xl">
<div class="inline-flex items-center space-x-2 mb-8 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
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
<img loading="lazy" src="<?php echo htmlspecialchars($featured['image']); ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90">
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

<?php include 'templates/footer.php'; ?>
