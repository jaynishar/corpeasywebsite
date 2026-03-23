<?php
$page_id = 'facility';
$page_title = 'Facility Management Services in Mumbai | Office Maintenance | CorpEasy';
$page_description = 'Professional facility management for your Mumbai office. Housekeeping, security, AMC contracts, fire safety compliance. Single monthly invoice. Get a quote today.';
$page_keywords = 'facility management services Mumbai, office housekeeping services Mumbai, commercial building maintenance Mumbai, AMC management services, office security services Mumbai';
$page_canonical = 'https://www.corpeasy.in/facility-management-mumbai';
$page_og_image = 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=1200';
$page_schema = '{
  "@type": "Service",
  "name": "Facility Management Services Mumbai",
  "provider": {"@id": "https://www.corpeasy.in/#organization"},
  "description": "Complete office facility management including housekeeping, security, AMC contracts, fire safety compliance, and vendor management.",
  "areaServed": {"@type": "City", "name": "Mumbai"},
  "serviceType": "Facility Management"
}';

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">
<div class="order-2 lg:order-1 flex flex-col justify-center reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-rose/10 border border-brand-rose/30 rounded-full px-4 py-1.5 backdrop-blur-md w-max">
<span class="w-2 h-2 rounded-full bg-brand-rose animate-pulse"></span>
<span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-rose">Facility Management</span>
</div>
<h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-none">Facility Management Services<br><span class="text-gradient-vibrant">in Mumbai.</span></h1>
<p class="text-base lg:text-lg text-slate-600 leading-relaxed mb-8 max-w-lg">Stop letting office management distract your team from real work. CorpEasy takes over the complete day-to-day operations of your existing office — from housekeeping and security to vendor contracts and compliance — so you never have to think about it again.</p>
<div class="space-y-3 mb-8">
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Housekeeping, security & pantry — fully managed</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">AMC contracts & vendor negotiation handled by us</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Fire safety, compliance & statutory requirements covered</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Single monthly invoice — no vendor chaos</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 reveal delay-100">
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-rose/10 border border-brand-rose/30 rounded-xl flex items-center justify-center mb-3 text-brand-rose"><i class="fas fa-broom text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Daily Operations</h4>
<p class="text-xs text-slate-500 leading-relaxed">Housekeeping, pantry, and reception management</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-3 text-brand-electric"><i class="fas fa-file-contract text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Vendor & AMC</h4>
<p class="text-xs text-slate-500 leading-relaxed">AC, electrical, plumbing, and IT vendor contracts</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-3 text-brand-cyan"><i class="fas fa-shield-alt text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Compliance & Safety</h4>
<p class="text-xs text-slate-500 leading-relaxed">Fire NOC, statutory audits, and security management</p>
</div>
</div>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
<div class="glass-card p-6 lg:p-8 border-t-4 border-t-brand-rose shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg lg:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-tools text-brand-rose"></i> Get a Facility Management Quote</h3>
<p class="text-xs text-slate-500 mb-6 leading-relaxed">Tell us about your office. We will send a detailed proposal within 24 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4 relative">
<input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
<input type="email" name="email" placeholder="Work Email Address" class="input-premium" required>
<input type="tel" name="phone" placeholder="+91 Phone Number" class="input-premium" required>
<select name="requirement" class="input-premium" required>
<option value="" disabled selected>Office Size</option>
<option>Small Office (Up to 20 seats)</option>
<option>Mid-Size Office (20–100 seats)</option>
<option>Large Office (100–500 seats)</option>
<option>Enterprise Campus (500+ seats)</option>
</select>
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-rose text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(244,63,94,0.35)] hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(244,63,94,0.5)] transition-all">Request Facility Quote</button>
<p class="text-xs text-slate-400 text-center flex items-center justify-center gap-1.5 mt-2"><i class="fas fa-lock text-brand-rose text-[10px]"></i> No spam. Response within 24 hours.</p>
</form>
</div>
</div>
</section>
<section class="py-20 relative bg-white/40">
<div class="max-w-7xl mx-auto px-4 lg:px-6">
<div class="text-center mb-14 reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-rose/10 border border-brand-rose/30 rounded-full px-4 py-1.5"><span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-rose">What We Handle</span></div>
<h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-4">Everything Your Office Needs.</h2>
<p class="text-lg text-slate-500 max-w-2xl mx-auto">One team. One invoice. Zero headaches.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
<div class="glass-card p-7"><i class="fas fa-broom text-brand-rose text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Housekeeping</h4><p class="text-sm text-slate-500 leading-relaxed">Daily cleaning, washroom upkeep, deep cleaning, and waste management</p></div>
<div class="glass-card p-7"><i class="fas fa-shield-alt text-brand-electric text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Security</h4><p class="text-sm text-slate-500 leading-relaxed">Trained security personnel, CCTV monitoring, access control management</p></div>
<div class="glass-card p-7"><i class="fas fa-coffee text-brand-cyan text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Pantry & Cafe</h4><p class="text-sm text-slate-500 leading-relaxed">Tea, coffee, snack stations, catering coordination and vendor tie-ups</p></div>
<div class="glass-card p-7"><i class="fas fa-tools text-brand-violet text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Maintenance</h4><p class="text-sm text-slate-500 leading-relaxed">Electrical, plumbing, AC servicing, and preventive maintenance schedules</p></div>
<div class="glass-card p-7"><i class="fas fa-file-contract text-brand-gold text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">AMC Contracts</h4><p class="text-sm text-slate-500 leading-relaxed">Annual maintenance contracts negotiated, managed, and tracked on your behalf</p></div>
<div class="glass-card p-7"><i class="fas fa-fire-extinguisher text-brand-rose text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Fire & Safety</h4><p class="text-sm text-slate-500 leading-relaxed">Fire NOC renewals, safety drills, first aid kits, and compliance audits</p></div>
<div class="glass-card p-7"><i class="fas fa-users text-brand-electric text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Reception & Admin</h4><p class="text-sm text-slate-500 leading-relaxed">Front desk management, visitor handling, couriers, and office supplies</p></div>
<div class="glass-card p-7"><i class="fas fa-chart-bar text-brand-cyan text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Monthly Reports</h4><p class="text-sm text-slate-500 leading-relaxed">Detailed monthly MIS reports on costs, vendor performance, and incidents</p></div>
</div>
</div>
</section>
<section class="py-20 relative">
<div class="max-w-5xl mx-auto px-4 lg:px-6 text-center reveal">
<h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-6">Built for Companies That Are Done<br><span class="text-gradient-vibrant">Thinking About Their Office.</span></h2>
<p class="text-lg text-slate-500 mb-12 max-w-2xl mx-auto">If your HR team is handling AMC complaints, your finance team is chasing vendor invoices, or your ops head is managing housekeeping — you need CorpEasy Facility Management.</p>
<a href="/contact" class="inline-flex items-center gap-3 bg-brand-rose text-white px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_25px_rgba(244,63,94,0.35)] hover:scale-105 transition-all">Talk to Our Team <i class="fas fa-arrow-right"></i></a>
</div>
</section>
<section class="py-16 px-4 lg:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] lg:h-[450px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=1920" alt="Professional facility management team in action" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-r from-brand-rose/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 left-6 lg:bottom-10 lg:left-10 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-rose animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Professional Operations Team</span>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
