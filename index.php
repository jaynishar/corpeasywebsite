<?php
$page_id = 'home';
$page_title = 'CorpEasy │ Managed Office Space in Mumbai · BKC, Lower Parel, Goregaon';
$page_description = 'CorpEasy finds, sets up, and manages your office space in Mumbai. One point of contact. Clear per-seat monthly cost. Fixed lease. BKC, Lower Parel & Goregaon.';
$page_canonical = 'https://www.corpeasy.in/';
$page_schema = '{
          "@type": "FAQPage",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is a managed office space in Mumbai?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "A managed office is a commercially leased workspace that has been sourced, set up, and is maintained on your behalf by a workspace operator like CorpEasy. You pay a single per-seat monthly fee and get a space that is ready from Day 1."
              }
            },
            {
              "@type": "Question",
              "name": "How long does it take to get an office through CorpEasy?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Typically a few weeks from when we identify a suitable space to the day your team can move in. This is significantly faster than finding, negotiating, and setting up a space entirely on your own."
              }
            },
            {
              "@type": "Question",
              "name": "Which areas in Mumbai does CorpEasy cover?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "CorpEasy sources commercial office space across BKC, Lower Parel, Worli, Goregaon East, Andheri East, and Powai."
              }
            },
            {
              "@type": "Question",
              "name": "How much does managed office space in Mumbai cost?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Costs vary by location: BKC approximately ₹450-750 per sq ft (avg ₹542), Worli and Lower Parel ₹250-450 (avg ₹320), Goregaon ₹150-300 (avg ₹228), Andheri East ₹150-400 (avg ₹253), Powai ₹115-310 (avg ₹179), and Navi Mumbai ₹100-160 (avg ₹110). CorpEasy shares your exact cost before you commit."
              }
            },
            {
              "@type": "Question",
              "name": "Can CorpEasy help me find a tenant for my commercial property?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. CorpEasy works with property owners across Mumbai to find reliable business tenants. We bring genuine, pre-qualified companies with real requirements."
              }
            }
          ]
        }';

include 'templates/header.php';
?>

