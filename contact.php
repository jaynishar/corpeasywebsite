<?php
$page_id = 'contact';
$page_title = 'Contact CorpEasy | Free Office Space Consultation Mumbai';
$page_description = 'Contact CorpEasy for managed office space, facility management, or commercial property enquiries in Mumbai. We respond within 24 hours, Mon-Sat 9AM-7PM.';
$page_keywords = 'contact CorpEasy, office space consultation Mumbai, managed office enquiry Mumbai, facility management quote Mumbai, free office consultation Mumbai, office space advice Mumbai';
$page_canonical = 'https://www.corpeasy.in/contact';
$page_og_image = 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&q=80&w=1200&fm=webp&h=630';
$page_schema = json_encode([
  "@type" => "ContactPage",
  "name" => "Contact CorpEasy",
  "url" => "https://www.corpeasy.in/contact",
  "description" => "Contact CorpEasy for managed office space, facility management, or commercial property enquiries in Mumbai.",
  "mainEntityOfPage" => ["@id" => "https://www.corpeasy.in/#organization"],
  "potentialAction" => [
    "@type" => "CommunicateAction",
    "target" => [
      "@type" => "EntryPoint",
      "urlTemplate" => "https://www.corpeasy.in/contact",
      "actionPlatform" => "https://schema.org/DesktopWebPlatform"
    ]
  ]
], JSON_UNESCAPED_SLASHES);

include 'templates/header.php';
?>

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 xl:gap-20 items-start reveal relative">
<div class="lg:col-span-5 relative z-10">
<div class="inline-flex items-center space-x-2 mb-6 sm:mb-10 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-3 sm:px-4 py-1.5">
<span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse"></span>
<span class="text-[10px] sm:text-xs font-semibold text-brand-electric uppercase tracking-[0.2em] sm:tracking-[0.4em]">Get in Touch</span>
</div>
<h1 class="text-4xl sm:text-5xl lg:text-6xl text-slate-900 font-black mb-6 sm:mb-10 leading-tight">Let's<br><span class="text-gradient-vibrant">Talk.</span></h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 leading-relaxed mb-8 sm:mb-16 max-w-sm">Whether you are looking for office space in Mumbai, want help finding a tenant for your property, or just have a question, fill in the form and we will be back in touch within 24 hours.</p>
<div class="space-y-4 sm:space-y-6 lg:space-y-10">
<div class="flex items-center gap-4 sm:gap-6 lg:gap-8 group glass-card p-4 sm:p-6 border border-white/60">
<div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-white/70 border border-white/80 rounded-xl sm:rounded-2xl flex items-center justify-center text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.1)] group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-envelope text-lg sm:text-xl"></i></div>
<div><p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-1">Email Dev</p><a href="mailto:devdoshi@corpeasy.in" class="text-base sm:text-lg lg:text-xl font-bold text-slate-900 hover:text-brand-electric transition-colors">devdoshi@corpeasy.in</a></div>
</div>
<div class="flex items-center gap-4 sm:gap-6 lg:gap-8 group glass-card p-4 sm:p-6 border border-white/60">
<div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-white/70 border border-white/80 rounded-xl sm:rounded-2xl flex items-center justify-center text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.1)] group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-envelope text-lg sm:text-xl"></i></div>
<div><p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-1">Email Jay</p><a href="mailto:jaynishar@corpeasy.in" class="text-base sm:text-lg lg:text-xl font-bold text-slate-900 hover:text-brand-electric transition-colors">jaynishar@corpeasy.in</a></div>
</div>
<div class="flex items-center gap-4 sm:gap-6 lg:gap-8 group glass-card p-4 sm:p-6 border border-white/60">
<div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-green-500/10 border border-green-500/30 rounded-xl sm:rounded-2xl flex items-center justify-center text-green-500 shadow-[0_0_15px_rgba(34,197,94,0.1)] group-hover:bg-green-500 group-hover:text-white transition-all duration-500"><i class="fab fa-whatsapp text-xl sm:text-2xl"></i></div>
<div><p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-1">WhatsApp</p><a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20would%20like%20to%20discuss%20an%20office%20requirement." target="_blank" rel="noopener noreferrer" class="text-base sm:text-lg lg:text-xl font-bold text-slate-900 hover:text-green-500 transition-colors">Chat With Us</a></div>
</div>
<div class="glass-card p-4 sm:p-6 border border-white/60">
<p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-2 sm:mb-3">Our Office</p>
<p class="text-xs sm:text-sm text-slate-700 leading-relaxed">Office No. 30, 2nd Floor, Gopal Bhavan,<br>Shamaldas Gandhi Marg, Marine Lines East,<br>Mumbai, Maharashtra 400002</p>
</div>
</div>
</div>
<div class="lg:col-span-7 glass-card p-6 sm:p-8 lg:p-12 xl:p-16 border-t-[6px] sm:border-t-[8px] lg:border-t-[10px] border-t-brand-electric reveal delay-2 relative z-10 shadow-[0_20px_40px_rgba(0,0,0,0.1)]">
<form onsubmit="handleLead(event)" class="space-y-4 sm:space-y-6">
<div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-10 pb-4 sm:pb-6 border-b border-white/80">
<i class="fas fa-comments text-brand-electric text-xl sm:text-2xl"></i>
<h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Send Us a Message</h3>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
<label class="sr-only" for="full_name">Your Full Name</label>
<input id="full_name" type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required autocomplete="name" minlength="2" maxlength="80" title="Please enter your full name">
<label class="sr-only" for="company_name">Company Name</label>
<input id="company_name" type="text" name="company_name" placeholder="Company Name (optional)" class="input-premium" autocomplete="organization">
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
<label class="sr-only" for="email">Email Address</label>
<input id="email" type="email" name="email" placeholder="Email Address" class="input-premium" required autocomplete="email">
<label class="sr-only" for="phone">Phone / WhatsApp</label>
<input id="phone" type="tel" name="phone" placeholder="Phone / WhatsApp (optional)" class="input-premium" autocomplete="tel" pattern="[0-9\s\+\-\(\)]{7,15}" title="Please enter a valid phone number (7-15 digits)">
</div>
<label class="sr-only" for="requirement">What can we help you with?</label>
<select id="requirement" name="requirement" class="input-premium" required>
<option value="">What can we help you with?</option>
<option>I need a managed office space in Mumbai</option>
<option>I need help finding a commercial office for rent</option>
<option>I want to list my commercial property</option>
<option>I need facility management for my office</option>
<option>General enquiry</option>
</select>
<label class="sr-only" for="team_size">Team Size</label>
<select id="team_size" name="team_size" class="input-premium">
<option value="">Team size (optional)</option>
<option>1-10 seats</option>
<option>11-25 seats</option>
<option>26-50 seats</option>
<option>51-100 seats</option>
<option>100+ seats</option>
</select>
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<p class="text-[10px] sm:text-xs text-slate-500 text-center flex items-center justify-center gap-1.5"><i class="fas fa-clock text-brand-electric"></i> We respond within 24 hours, Mon to Sat, 9 AM to 7 PM IST.</p>
<button type="submit" class="w-full bg-brand-electric text-white py-4 sm:py-6 rounded-lg font-bold sm:font-medium text-sm sm:text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all hover:scale-[1.02]">Get Free Consultation</button>
</form>
</div>
</section>

