<?php
$page_id = 'list';
$page_title = 'List Office Space Mumbai | Find Tenants | CorpEasy';
$page_description = 'List your commercial office in Mumbai with CorpEasy. We find pre-qualified business tenants, manage lease negotiations & place on fixed-term agreements.';
$page_keywords = 'list commercial property Mumbai, find tenant for office space Mumbai, commercial property for lease Mumbai, office space landlord Mumbai, lease commercial property Mumbai, commercial office tenant Mumbai, rent out office space Mumbai, property owner Mumbai office';
$page_canonical = 'https://www.corpeasy.in/list-commercial-property-mumbai';
$page_og_image = 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1200&fm=webp';
$page_lcp_image = 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1200&fm=webp';
$page_schema = '{
  "@type": "Service",
  "name": "Commercial Property Leasing Mumbai",
  "provider": {"@id": "https://www.corpeasy.in/#organization"},
  "description": "We help Mumbai property owners find reliable business tenants for their commercial spaces.",
  "areaServed": {"@type": "City", "name": "Mumbai"},
  "serviceType": "Property Leasing"
}';

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">
<div class="order-2 lg:order-1 flex flex-col justify-center reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-gold/10 border border-brand-gold/30 rounded-full px-4 py-1.5 w-max">
<span class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></span>
<span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-gold">Lease Your Property</span>
</div>
<h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-none">List Your<br><span class="text-gradient-gold">Commercial Property.</span></h1>
<p class="text-base lg:text-lg text-slate-600 leading-relaxed mb-8 max-w-lg">Have a commercial property in Mumbai sitting empty or coming up for lease? We work directly with property owners to find pre-qualified business tenants — no spam brokers, no listing portals.</p>
<div class="space-y-3 mb-8">
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-gold/10 border border-brand-gold/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-gold text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Pre-qualified business tenants — no spammy broker networks</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-gold/10 border border-brand-gold/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-gold text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">We manage sourcing, conversations, and lease negotiations</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-gold/10 border border-brand-gold/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-gold text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Fixed, medium-term lease agreements with serious businesses</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-gold/10 border border-brand-gold/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-gold text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">One point of contact — we handle the entire process</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 reveal delay-100">
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-gold/10 border border-brand-gold/30 rounded-xl flex items-center justify-center mb-3 text-brand-gold"><i class="fas fa-users text-sm"></i></div>
<h3 class="text-base font-bold text-slate-900 mb-1">Vetted Tenants</h3>
<p class="text-xs text-slate-500 leading-relaxed">Only genuine, creditworthy businesses — not speculative enquiries</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-3 text-brand-electric"><i class="fas fa-file-signature text-sm"></i></div>
<h3 class="text-base font-bold text-slate-900 mb-1">Lease Handled</h3>
<p class="text-xs text-slate-500 leading-relaxed">We manage negotiations, documentation, and agreement signing</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-3 text-brand-cyan"><i class="fas fa-shield-alt text-sm"></i></div>
<h3 class="text-base font-bold text-slate-900 mb-1">No Broker Spam</h3>
<p class="text-xs text-slate-500 leading-relaxed">We do the matchmaking ourselves — not a listing portal</p>
</div>
</div>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
<div class="glass-card p-6 lg:p-8 border-t-4 border-t-brand-gold shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg lg:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-building text-brand-gold"></i> Tell Us About Your Property</h3>
<p class="text-xs text-slate-500 mb-6 leading-relaxed">Share your property details and we will get back to you within 24 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4 relative">
<input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company or Property Owner Name" class="input-premium">
<input type="email" name="email" placeholder="Work Email Address" class="input-premium" required>
<input type="tel" name="phone" placeholder="+91 Phone Number" class="input-premium" required>
<input type="text" name="property_location" placeholder="Property Address or Area" class="input-premium" required>
<input type="number" name="property_area" placeholder="Approximate Area (Sq Ft)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-gold text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(251,191,36,0.35)] hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(251,191,36,0.5)] transition-all">Submit Property Details</button>
<p class="text-xs text-slate-400 text-center flex items-center justify-center gap-1.5 mt-2"><i class="fas fa-lock text-brand-gold text-[10px]"></i> No spam. We respond within 24 hours.</p>
</form>
</div>
</div>
</section>