<div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
<div class="orb-drift absolute w-[600px] h-[600px] rounded-full bg-brand-electric/6 blur-[120px] -top-32 -left-32" style="animation-duration:22s"></div>
<div class="orb-drift absolute w-[500px] h-[500px] rounded-full bg-brand-cyan/6 blur-[100px] bottom-0 right-0" style="animation-duration:28s; animation-delay: -8s"></div>
<div class="orb-drift absolute w-[400px] h-[400px] rounded-full bg-brand-violet/5 blur-[80px] top-1/2 left-1/2 -translate-x-1/2" style="animation-duration:18s; animation-delay: -4s"></div>
</div>
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-8 lg:py-16">
<div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-8 lg:gap-12 items-start">
<div class="reveal order-2 lg:order-1">
<div class="glow-blob w-96 h-96 bg-brand-electric -top-20 -left-20 opacity-20"></div>
<div class="mb-4 lg:mb-6">
<span class="text-xs sm:text-sm text-slate-500 font-medium">Managed Office Space in Mumbai</span>
</div>
<h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 lg:mb-6 leading-tight">Find Your Perfect<br><span id="hero-word" class="text-brand-electric">Office Space</span></h1>
<p class="text-base lg:text-lg text-slate-600 max-w-lg mb-6 lg:mb-8 leading-relaxed">CorpEasy helps businesses find, set up, and manage office spaces across Mumbai. Get a clear per-seat monthly cost with one point of contact.</p>
<div class="hero-buttons flex flex-col sm:flex-row gap-3 mb-6">
<a href="/contact" class="bg-brand-electric text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-brand-blue transition-all w-full sm:w-auto text-center">Get a Free Consultation</a>
<a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20am%20looking%20for%20office%20space%20in%20Mumbai." target="_blank" class="bg-green-500 text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-green-600 transition-all flex items-center justify-center gap-2 w-full sm:w-auto">
<i class="fab fa-whatsapp"></i> WhatsApp
</a>
</div>
<a href="/managed-office-space-mumbai" class="text-slate-600 text-sm font-medium flex items-center gap-2 hover:text-brand-electric transition-colors">
Learn how it works <i class="fas fa-arrow-right text-sm"></i>
</a>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[100px] self-start">
<div class="hero-form glass-card p-6 lg:p-8 border-t-4 border-t-brand-electric shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg lg:text-xl font-black text-slate-900 mb-2 flex items-center gap-3">
<i class="fas fa-bolt text-brand-electric"></i>
Tell Us What You Need
</h3>
<p class="text-sm text-slate-600 mb-4 lg:mb-6">Share your requirement. We will come back within 24 hours with a clear proposal. No obligation.</p>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name *" class="input-premium" required>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
<input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
</div>
<select name="requirement" class="input-premium">
<option value="">I am looking for...</option>
<option>A managed office space (up to 50 seats)</option>
<option>A managed office space (50 to 200 seats)</option>
<option>A managed office space (200+ seats)</option>
<option>Help finding a commercial office for rent</option>
<option>A tenant for my commercial property</option>
<option>General information</option>
</select>
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-electric text-white py-3 rounded-lg font-medium text-sm hover:bg-brand-blue transition-all">Submit Your Requirement</button>
</form>
<p class="text-xs text-slate-500 text-center mt-3 flex items-center justify-center gap-2">
<i class="fas fa-lock text-brand-electric text-xs"></i>
Your details are safe with us. No spam, ever.
</p>
</div>
</div>
</div>
</section>
<section class="py-8 lg:py-12 px-4 sm:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] sm:h-[400px] lg:h-[600px] reveal group">
<img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200" alt="Modern workspace in Mumbai - collaborative office design" class="absolute inset-0 w-full h-full object-cover hero-parallax-img transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" width="1200" height="675" fetchpriority="high">
<div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
<div class="absolute bottom-6 sm:bottom-10 left-6 sm:left-10 right-6 sm:right-10">
<h3 class="text-2xl sm:text-3xl lg:text-5xl font-black text-white mb-2 sm:mb-4 drop-shadow-lg tracking-tight">Where Teams Thrive & <br class="hidden sm:block"/>Businesses Grow.</h3>
<p class="text-white/90 text-base sm:text-lg lg:text-xl max-w-2xl drop-shadow hidden sm:block">Premium managed office spaces across Mumbai. Your workspace, perfected.</p>
</div>
</div>
</section>
<section class="py-24 relative overflow-hidden">
<div class="max-w-7xl mx-auto px-6 relative z-10">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
<div class="glass-card p-10 reveal">
<div class="w-14 h-14 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-8 text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.2)]"><i class="fas fa-search-location text-2xl"></i></div>
<h4 class="text-xl font-bold mb-4 text-slate-900">We Find the Right Space.</h4>
<p class="text-slate-600 leading-relaxed">Tell us your team size, preferred Mumbai location, and budget. We identify a suitable commercial property, negotiate the lease, and handle the process. You do not deal with brokers or landlords yourself.</p>
</div>
<div class="glass-card p-10 reveal delay-100">
<div class="w-14 h-14 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-8 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-tools text-2xl"></i></div>
<h4 class="text-xl font-bold mb-4 text-slate-900">We Set It Up. You Move In.</h4>
<p class="text-slate-600 leading-relaxed">Once the space is confirmed, we handle the basic workspace setup. Functional furniture, internet, and a clean professional environment. Your team walks in on Day 1 without coordinating a single vendor.</p>
</div>
<div class="glass-card p-10 reveal delay-200">
<div class="w-14 h-14 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center mb-8 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-receipt text-2xl"></i></div>
<h4 class="text-xl font-bold mb-4 text-slate-900">One Clear Cost. Fixed Lease.</h4>
<p class="text-slate-600 leading-relaxed">We calculate your all-in per seat monthly cost based on the actual property and setup. You commit to a fixed lease period and know exactly what you pay every month. No hidden charges. No surprises.</p>
</div>
<div class="glass-card p-10 reveal delay-300">
<div class="w-14 h-14 bg-brand-rose/10 border border-brand-rose/30 rounded-xl flex items-center justify-center mb-8 text-brand-rose shadow-[0_0_15px_rgba(244,63,94,0.15)]"><i class="fas fa-tools text-2xl"></i></div>
<h4 class="text-xl font-bold mb-4 text-slate-900">Facility Management</h4>
<p class="text-slate-600 leading-relaxed">Already have an office? We run it for you. Housekeeping, vendors, compliance — one team, one invoice.</p>
<a href="/facility-management-mumbai" class="inline-flex items-center gap-2 mt-6 text-xs font-black uppercase tracking-widest text-brand-rose hover:gap-4 transition-all cursor-pointer">Learn More <i class="fas fa-arrow-right"></i></a>
</div>
</div>
</div>
</section>
<section class="py-12 bg-white/70 border-y border-white/60 overflow-hidden backdrop-blur-sm">
<div class="ticker-track">
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Managed Office Space Mumbai</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-search-location"></i> Office Space for Rent BKC</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-ruler-combined"></i> Commercial Office for Lease in Mumbai</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-key"></i> Office Space in Lower Parel</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-indian-rupee-sign"></i> Clear Per Seat Monthly Cost</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-handshake"></i> Office Space in Goregaon</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-map-marker-alt"></i> Office Space in Andheri East</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-shield-check"></i> One Point of Contact</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-tools"></i> Facility Management</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Managed Operations</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Managed Office Space Mumbai</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-search-location"></i> Office Space for Rent BKC</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-ruler-combined"></i> Commercial Office for Lease in Mumbai</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-key"></i> Office Space in Lower Parel</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-indian-rupee-sign"></i> Clear Per Seat Monthly Cost</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-handshake"></i> Office Space in Goregaon</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-map-marker-alt"></i> Office Space in Andheri East</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-shield-check"></i> One Point of Contact</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-tools"></i> Facility Management</span>
<span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Managed Operations</span>
</div>
</section>
<section class="py-24 relative bg-white/40">
<div class="max-w-7xl mx-auto px-6">
<h2 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter text-center mb-6">Here Is How It Works.</h2>
<p class="text-xl text-slate-500 text-center mb-20">Three steps. One point of contact. A workspace ready when you are.</p>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<div class="glass-card p-10 reveal relative overflow-hidden">
<span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">01</span>
<div class="w-16 h-16 bg-brand-electric/10 border border-brand-electric/30 rounded-2xl flex items-center justify-center mb-6 text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.2)]"><i class="fas fa-clipboard-list text-2xl"></i></div>
<p class="text-xs font-semibold uppercase tracking-wide text-brand-electric mb-4">Step 01: You Share Your Requirement</p>
<h4 class="text-2xl font-bold text-slate-900 mb-4">Tell Us What You Need</h4>
<p class="text-slate-600 leading-relaxed relative z-10">Share your team size, preferred Mumbai location, and budget. We listen, ask the right questions, and get to work identifying suitable commercial spaces available in your price range.</p>
</div>
<div class="glass-card p-10 reveal delay-100 relative overflow-hidden">
<span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">02</span>
<div class="w-16 h-16 bg-brand-cyan/10 border border-brand-cyan/30 rounded-2xl flex items-center justify-center mb-6 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-drafting-compass text-2xl"></i></div>
<p class="text-xs font-semibold uppercase tracking-wide text-brand-electric mb-4">Step 02: We Source, Negotiate, Set Up</p>
<h4 class="text-2xl font-bold text-slate-900 mb-4">We Handle the Hard Part</h4>
<p class="text-slate-600 leading-relaxed relative z-10">We identify a suitable commercial property in your preferred location, negotiate the lease directly with the landlord, and manage the basic workspace setup. Furniture, internet, and the essentials to make the space ready.</p>
</div>
<div class="glass-card p-10 reveal delay-200 relative overflow-hidden">
<span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">03</span>
<div class="w-16 h-16 bg-brand-violet/10 border border-brand-violet/30 rounded-2xl flex items-center justify-center mb-6 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-key text-2xl"></i></div>
<p class="text-xs font-semibold uppercase tracking-wide text-brand-electric mb-4">Step 03: You Move In</p>
<h4 class="text-2xl font-bold text-slate-900 mb-4">A Clear Cost. A Fixed Lease.</h4>
<p class="text-slate-600 leading-relaxed relative z-10">We present your all-in per seat monthly cost based on the actual space and setup, before you commit to anything. You agree to a fixed lease period and move in. We remain your point of contact throughout.</p>
</div>
</div>
</div>
</section>
<section class="py-24 relative">
<div class="max-w-4xl mx-auto px-6">
<div class="text-center mb-16 reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-gold/10 border border-brand-gold/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-gold">Client Testimonial</span>
</div>
<h2 class="text-5xl lg:text-6xl font-black text-slate-900 mb-4">Trusted by Industry Leaders.</h2>
</div>
<div class="reveal">
<div class="relative bg-gradient-to-br from-white/80 via-white/60 to-brand-electric/5 backdrop-blur-xl rounded-[3rem] border border-white/60 shadow-[0_30px_80px_rgba(99,102,241,0.08)] p-10 lg:p-16 overflow-hidden">
<div class="absolute top-0 right-0 w-64 h-64 bg-brand-gold/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
<div class="absolute bottom-0 left-0 w-48 h-48 bg-brand-electric/5 rounded-full blur-[60px] translate-y-1/2 -translate-x-1/2"></div>
<div class="relative z-10">
<div class="flex items-center gap-6 mb-10">
<div class="w-20 h-20 bg-gradient-to-br from-brand-electric to-brand-violet rounded-2xl flex items-center justify-center text-white text-3xl shadow-[0_10px_30px_rgba(99,102,241,0.3)]">
<i class="fas fa-quote-left"></i>
</div>
<div>
<div class="flex text-brand-gold space-x-1 mb-2"><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i></div>
<p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Verified Client Testimonial</p>
</div>
</div>
<blockquote class="text-lg lg:text-xl text-slate-700 leading-relaxed mb-10 space-y-4">
<p>"This is to certify that Jaydev Enterprise (Brand Name: CorpEasy) has been associated with First Abu Dhabi Bank for providing facility management support services.</p>
<p>During the course of our engagement, their team has demonstrated professionalism, reliability, and a strong commitment to delivering quality services. They have consistently been responsive, well coordinated, and have maintained strong operational standards in all tasks assigned to them.</p>
<p>We vouch for their capabilities and are confident in their ability to successfully complete any task entrusted to them. They are known for adhering strictly to commitments, timelines, and deliverables, and have never under delivered on expectations.</p>
<p>Additionally, they provide cost effective solutions without compromising on quality, ensuring value driven service at all times.</p>
<p>We appreciate their proactive approach and their ability to understand and execute requirements efficiently."</p>
</blockquote>
<div class="flex flex-col sm:flex-row sm:items-center gap-6 pt-8 border-t border-slate-200/60">
<div class="w-16 h-16 bg-gradient-to-br from-brand-gold/20 to-brand-gold/5 rounded-2xl flex items-center justify-center text-brand-gold border border-brand-gold/20">
<i class="fas fa-user-tie text-2xl"></i>
</div>
<div>
<p class="text-xl font-black text-slate-900">Bhupinder Gujral</p>
<p class="text-sm font-bold text-brand-electric">Administration Head</p>
<p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">First Abu Dhabi Bank</p>
</div>
<div class="sm:ml-auto flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-full">
<i class="fas fa-shield-check text-sm"></i>
<span class="text-xs font-semibold uppercase tracking-wide">Verified</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="py-24 relative bg-white/40">
<div class="max-w-7xl mx-auto px-6">
<div class="mb-16 reveal text-center lg:text-left">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-cyan/10 border border-brand-cyan/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-cyan">Mumbai Locations</span>
</div>
<h2 class="text-5xl lg:text-6xl font-black text-slate-900 mb-4">We Work Across Mumbai.</h2>
<p class="text-xl text-slate-500">We source <strong>commercial office space</strong> across Mumbai's most active business corridors.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal">
<a href="/contact" class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer block">
<div class="inline-block px-3 py-1 bg-brand-gold/10 border border-brand-gold/30 text-brand-gold text-xs font-medium uppercase rounded-full mb-6">Premium Hub</div>
<div class="w-16 h-16 bg-brand-gold/10 border border-brand-gold/30 rounded-2xl flex items-center justify-center mb-6 text-brand-gold shadow-[0_0_15px_rgba(251,191,36,0.2)]"><i class="fas fa-star text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">BKC, Mumbai</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">Mumbai's most recognised commercial address. We source <strong>managed office space in BKC</strong> for companies that need a credible address in India's financial district.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹450 to ₹750/sqft</p></div>
</a>
<a href="/contact" class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-100 block">
<div class="inline-block px-3 py-1 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-xs font-medium uppercase rounded-full mb-6">Well Connected</div>
<div class="w-16 h-16 bg-brand-electric/10 border border-brand-electric/30 rounded-2xl flex items-center justify-center mb-6 text-brand-electric shadow-[0_0_15px_rgba(99,102,241,0.2)]"><i class="fas fa-building-columns text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Lower Parel & Worli</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">A well connected commercial corridor with Grade A buildings and strong transport links. Popular with companies looking for <strong>office space for rent in Lower Parel</strong>.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹250 to ₹450/sqft</p></div>
</a>
<a href="/contact" class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-200 block">
<div class="inline-block px-3 py-1 bg-brand-cyan/10 border border-brand-cyan/30 text-brand-cyan text-xs font-medium uppercase rounded-full mb-6">Good Value</div>
<div class="w-16 h-16 bg-brand-cyan/10 border border-brand-cyan/30 rounded-2xl flex items-center justify-center mb-6 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-chart-line text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Goregaon & Nirlon</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">One of Mumbai's most active commercial zones, particularly for tech and mid-size companies. Strong availability of <strong>commercial office space in Goregaon</strong> at practical costs.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹150 to ₹300/sqft</p></div>
</a>
<a href="/contact" class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-300 block">
<div class="inline-block px-3 py-1 bg-brand-violet/10 border border-brand-violet/30 text-brand-violet text-xs font-medium uppercase rounded-full mb-6">Airport Corridor</div>
<div class="w-16 h-16 bg-brand-violet/10 border border-brand-violet/30 rounded-2xl flex items-center justify-center mb-6 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-plane-departure text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Andheri East & SEEPZ</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">Well connected to the airport and the western suburbs. A practical choice for teams looking for <strong>office space for rent in Andheri</strong> with solid metro and road access.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹150 to ₹400/sqft</p></div>
</a>
</div>
</div>
</section>
<section class="py-24 relative bg-white/20">
<div class="max-w-5xl mx-auto px-6">
<div class="text-center mb-16 reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-electric">Indicative Pricing</span>
</div>
<h2 class="text-5xl font-black text-slate-900 mb-4">What Does It Cost?</h2>
<p class="text-xl text-slate-500 max-w-2xl mx-auto">Indicative all in per seat monthly costs, including rent, basic setup, and our service fee. Exact costs depend on your specific property and requirement.</p>
</div>
<div class="glass-card overflow-hidden reveal">
<div class="overflow-x-auto">
<table class="w-full text-sm border-collapse whitespace-nowrap min-w-[600px]">
<thead><tr>
<th class="py-5 px-8 text-left text-xs font-semibold uppercase text-slate-500 bg-white/30 border-b border-white/60">Location</th>
<th class="py-5 px-8 text-center text-xs font-semibold uppercase text-slate-500 bg-white/30 border-b border-white/60">Raw Rent (per sqft/month)</th>
<th class="py-5 px-8 text-center text-xs font-semibold uppercase text-brand-electric bg-brand-electric/5 border-b border-brand-electric/20">All In Per Seat / Month (est.)</th>
</tr></thead>
<tbody>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">BKC</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹450 to ₹750 (avg ₹542)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">₹35,000 to ₹40,000</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Worli & Lower Parel</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹250 to ₹450 (avg ₹320)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">₹30,000 to ₹40,000</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Goregaon</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹150 to ₹300 (avg ₹228)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">₹12,000 to ₹18,000</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Andheri East</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹150 to ₹400 (avg ₹253)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">₹16,000 to ₹20,000</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Powai & Chandivali</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹115 to ₹310 (avg ₹179)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">₹10,000 to ₹15,000</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold">Navi Mumbai</td><td class="py-5 px-8 text-slate-500 text-center">₹100 to ₹160 (avg ₹110)</td><td class="py-5 px-8 font-bold text-center bg-brand-electric/5">₹12,000 to ₹16,000</td></tr>
</tbody>
</table>
</div>
<p class="text-xs text-slate-500 px-8 py-4 border-t border-white/60">Estimates only. Actual costs depend on property, team size, lease term, and fit-out scope. CorpEasy shares your exact cost before you commit to anything.</p>
</div>
</div>
</section>
<section class="py-32 relative overflow-hidden bg-white/20">
<div class="glow-blob w-[600px] h-[600px] bg-brand-cyan opacity-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
<div class="max-w-7xl mx-auto px-6 text-center">
<div class="mb-20 reveal">
<h2 class="text-6xl text-slate-900 mb-8 font-black leading-tight">Why Companies Come to Us.</h2>
<p class="text-xl text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed">Sorting out a commercial office in Mumbai involves more parties and more time than most companies expect. Here is where CorpEasy makes the biggest difference.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal delay-100">
<div class="glass-card p-12 group hover:border-brand-electric/50 transition-all text-left">
<div class="w-16 h-16 bg-brand-electric/10 rounded-2xl flex items-center justify-center mb-8 text-brand-electric group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-map-marked-alt text-2xl"></i></div>
<h4 class="text-2xl font-black mb-4 text-slate-900">We Know the Mumbai Market</h4>
<p class="text-slate-600 leading-relaxed font-medium">Finding the right <strong>commercial office space in Mumbai</strong> takes local knowledge. We work across BKC, Lower Parel, Goregaon, Andheri, and Powai, and we know which properties are worth your time at your budget.</p>
</div>
<div class="glass-card p-12 group hover:border-brand-cyan/50 transition-all text-left">
<div class="w-16 h-16 bg-brand-cyan/10 rounded-2xl flex items-center justify-center mb-8 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-white transition-all duration-500"><i class="fas fa-user-tie text-2xl"></i></div>
<h4 class="text-2xl font-black mb-4 text-slate-900">One Point of Contact</h4>
<p class="text-slate-600 leading-relaxed font-medium">Instead of coordinating with a broker, a landlord, a furniture vendor, and an IT company separately, you deal with CorpEasy. We bring together what is needed so the space is ready for your team.</p>
</div>
<div class="glass-card p-12 group hover:border-brand-violet/50 transition-all text-left">
<div class="w-16 h-16 bg-brand-violet/10 rounded-2xl flex items-center justify-center mb-8 text-brand-violet group-hover:bg-brand-violet group-hover:text-white transition-all duration-500"><i class="fas fa-file-invoice-dollar text-2xl"></i></div>
<h4 class="text-2xl font-black mb-4 text-slate-900">Clear, Predictable Costs</h4>
<p class="text-slate-600 leading-relaxed font-medium">We share the per seat monthly cost based on the actual property and setup, before you commit to anything. No surprises and no ambiguous pricing. You know what you pay on a fixed lease from Day 1.</p>
</div>
</div>
</div>
</section>
<section class="py-24 relative bg-white/40">
<div class="max-w-5xl mx-auto px-6">
<div class="text-center mb-16 reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-electric">Sorting It Yourself vs Working With CorpEasy</span>
</div>
<h2 class="text-4xl font-black text-slate-900 mb-4">A Straightforward Comparison.</h2>
<p class="text-xl text-slate-500">The main practical differences between sorting your own office and using CorpEasy.</p>
</div>
<div class="glass-card overflow-hidden reveal">
<div class="overflow-x-auto">
<table class="w-full text-sm border-collapse whitespace-nowrap min-w-[600px]">
<thead><tr>
<th class="py-5 px-8 text-left text-xs font-semibold uppercase text-slate-500 bg-white/30 border-b border-white/60 w-1/3">What Needs Doing</th>
<th class="py-5 px-8 text-center text-xs font-semibold uppercase text-slate-500 bg-white/30 border-b border-white/60">Sorting It Yourself</th>
<th class="py-5 px-8 text-center text-xs font-semibold uppercase text-brand-electric bg-brand-electric/5 border-b border-brand-electric/20"><span class="block">With CorpEasy</span><span class="text-[9px] bg-brand-electric text-white px-2 py-0.5 rounded-full mt-1 inline-block">Simpler</span></th>
</tr></thead>
<tbody>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Dealing with the landlord</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">You do it directly</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; We handle it</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Coordinating workspace setup</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">You manage the vendors</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; We take care of it</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Time from decision to move in</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Several months, typically</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; A few weeks, typically</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Cost clarity before signing</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Hard to pin down upfront</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; Clear per seat cost shown first</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Number of vendors to manage</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Multiple, separately</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; Just us</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Commitment structure</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Open ended or complex</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">&#10004; Fixed lease, clear terms</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold">Property sourcing expertise</td><td class="py-5 px-8 text-slate-500 text-center">Limited to your own network</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5">&#10004; Our core strength</td></tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="py-12 px-4 sm:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[350px] lg:h-[500px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1920" alt="Commercial buildings in Mumbai BKC financial district" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-tr from-brand-cyan/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 left-6 lg:bottom-10 lg:left-10 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-cyan animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Mumbai Commercial Real Estate</span>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

<?php include 'templates/footer.php'; ?>
