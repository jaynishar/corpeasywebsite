<?php
$page_id = 'about';
$page_title = 'About CorpEasy | Managed Office Space Experts Mumbai';
$page_description = 'CorpEasy is Mumbai\'s managed office space company, founded by Dev Doshi. We find, set up, and manage office space for growing businesses.';
$page_keywords = 'about CorpEasy, CorpEasy Mumbai, workspace solutions company Mumbai, managed office company Mumbai, office space solutions Mumbai, Dev Doshi CorpEasy, commercial real estate Mumbai startup';
$page_canonical = 'https://www.corpeasy.in/about';
$page_og_image = 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200&fm=webp&h=630';
$page_schema = implode(',', array_map(fn($s) => json_encode($s, JSON_UNESCAPED_SLASHES), [
  [
    "@type" => "AboutPage",
    "name" => "About CorpEasy",
    "url" => "https://www.corpeasy.in/about",
    "description" => "CorpEasy is a Mumbai-based workspace solutions company founded in October 2025.",
    "about" => ["@id" => "https://www.corpeasy.in/#organization"]
  ],
  [
    "@type" => "Person",
    "@id" => "https://www.corpeasy.in/#dev-doshi",
    "name" => "Dev Doshi",
    "jobTitle" => "Founder, Business Development & Strategy",
    "worksFor" => ["@id" => "https://www.corpeasy.in/#organization"],
    "url" => "https://www.corpeasy.in/about"
  ]
]));

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24 lg:py-32 text-center reveal relative">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] bg-brand-blue opacity-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
<div class="relative z-10">
<span class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.3em] sm:tracking-[0.4em] text-brand-electric mb-4 sm:mb-6 block text-center">Our Story</span>
<h1 class="text-4xl sm:text-5xl lg:text-7xl xl:text-8xl text-slate-900 font-black mb-8 sm:mb-12 text-center leading-[0.95]">Making <span class="text-gradient-vibrant">Office Space</span> Simple.</h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 text-center max-w-3xl mx-auto leading-relaxed mb-4 sm:mb-6 font-medium">CorpEasy is a Mumbai based workspace solutions company, founded in October 2025. We are a young, asset-light startup with a straightforward mission: to make the process of finding, setting up, and occupying commercial office space in Mumbai genuinely easier for businesses of all sizes.</p>
<p class="text-sm sm:text-base lg:text-lg text-slate-500 text-center max-w-2xl mx-auto leading-relaxed mb-12 sm:mb-20">We are building something better, one client at a time.</p>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-12 text-center">
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-electric/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-electric transition-colors">Mumbai</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Focus Market</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-cyan/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-cyan transition-colors">3</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Services</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-violet/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-violet transition-colors">24 Hr</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Response</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-rose/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-rose transition-colors">2025</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Founded</p></div>
</div>
<div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] lg:h-[500px] mt-24 reveal group">
<picture>
    <source srcset="/professional_team.webp" type="image/webp">
    <img src="/professional_team.png" alt="Dev Doshi, founder of CorpEasy, in a modern Mumbai office" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1200" height="500">
