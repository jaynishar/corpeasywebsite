<?php
$page_id = 'find';
$page_title = 'Office Space for Rent in Mumbai | CorpEasy';
$page_description = 'Commercial office space for rent in Mumbai — BKC, Lower Parel, Goregaon, Andheri, Powai. Verified listings, landlord negotiation & lease review.';
$page_keywords = 'office space for rent in Mumbai, commercial office space Mumbai, office space BKC rent, office space Lower Parel rent, commercial property for lease Mumbai, office on rent Mumbai, office space Mumbai 2026, commercial office rent BKC, office space Andheri rent, find office space Mumbai, tenant representation Mumbai, commercial property search Mumbai';
$page_canonical = 'https://www.corpeasy.in/office-space-for-rent-mumbai';
$page_og_image = 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200&fm=webp';
$page_lcp_image = 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200&fm=webp';
$page_schema = '{
  "@type": "Service",
  "name": "Office Space for Rent Mumbai",
  "provider": {"@id": "https://www.corpeasy.in/#organization"},
  "description": "Expert office space search and tenant representation services across Mumbai.",
  "areaServed": {"@type": "City", "name": "Mumbai"},
  "serviceType": "Commercial Property Search"
},
{
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question", "name": "Do you charge the tenant a fee?", "acceptedAnswer": {"@type": "Answer", "text": "No. Our service is free for tenants. We are compensated by the landlord."}},
    {"@type": "Question", "name": "How is CorpEasy different from 99Acres or MagicBricks?", "acceptedAnswer": {"@type": "Answer", "text": "We are a tenant representation service, not a listing portal. We verify availability, negotiate terms, and review leases on your behalf."}},
    {"@type": "Question", "name": "What areas in Mumbai do you cover?", "acceptedAnswer": {"@type": "Answer", "text": "BKC, Lower Parel, Andheri East, Goregaon, Powai, Malad, Vikhroli, Thane, and Navi Mumbai."}},
    {"@type": "Question", "name": "How long does it take to find an office?", "acceptedAnswer": {"@type": "Answer", "text": "Initial shortlist within 48 hours. Entire process from first call to lease signing typically takes 2-4 weeks."}},
    {"@type": "Question", "name": "Can you help with office interiors and setup?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. We can manage interior fit-out through our Managed Office service, or provide ongoing facility management."}}
  ]
}';

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">
<div class="order-2 lg:order-1 flex flex-col justify-center reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-cyan/10 border border-brand-cyan/30 rounded-full px-4 py-1.5 w-max">
<span class="w-2 h-2 rounded-full bg-brand-cyan animate-pulse"></span>
<span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-cyan">Find Office Space</span>
</div>
<h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-none">Office Space for Rent<br><span class="text-gradient-vibrant">in Mumbai.</span></h1>
<p class="text-base lg:text-lg text-slate-600 leading-relaxed mb-8 max-w-lg">Looking for <strong>commercial office space for rent in Mumbai</strong>? Tell us your team size, preferred location, and budget. We shortlist verified, available spaces within 48 hours — and negotiate the lease on your behalf.</p>
<div class="space-y-3 mb-8">
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-cyan/10 border border-brand-cyan/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-cyan text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Free for tenants — we are compensated by the landlord</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-cyan/10 border border-brand-cyan/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-cyan text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Curated shortlist of 3–5 verified properties within 48 hours</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-cyan/10 border border-brand-cyan/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-cyan text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">We handle site visits and all landlord negotiations</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-cyan/10 border border-brand-cyan/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-cyan text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Lease reviewed before you sign — no surprises</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 reveal delay-100">
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-3 text-brand-cyan"><i class="fas fa-map-marked-alt text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">We Know What's Available</h4>
<p class="text-xs text-slate-500 leading-relaxed">BKC, Lower Parel, Goregaon, Andheri, Powai — we track the market daily</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-3 text-brand-electric"><i class="fas fa-handshake text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Landlord Negotiations</h4>
<p class="text-xs text-slate-500 leading-relaxed">We negotiate rent, deposit, and lease terms directly with the building</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center mb-3 text-brand-violet"><i class="fas fa-file-contract text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Lease Review</h4>
<p class="text-xs text-slate-500 leading-relaxed">We flag unfavorable clauses before you commit to anything</p>
</div>
</div>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
<div class="glass-card p-6 lg:p-8 border-t-4 border-t-brand-cyan shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg lg:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-search-location text-brand-cyan"></i> Tell Us What You Are Looking For</h3>
<p class="text-xs text-slate-500 mb-6 leading-relaxed">Share your requirement and we will come back with verified options within 24–48 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4 relative">
<input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
<input type="email" name="email" placeholder="Work Email Address" class="input-premium" required>
<input type="tel" name="phone" placeholder="+91 Phone Number" class="input-premium" required>
<input type="text" name="requirement" placeholder="Requirement (e.g. BKC, 30 seats, ₹2L budget)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-cyan text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(6,182,212,0.35)] hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(6,182,212,0.5)] transition-all">Find My Office Space</button>
<p class="text-xs text-slate-400 text-center flex items-center justify-center gap-1.5 mt-2"><i class="fas fa-lock text-brand-cyan text-[10px]"></i> Free for tenants. Response within 48 hours.</p>
</form>
</div>
</div>
</section>

