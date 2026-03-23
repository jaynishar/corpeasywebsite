<?php
$page_id = 'find';
$page_title = 'Office Space for Rent in Mumbai | Commercial Property | CorpEasy';
$page_description = 'Find commercial office space for rent in Mumbai. BKC, Lower Parel, Goregaon, Andheri, Powai. Expert negotiation and tenant representation. Free consultation.';
$page_keywords = 'office space for rent in Mumbai, commercial office space Mumbai, office space BKC rent, office space Lower Parel rent, commercial property for lease Mumbai';
$page_canonical = 'https://www.corpeasy.in/office-space-for-rent-mumbai';
$page_schema = '{
  "@type": "Service",
  "name": "Office Space for Rent Mumbai",
  "provider": {"@id": "https://www.corpeasy.in/#organization"},
  "description": "Expert office space search and tenant representation services across Mumbai. We find and negotiate commercial properties for your business.",
  "areaServed": {"@type": "City", "name": "Mumbai"},
  "serviceType": "Commercial Property Search"
}';

include 'templates/header.php';
?>

<section class="py-12 lg:py-24 px-4 sm:px-6 relative reveal">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] bg-brand-cyan opacity-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
<div class="max-w-2xl mx-auto mb-12 relative z-10">
<div class="glass-card p-6 sm:p-8 border-t-4 border-t-brand-cyan shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg sm:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-search-location text-brand-cyan"></i> Tell Us What You Are Looking For</h3>
<p class="text-sm text-slate-600 mb-4 sm:mb-6">Share your location preference, team size, and budget. We will come back with suitable options within 24 to 48 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name *" class="input-premium" required>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
<input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
</div>
<input type="text" name="requirement" placeholder="Your requirement (e.g. BKC, 30 seats)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-cyan text-white py-3 sm:py-4 rounded-xl font-bold uppercase tracking-wider text-xs sm:text-sm hover:scale-[1.02] shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all">Share My Requirement</button>
</form>
</div>
</div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 p-6 sm:p-10 lg:p-12 bg-white/40 backdrop-blur-md rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] border border-white/60 mb-12">
<h1 class="text-3xl sm:text-4xl lg:text-6xl xl:text-7xl font-black text-slate-900 mb-6 sm:mb-8">Find <span class="text-gradient">Office Space</span> in Mumbai.</h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Looking for <strong>commercial office space for rent in Mumbai</strong>? Tell us your team size, location preference, and budget.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 relative z-10">
<div class="glass-card p-6 sm:p-8 reveal">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-6 text-brand-cyan"><i class="fas fa-map-marked-alt text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">We Know What Is Available</h4>
<p class="text-slate-600 leading-relaxed text-sm">We actively track commercial properties across BKC, Lower Parel, Goregaon, Andheri, and Powai.</p>
</div>
<div class="glass-card p-6 sm:p-8 reveal delay-100">
<div class="w-12 h-12 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-6 text-brand-electric"><i class="fas fa-handshake text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">We Handle the Landlord Conversations</h4>
<p class="text-slate-600 leading-relaxed text-sm">Once we identify a space that fits, we approach the landlord and manage the negotiation.</p>
</div>
<div class="glass-card p-6 sm:p-8 reveal delay-200">
<div class="w-12 h-12 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center mb-6 text-brand-violet"><i class="fas fa-file-contract text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">Clear Terms Before You Commit</h4>
<p class="text-slate-600 leading-relaxed text-sm">Before you agree to anything, we lay out the cost clearly. No surprises after you have signed.</p>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