</picture>
<div class="absolute inset-0 bg-brand-electric/10 mix-blend-multiply"></div>
</div>
<div class="mt-32 text-center">
<h2 class="text-4xl font-black text-slate-900 mb-4">Our Founder</h2>
<p class="text-slate-500 max-w-2xl mx-auto mb-16 uppercase tracking-[0.2em] font-bold text-xs">Direct accountability. No layers. No friction.</p>
<div class="max-w-xl mx-auto">
<div class="bg-white rounded-[24px] p-6 shadow-xl border border-slate-100 overflow-visible group transition-all duration-500 hover:shadow-2xl">
<div class="w-full flex items-center justify-center bg-white rounded-[16px] p-4 overflow-visible mb-8">
<img src="/dev-doshi.jpg?v=3" alt="Dev Doshi Founder CorpEasy" class="w-full h-auto max-h-[420px] object-contain object-top rounded-[12px] block grayscale-[50%] group-hover:grayscale-0 transition-all duration-500" loading="lazy">
</div>
<h3 class="text-2xl font-black text-slate-900 mb-2">Dev Doshi</h3>
<p class="text-brand-electric text-xs font-semibold uppercase mb-4">Founder: Business Development & Strategy</p>
<p class="text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-6">Dev brings experience in partnerships, business development, and building relationships across sectors. He leads CorpEasy's client facing work and strategic direction.</p>
</div>
</div>
</div>
<div class="mt-32 max-w-4xl mx-auto text-left">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 mb-16">Our Journey.</h2>
<div class="relative">
<div class="relative pl-16 mb-8">
<div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
<div class="absolute left-[7px] top-4 w-0.5 bg-gradient-to-b from-brand-electric to-brand-cyan h-full z-0"></div>
<h3 class="text-gradient-vibrant text-2xl font-black mb-2">October 2025</h3>
<div class="glass-card p-6 reveal">CorpEasy founded in Mumbai. We started with a simple belief: finding and setting up office space in this city should not be this complicated. That belief has not changed.</div>
</div>
<div class="relative pl-16">
<div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
<h3 class="text-gradient-vibrant text-2xl font-black mb-2">2026 and Beyond</h3>
<div class="glass-card p-6 reveal delay-300">Building our client base across Mumbai. Helping startups, growing teams and property owners find the right commercial office in the city. We are early, and we are focused.</div>
</div>
</div>
</div>
</div>
</section>

<section class="py-16 lg:py-24 bg-white/40">
<div class="max-w-5xl mx-auto px-4 sm:px-6">
<h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-4 text-center">What We Do</h2>
<p class="text-slate-500 text-center max-w-2xl mx-auto mb-12">Three services. One point of contact. No unnecessary complexity.</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center text-brand-electric mb-6"><i class="fas fa-building text-xl"></i></div>
<h3 class="text-xl font-black text-slate-900 mb-3">Managed Office Space</h3>
<p class="text-sm text-slate-600 leading-relaxed mb-4">We find the right commercial space in Mumbai, negotiate the lease, set up the office end-to-end, and handle ongoing management. You pay a single monthly fee per seat. Move-in ready in 2-4 weeks.</p>
<a href="/managed-office-space-mumbai" class="text-brand-electric text-sm font-semibold hover:underline">Explore Managed Office Space →</a>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan mb-6"><i class="fas fa-search text-xl"></i></div>
<h3 class="text-xl font-black text-slate-900 mb-3">Office for Rent</h3>
<p class="text-sm text-slate-600 leading-relaxed mb-4">For companies that want to lease their own space, we handle the search, shortlisting, landlord negotiations, and lease review. Free for tenants, we are paid by the landlord on successful placement.</p>
<a href="/office-space-for-rent-mumbai" class="text-brand-electric text-sm font-semibold hover:underline">Find Office Space for Rent →</a>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center text-brand-violet mb-6"><i class="fas fa-cogs text-xl"></i></div>
<h3 class="text-xl font-black text-slate-900 mb-3">Facility Management</h3>
<p class="text-sm text-slate-600 leading-relaxed mb-4">We manage day-to-day office operations for businesses in Mumbai, housekeeping, maintenance, vendor management, security, and IT support, from ₹2,500 per seat per month.</p>
<a href="/facility-management-mumbai" class="text-brand-electric text-sm font-semibold hover:underline">View Facility Management Services →</a>
</div>
</div>
<div class="glass-card p-8 lg:p-12 text-center">
<h3 class="text-2xl font-black text-slate-900 mb-4">Why Businesses Choose CorpEasy for Managed Office Space in Mumbai</h3>
<p class="text-slate-600 leading-relaxed max-w-3xl mx-auto mb-6">Setting up an office in Mumbai involves multiple decision points, the right micro-market, the right building, lease terms that do not trap you, furniture procurement, IT setup, and then ongoing maintenance. Most companies spend 3-6 months on this process and still get parts of it wrong. CorpEasy exists to make that process simple. We have worked with teams ranging from 10 seats to over 100 seats, across BKC, Lower Parel, Goregaon, and Andheri. Every engagement is handled directly by our founding team.</p>
<a href="/contact" class="bg-brand-electric text-white px-8 py-4 rounded-lg font-semibold text-sm hover:scale-105 transition-all inline-block">Talk to Our Team</a>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