<section class="py-20 bg-white/40">
<div class="max-w-4xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-8 text-center">Mumbai Office Rental<br><span class="text-gradient-vibrant">Market in 2026.</span></h2>
<p class="text-lg text-slate-600 leading-relaxed mb-6">Mumbai's commercial real estate market remains one of India's most active, with over 75 million square feet of Grade A office space across the city. Despite new supply from areas like Thane and Navi Mumbai, demand for prime locations like BKC, Lower Parel, and Andheri continues to outpace availability.</p>
<p class="text-lg text-slate-600 leading-relaxed mb-6">Average commercial rent in Mumbai ranges from ₹80 per sq ft/month in emerging areas like Thane to ₹350+ per sq ft/month in BKC's premium towers. For a 2,000 sq ft office (roughly 30 seats), monthly rent alone can range from ₹1.6 lakh to ₹7 lakh depending on the location and building grade.</p>
<p class="text-lg text-slate-600 leading-relaxed mb-6">The biggest challenge for businesses looking for office space in Mumbai is not finding available properties — it is finding the right one. Most commercial listings on portals like 99Acres and MagicBricks are outdated, duplicated, or posted by brokers who add their own commission. The actual rent and terms often differ significantly from what is advertised online.</p>
<p class="text-lg text-slate-600 leading-relaxed">This is where working with a tenant representative like CorpEasy makes a difference. We deal directly with landlords and building managers, verify availability in real-time, and negotiate terms that protect your interests — not the landlord's.</p>
</div>
</section>