<section class="py-16 sm:py-20 bg-white/40">
<div class="max-w-7xl mx-auto px-4 sm:px-6">
<h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3 text-center">What to Expect</h2>
<p class="text-slate-500 text-center max-w-2xl mx-auto mb-12">Most enquiries get a response within a few hours. Here is what happens after you fill in the form.</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
<div class="glass-card p-8">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center text-brand-electric mb-5"><span class="font-black text-sm">1</span></div>
<h3 class="text-lg font-black text-slate-900 mb-3">We Review Your Requirement</h3>
<p class="text-sm text-slate-600 leading-relaxed">Within 24 hours (usually faster), one of the founders reviews your enquiry personally. No call centres, no automated responses, your message goes directly to Dev or Jay.</p>
</div>
<div class="glass-card p-8">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center text-brand-cyan mb-5"><span class="font-black text-sm">2</span></div>
<h3 class="text-lg font-black text-slate-900 mb-3">A Short Conversation</h3>
<p class="text-sm text-slate-600 leading-relaxed">We will reach out to understand your requirement in more detail, team size, preferred location, timeline, and budget. This takes 15 minutes and helps us find the right managed office space for your team.</p>
</div>
<div class="glass-card p-8">
<div class="w-10 h-10 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center text-brand-violet mb-5"><span class="font-black text-sm">3</span></div>
<h3 class="text-lg font-black text-slate-900 mb-3">Options Within 48 Hours</h3>
<p class="text-sm text-slate-600 leading-relaxed">Based on your brief, we put together a shortlist of suitable commercial spaces or managed office options across Mumbai, with pricing, availability, and our honest recommendation for each.</p>
</div>
</div>
<div class="mt-12 max-w-3xl mx-auto">
<h2 class="text-2xl font-black text-slate-900 mb-6 text-center">Common Questions</h2>
<div class="space-y-4">
<div class="glass-card p-6">
<h3 class="font-bold text-slate-900 mb-2">Is the consultation really free?</h3>
<p class="text-sm text-slate-600 leading-relaxed">Yes, completely free for tenants. CorpEasy is a tenant representation service, we are paid by landlords and managed office operators as part of the transaction, so our search, shortlisting, and negotiation services cost you nothing.</p>
</div>
<div class="glass-card p-6">
<h3 class="font-bold text-slate-900 mb-2">How quickly can we move into a managed office space in Mumbai?</h3>
<p class="text-sm text-slate-600 leading-relaxed">For pre-fitted managed offices, move-in can happen in as little as 7-10 working days. For custom setup, the typical timeline is 3-6 weeks depending on the size and fit-out requirements. We will give you a realistic timeline at the initial consultation stage.</p>
</div>
<div class="glass-card p-6">
<h3 class="font-bold text-slate-900 mb-2">What areas do you cover in Mumbai?</h3>
<p class="text-sm text-slate-600 leading-relaxed">We work across all major commercial zones in Mumbai, BKC, Lower Parel, Andheri East, Goregaon East, Powai, Worli, and Thane. If your preferred location is not listed here, ask us anyway, we have contacts across the city.</p>
</div>
</div>
</div>
</div>
</section>

<?php include 'templates/footer.php'; ?>
