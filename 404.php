<?php
http_response_code(404);
$page_id = '404';
$page_title = 'Page Not Found | CorpEasy';
$page_description = 'The page you are looking for does not exist. Find managed office space in Mumbai, BKC, Lower Parel, Goregaon, Andheri.';
$page_canonical = 'https://www.corpeasy.in/404';
include 'templates/header.php';
?>
<main class="flex-grow flex items-center justify-center px-6 py-24">
<div class="max-w-2xl mx-auto text-center">
    <div class="w-24 h-24 bg-brand-electric/10 border border-brand-electric/20 rounded-3xl flex items-center justify-center mx-auto mb-10">
        <i class="fas fa-map-signs text-4xl text-brand-electric"></i>
    </div>
    <p class="text-xs font-bold uppercase tracking-widest text-brand-electric mb-4">404, Page Not Found</p>
    <h1 class="text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">Wrong turn.</h1>
    <p class="text-xl text-slate-600 mb-12 leading-relaxed">This page does not exist or has been moved. Here are some places you might be looking for.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12 text-left">
        <a href="/managed-office-space-mumbai" class="glass-card p-6 flex items-center gap-4 hover:border-brand-electric/30 transition-all">
            <div class="w-10 h-10 bg-brand-electric/10 rounded-xl flex items-center justify-center text-brand-electric flex-shrink-0"><i class="fas fa-building"></i></div>
            <div><p class="font-bold text-slate-900 text-sm">Managed Office Space</p><p class="text-xs text-slate-500">Mumbai, from ₹10,000/seat</p></div>
        </a>
        <a href="/office-space-for-rent-mumbai" class="glass-card p-6 flex items-center gap-4 hover:border-brand-cyan/30 transition-all">
            <div class="w-10 h-10 bg-brand-cyan/10 rounded-xl flex items-center justify-center text-brand-cyan flex-shrink-0"><i class="fas fa-search-location"></i></div>
            <div><p class="font-bold text-slate-900 text-sm">Find Office Space</p><p class="text-xs text-slate-500">We source & negotiate for you</p></div>
        </a>
        <a href="/blog" class="glass-card p-6 flex items-center gap-4 hover:border-brand-violet/30 transition-all">
            <div class="w-10 h-10 bg-brand-violet/10 rounded-xl flex items-center justify-center text-brand-violet flex-shrink-0"><i class="fas fa-newspaper"></i></div>
            <div><p class="font-bold text-slate-900 text-sm">Insights & Guides</p><p class="text-xs text-slate-500">Mumbai office space market</p></div>
        </a>
        <a href="/contact" class="glass-card p-6 flex items-center gap-4 hover:border-brand-rose/30 transition-all">
            <div class="w-10 h-10 bg-brand-rose/10 rounded-xl flex items-center justify-center text-brand-rose flex-shrink-0"><i class="fas fa-phone-alt"></i></div>
            <div><p class="font-bold text-slate-900 text-sm">Talk to Us</p><p class="text-xs text-slate-500">+91 98330 89993</p></div>
        </a>
    </div>
    <a href="/" class="inline-flex items-center gap-2 bg-brand-electric text-white px-8 py-4 rounded-xl font-semibold text-sm hover:bg-brand-blue transition-all shadow-[0_0_20px_rgba(99,102,241,0.3)]">
        <i class="fas fa-home"></i> Back to Homepage
    </a>
</div>
</main>
<?php include 'templates/footer.php'; ?>