<section class="py-20">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-6 text-center">Popular Areas for<br><span class="text-gradient-vibrant">Office Rent in Mumbai.</span></h2>
<p class="text-lg text-slate-500 mb-16 text-center max-w-3xl mx-auto">Each micro-market in Mumbai has its own characteristics. Here is what you need to know about the top commercial districts.</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">BKC (Bandra Kurla Complex)</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹250 - ₹380 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">Mumbai's financial district. Home to the Diamond Bourse, SEBI headquarters, and offices of most major banks and consulting firms. Best for financial services, legal firms, and companies that need to be close to regulators. Excellent road connectivity but limited metro access (upcoming Bandra North metro station will improve this).</p>
</div>
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">Lower Parel</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹150 - ₹280 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">The transformed mill district that is now a creative and tech hub. Buildings like Marathon Futurex, Peninsula Business Park, and One World Center offer Grade A spaces. Well-connected by local train (Lower Parel station on Western Line). Popular with media, advertising, e-commerce, and tech companies.</p>
</div>
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">Andheri East</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹120 - ₹220 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">One of Mumbai's largest and most diverse commercial zones. MIDC area near the airport houses many IT/ITES companies. The Andheri metro station (Line 1) provides connectivity to Ghatkopar and Versova. A practical choice for businesses that need airport proximity or have teams spread across the Western suburbs.</p>
</div>
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">Goregaon</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹100 - ₹180 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">A rapidly growing commercial hub anchored by NESCO IT Park, Ackruti Trade Centre, and the upcoming Oberoi Commerz III. Located on the Western Express Highway with local train connectivity. Offers the best value for companies that need Grade A space without BKC or Lower Parel price tags.</p>
</div>
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">Powai</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹110 - ₹200 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">Mumbai's tech ecosystem centered around Hiranandani Business Park, Chromium, and Powai Plaza. Near IIT Bombay, which makes it attractive for deep-tech and research-driven companies. The location is slightly off the main rail lines, so road access matters. Best for IT companies and startups with a technical workforce.</p>
</div>
<div class="glass-card p-8">
<h4 class="text-xl font-bold text-slate-900 mb-2">Thane</h4>
<p class="text-xs text-brand-cyan font-bold uppercase tracking-wider mb-3">₹80 - ₹140 per sq ft/month</p>
<p class="text-slate-600 leading-relaxed">An emerging business destination with significantly lower costs. Buildings like Lodha Supremus, Ashar IT Park, and Hiranandani Estate offer modern office infrastructure. Excellent for companies with teams based in Thane, Navi Mumbai, or those looking to reduce rental costs without compromising on workspace quality.</p>
</div>
</div>
</div>
</section>

<section class="py-20 bg-white/40">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-6 text-center">How CorpEasy Helps You<br><span class="text-gradient-vibrant">Find the Right Space.</span></h2>
<p class="text-lg text-slate-500 mb-16 text-center max-w-3xl mx-auto">We are not a listing portal. We are your tenant representative.</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan text-xl font-black mb-6">1</div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Understand Your Needs</h4>
<p class="text-slate-600 leading-relaxed">We start with your team size, budget, preferred areas, lease duration, and any specific requirements like a server room, parking, or a specific building grade.</p>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan text-xl font-black mb-6">2</div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Curated Shortlist</h4>
<p class="text-slate-600 leading-relaxed">Within 48 hours, we send you 3-5 verified, currently available properties. Each includes actual rent (not inflated portal prices), building details, floor plans, and our honest assessment.</p>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan text-xl font-black mb-6">3</div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Site Visits and Negotiation</h4>
<p class="text-slate-600 leading-relaxed">We accompany you on site visits, point out things you might miss (like maintenance charges, parking allocation, or lock-in clauses), and negotiate the best possible terms with the landlord.</p>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan text-xl font-black mb-6">4</div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Lease Finalization</h4>
<p class="text-slate-600 leading-relaxed">We review the lease agreement, flag unfavorable clauses, ensure the security deposit terms are fair, and make sure the rent escalation is within market norms before you sign anything.</p>
</div>
</div>
</div>
</section>

<section class="py-20">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-16 text-center">Types of Office Space Available.</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center text-brand-electric mb-6"><i class="fas fa-warehouse text-xl"></i></div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Bare Shell</h4>
<p class="text-slate-600 leading-relaxed mb-3">A raw space with basic structure — walls, flooring, and electrical points. You handle all interior work: false ceiling, partitions, furniture, AC ducting, and IT infrastructure. Lowest rent but highest setup cost and longest move-in time (3-6 months).</p>
<p class="text-sm text-brand-electric font-semibold">Best for: Large enterprises with specific design requirements</p>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan mb-6"><i class="fas fa-th-large text-xl"></i></div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Warm Shell</h4>
<p class="text-slate-600 leading-relaxed mb-3">A partially done space with false ceiling, flooring, AC, and basic electrical completed. You add furniture, IT, and any custom interiors. Moderate rent with lower setup cost and faster move-in (4-8 weeks).</p>
<p class="text-sm text-brand-cyan font-semibold">Best for: Mid-size companies wanting some customization</p>
</div>
<div class="glass-card p-8">
<div class="w-12 h-12 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center text-brand-violet mb-6"><i class="fas fa-couch text-xl"></i></div>
<h4 class="text-xl font-bold text-slate-900 mb-3">Fully Furnished</h4>
<p class="text-slate-600 leading-relaxed mb-3">Move-in ready space with furniture, AC, internet connectivity, and sometimes even a pantry setup. Highest rent per sq ft but zero setup cost and immediate occupancy (1-2 weeks). Includes desks, chairs, meeting rooms, and reception.</p>
<p class="text-sm text-brand-violet font-semibold">Best for: Startups, project teams, and quick expansions</p>
</div>
</div>
</div>
</section>