<section class="py-12 px-4 sm:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[350px] lg:h-[500px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1200&fm=webp" alt="Premium commercial building for lease in Mumbai" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-l from-brand-gold/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 right-6 lg:bottom-10 lg:right-10 bg-white/90 px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Premium Property Portfolio</span>
</div>
</div>
</section>

<section class="py-16 lg:py-24 bg-white/40">
<div class="max-w-7xl mx-auto px-4 sm:px-6">
<h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3 text-center">How We Find You the Right Tenant</h2>
<p class="text-slate-500 text-center max-w-2xl mx-auto mb-12 text-base">We do not blast your property on every listing portal and hope for the best. We match your space to the right type of business tenant from our active pipeline.</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="glass-card p-7">
<div class="w-10 h-10 bg-brand-gold/10 border border-brand-gold/30 rounded-xl flex items-center justify-center text-brand-gold mb-5"><span class="font-black text-sm">1</span></div>
<h3 class="font-black text-slate-900 mb-3">Property Briefing</h3>
<p class="text-sm text-slate-600 leading-relaxed">We understand your space — location, size, configuration, asking rent, and your timeline. We visit if needed. This takes one conversation and sets clear expectations on both sides.</p>
</div>
<div class="glass-card p-7">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center text-brand-electric mb-5"><span class="font-black text-sm">2</span></div>
<h3 class="font-black text-slate-900 mb-3">Active Matching</h3>
<p class="text-sm text-slate-600 leading-relaxed">We match your property against our current pipeline of businesses looking for commercial office space in Mumbai. Our focus is on managed office operators, growing startups, and established SMEs who need reliable, medium-term leases.</p>
</div>
<div class="glass-card p-7">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan mb-5"><span class="font-black text-sm">3</span></div>
<h3 class="font-black text-slate-900 mb-3">Negotiation</h3>
<p class="text-sm text-slate-600 leading-relaxed">We handle the commercial conversations, manage tenant due diligence, and negotiate lease terms on your behalf. You get a final term sheet to review — no back-and-forth without your input.</p>
</div>
<div class="glass-card p-7">
<div class="w-10 h-10 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center text-brand-violet mb-5"><span class="font-black text-sm">4</span></div>
<h3 class="font-black text-slate-900 mb-3">Lease Placement</h3>
<p class="text-sm text-slate-600 leading-relaxed">Once terms are agreed, we support the documentation process through to signed lease. Our goal is a clean, fixed-term commercial lease with a serious business tenant — not a short-term occupant who leaves in 3 months.</p>
</div>
</div>
<div class="mt-16 grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
<div>
<h2 class="text-2xl font-black text-slate-900 mb-6">What Types of Properties Do We List?</h2>
<p class="text-slate-600 leading-relaxed mb-4">We work with commercial office properties in Mumbai that are suited to business tenants — from small 500 sq ft units ideal for a 5-10 person office, up to full-floor commercial spaces of 5,000 sq ft and above suitable for managed office operators or large corporate teams.</p>
<p class="text-slate-600 leading-relaxed">We do not handle residential properties. Our focus is exclusively on commercial office space — bare shell, semi-furnished, and fully furnished properties across BKC, Lower Parel, Andheri, Goregaon, Powai, and Thane.</p>
</div>
<div>
<h2 class="text-2xl font-black text-slate-900 mb-6">Frequently Asked Questions</h2>
<div class="space-y-4">
<div>
<h3 class="font-bold text-slate-900 mb-1">What is your brokerage fee?</h3>
<p class="text-sm text-slate-600">Standard commercial brokerage is one month's rent, paid on successful lease signing. We discuss this upfront — no surprises.</p>
</div>
<div>
<h3 class="font-bold text-slate-900 mb-1">How long does it take to find a tenant?</h3>
<p class="text-sm text-slate-600">For well-priced commercial spaces in active micro-markets like BKC or Lower Parel, we typically present qualified tenant interest within 2–4 weeks. Lease signing generally follows within 4–8 weeks depending on due diligence.</p>
</div>
<div>
<h3 class="font-bold text-slate-900 mb-1">Do you only work with managed office operators?</h3>
<p class="text-sm text-slate-600">No. We place all types of business tenants — direct corporate occupiers, managed office operators, professional services firms, and growing startups. The right tenant depends on your space and lease expectations.</p>
</div>
</div>
</div>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
