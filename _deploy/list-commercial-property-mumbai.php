<?php
$page_id = 'list';
$page_title = 'List Commercial Property Mumbai | Find Business Tenants Fast | CorpEasy';
$page_description = 'List your commercial office space in Mumbai with CorpEasy. We find pre-qualified business tenants, manage lease negotiations, and place tenants on fixed-term agreements. No spam brokers.';
$page_keywords = 'list commercial property Mumbai, find tenant for office space Mumbai, commercial property for lease Mumbai, office space landlord Mumbai, lease commercial property Mumbai, commercial office tenant Mumbai, rent out office space Mumbai, property owner Mumbai office';
$page_canonical = 'https://www.corpeasy.in/list-commercial-property-mumbai';
$page_og_image = 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1200&fm=webp';
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

<section class="py-12 lg:py-24 px-4 sm:px-6 relative">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] lg:w-[800px] lg:h-[800px] bg-brand-gold opacity-10 top-0 right-0 lg:-top-20 lg:-right-20"></div>
<div class="max-w-2xl mx-auto mb-12 relative z-10">
<div class="glass-card p-6 sm:p-8 border-t-4 border-t-brand-gold shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg sm:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-building text-brand-gold"></i> Tell Us About Your Property</h3>
<p class="text-sm text-slate-600 mb-4 sm:mb-6">Share your property details and we will get back to you within 24 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Your Name *" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company or Property Owner Name" class="input-premium">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
<input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
</div>
<input type="text" name="property_location" placeholder="Property Address or Area *" class="input-premium" required>
<input type="number" name="property_area" placeholder="Approximate Area (Sq Ft)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-gold text-white py-3 sm:py-4 rounded-xl font-bold uppercase tracking-wider text-xs sm:text-sm hover:scale-[1.02] shadow-[0_0_20px_rgba(251,191,36,0.4)] transition-all">Submit Property Details</button>
</form>
</div>
</div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 p-6 sm:p-10 lg:p-12 bg-white/40 backdrop-blur-md rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] border border-white/60 mb-12 lg:mb-20">
<h1 class="text-3xl sm:text-4xl lg:text-6xl xl:text-7xl font-black text-slate-900 mb-6 sm:mb-8">List Your <span class="text-gradient-gold">Commercial Property.</span></h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Have a commercial property in Mumbai that is sitting empty or coming up for lease? We work with property owners to find the right tenants.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center relative z-10">
<div class="reveal">
<h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black mb-6 sm:mb-8 leading-tight lg:leading-none tracking-tight lg:tracking-tighter text-slate-900">The Right Tenant<br><span class="text-gradient-gold">For Your Space.</span></h2>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 mb-4 sm:mb-6 leading-relaxed">We are actively sourcing commercial office spaces across Mumbai for our clients. If you own or manage a commercial property and are looking for a reliable business tenant, we would like to hear from you.</p>
<p class="text-sm sm:text-base lg:text-lg text-slate-600 leading-relaxed">We bring genuine, vetted business tenants to you. This is not a listing portal. We do the matchmaking ourselves.</p>
</div>
<div class="glass-card p-6 sm:p-8 lg:p-10 reveal delay-100 border border-brand-gold/20 shadow-[0_0_40px_rgba(251,191,36,0.1)]">
<h4 class="text-lg sm:text-xl font-black text-slate-900 mb-4 sm:mb-6 flex items-center gap-3"><i class="fas fa-star text-brand-gold"></i> Why List With CorpEasy?</h4>
<div class="space-y-3 sm:space-y-4">
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We bring genuine, pre qualified business tenants to you.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We manage the sourcing, conversations, and lease negotiations.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We aim to place tenants on fixed, medium term lease agreements.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> No spammy broker networks. Just serious businesses.</p>
</div>
</div>
</section>
<section class="py-12 px-4 sm:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[350px] lg:h-[500px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1200&fm=webp" alt="Premium commercial building for lease in Mumbai" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-l from-brand-gold/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 right-6 lg:bottom-10 lg:right-10 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Premium Property Portfolio</span>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