<section class="py-20 bg-white/40">
<div class="max-w-4xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-8 text-center">What to Check Before<br><span class="text-gradient-vibrant">Signing a Commercial Lease.</span></h2>
<p class="text-lg text-slate-500 mb-12 text-center max-w-3xl mx-auto">Commercial leases in Mumbai can run 20-40 pages. Here are the critical items most tenants miss.</p>
<div class="space-y-6">
<div class="glass-card p-6 flex items-start gap-4">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan flex-shrink-0"><i class="fas fa-rupee-sign text-sm"></i></div>
<div><h4 class="text-lg font-bold text-slate-900 mb-1">Rent Escalation Clause</h4><p class="text-slate-600 leading-relaxed">Most Mumbai leases include a 5% annual rent increase, but some landlords push for 10-15%. Negotiate this upfront — over a 5-year lease, the difference between 5% and 10% escalation is massive.</p></div>
</div>
<div class="glass-card p-6 flex items-start gap-4">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan flex-shrink-0"><i class="fas fa-lock text-sm"></i></div>
<div><h4 class="text-lg font-bold text-slate-900 mb-1">Lock-in Period</h4><p class="text-slate-600 leading-relaxed">The lock-in period means you cannot vacate without paying rent for the remaining lock-in months. Standard is 12-36 months. If you are a startup, negotiate for a shorter lock-in or a break clause after 12 months.</p></div>
</div>
<div class="glass-card p-6 flex items-start gap-4">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan flex-shrink-0"><i class="fas fa-money-bill-wave text-sm"></i></div>
<div><h4 class="text-lg font-bold text-slate-900 mb-1">Security Deposit</h4><p class="text-slate-600 leading-relaxed">Typical security deposits in Mumbai are 3-6 months rent (interest-free). Some landlords ask for 10-12 months. Always negotiate this — a 6-month deposit on a ₹5 lakh/month rent means ₹30 lakh locked up doing nothing.</p></div>
</div>
<div class="glass-card p-6 flex items-start gap-4">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan flex-shrink-0"><i class="fas fa-parking text-sm"></i></div>
<div><h4 class="text-lg font-bold text-slate-900 mb-1">Parking and Maintenance</h4><p class="text-slate-600 leading-relaxed">Parking in Mumbai commercial buildings is charged separately (₹5,000-15,000/spot/month in BKC). Maintenance charges (CAM) add ₹15-40 per sq ft/month. These are often not included in the quoted rent, so always ask for the total cost of occupancy.</p></div>
</div>
</div>
</div>
</section>

<section class="py-20">
<div class="max-w-4xl mx-auto px-6">
<h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-16 text-center">Frequently Asked Questions.</h2>
<div class="space-y-4">
<div class="glass-card p-6 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
<div class="flex justify-between items-center">
<h3 class="text-lg font-bold text-slate-900">Do you charge the tenant a fee?</h3>
<i class="fas fa-chevron-down text-brand-cyan faq-icon transition-transform"></i>
</div>
<div class="faq-answer hidden mt-4 text-slate-600 leading-relaxed">No. Our service is free for tenants. We are compensated by the landlord as part of the transaction. You pay nothing extra — the rent and terms you get through us are the same (often better) than going directly to the landlord.</div>
</div>
<div class="glass-card p-6 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
<div class="flex justify-between items-center">
<h3 class="text-lg font-bold text-slate-900">How is CorpEasy different from 99Acres or MagicBricks?</h3>
<i class="fas fa-chevron-down text-brand-cyan faq-icon transition-transform"></i>
</div>
<div class="faq-answer hidden mt-4 text-slate-600 leading-relaxed">Portals show you listings — often outdated or duplicated. We are a tenant representation service. We personally verify availability, accompany you on visits, negotiate terms on your behalf, and review the lease agreement before you sign. Think of us as your real estate advisor, not a property search engine.</div>
</div>
<div class="glass-card p-6 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
<div class="flex justify-between items-center">
<h3 class="text-lg font-bold text-slate-900">What areas in Mumbai do you cover?</h3>
<i class="fas fa-chevron-down text-brand-cyan faq-icon transition-transform"></i>
</div>
<div class="faq-answer hidden mt-4 text-slate-600 leading-relaxed">We cover all major commercial zones in Mumbai: BKC, Lower Parel, Andheri East, Goregaon, Powai, Malad, Vikhroli, Thane, and Navi Mumbai. If you have a specific area in mind that is not listed, ask us — we likely have contacts there as well.</div>
</div>
<div class="glass-card p-6 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
<div class="flex justify-between items-center">
<h3 class="text-lg font-bold text-slate-900">How long does it take to find an office?</h3>
<i class="fas fa-chevron-down text-brand-cyan faq-icon transition-transform"></i>
</div>
<div class="faq-answer hidden mt-4 text-slate-600 leading-relaxed">We send an initial shortlist within 48 hours. Site visits can be scheduled within the same week. The entire process from first call to lease signing typically takes 2-4 weeks, depending on how quickly you make decisions and how complex the negotiation is. For urgent requirements, we can expedite this to under 10 days.</div>
</div>
<div class="glass-card p-6 cursor-pointer" onclick="this.querySelector('.faq-answer').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
<div class="flex justify-between items-center">
<h3 class="text-lg font-bold text-slate-900">Can you help with office interiors and setup after the lease?</h3>
<i class="fas fa-chevron-down text-brand-cyan faq-icon transition-transform"></i>
</div>
<div class="faq-answer hidden mt-4 text-slate-600 leading-relaxed">Yes. If you take a bare shell or warm shell space, we can manage the interior fit-out and workspace setup through our Managed Office service. If you take a fully furnished space, we can provide ongoing facility management. We are a full-stack workspace solutions provider.</div>
</div>
</div>
</div>
</section>

<section class="py-16 bg-white/40">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-8 text-center">Related Services</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<a href="/managed-office-space-mumbai" class="glass-card p-8 hover:border-brand-electric/30 transition-all group">
<div class="w-12 h-12 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center text-brand-electric mb-4 group-hover:bg-brand-electric group-hover:text-white transition-all"><i class="fas fa-building text-lg"></i></div>
<h4 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-brand-electric transition-colors">Managed Office Space</h4>
<p class="text-sm text-slate-600">Don't want to deal with setup and operations? We handle everything — from finding the space to managing it daily.</p>
</a>
<a href="/facility-management-mumbai" class="glass-card p-8 hover:border-brand-rose/30 transition-all group">
<div class="w-12 h-12 bg-brand-rose/10 border border-brand-rose/30 rounded-xl flex items-center justify-center text-brand-rose mb-4 group-hover:bg-brand-rose group-hover:text-white transition-all"><i class="fas fa-tools text-lg"></i></div>
<h4 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-brand-rose transition-colors">Facility Management</h4>
<p class="text-sm text-slate-600">Already have a space? We manage housekeeping, security, AMC contracts, and daily office operations.</p>
</a>
<a href="/contact" class="glass-card p-8 hover:border-brand-cyan/30 transition-all group">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan mb-4 group-hover:bg-brand-cyan group-hover:text-white transition-all"><i class="fas fa-phone-alt text-lg"></i></div>
<h4 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-brand-cyan transition-colors">Free Consultation</h4>
<p class="text-sm text-slate-600">Tell us what you need. A 15-minute call is enough for us to start searching.</p>
</a>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
