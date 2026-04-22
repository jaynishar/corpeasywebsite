<?php
$page_title = "Thank You | CorpEasy";
$page_description = "Thanks for reaching out. Our team will contact you within 24 hours with a clear proposal for your managed office in Mumbai.";
$page_canonical = "https://www.corpeasy.in/thank-you";
$noindex = true; // keep this page out of search results
include __DIR__ . '/templates/header.php';
?>

<!-- Fire conversion events on page load, most reliable signal for Google Ads + GA4 -->
<script>
  // Wait for gtag to be available (it loads async)
  (function fireConversion(){
    if (typeof gtag !== 'function') { setTimeout(fireConversion, 200); return; }
    // GA4 key event (make sure generate_lead is marked as "Key event" in GA4 Admin)
    gtag('event', 'generate_lead', {
      'currency': 'INR',
      'value': 5000,
      'lead_source': 'website_form'
    });
    // Google Ads conversion. Replace CONVERSION_LABEL with the label from your
    // Google Ads conversion action ("Submit lead form"), found under
    // Goals, Conversions, Summary, click the action, then "Tag setup, Use Google tag".
    gtag('event', 'conversion', {
      'send_to': 'AW-17703392736/CONVERSION_LABEL',
      'value': 5000,
      'currency': 'INR',
      'transaction_id': new Date().getTime().toString()
    });
    // GTM dataLayer for any GTM-based tags
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      'event': 'generate_lead',
      'form_type': 'website_lead',
      'value': 5000,
      'currency': 'INR'
    });
  })();
</script>

<section class="max-w-3xl mx-auto px-4 sm:px-6 py-16 lg:py-24 text-center">
  <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 mb-6">
    <i class="fas fa-check text-green-600 text-3xl"></i>
  </div>
  <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 leading-tight">
    Thanks, we got your details.
  </h1>
  <p class="text-base lg:text-lg text-slate-600 max-w-xl mx-auto mb-8 leading-relaxed">
    One of our managed office specialists will call you within <strong class="text-slate-800">24 hours</strong> on the number you shared, with a clear proposal. No broker jargon. No hidden charges.
  </p>

  <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-8 mb-8 text-left">
    <h2 class="text-lg font-bold text-slate-900 mb-4">While you wait</h2>
    <ul class="space-y-3 text-sm text-slate-600">
      <li class="flex items-start gap-3"><i class="fas fa-check-circle text-green-500 mt-1"></i> <span>Check our <a href="/managed-office-space-mumbai" class="text-brand-electric font-semibold hover:underline">managed office guide</a> to see how CorpEasy sets up and runs your office.</span></li>
      <li class="flex items-start gap-3"><i class="fas fa-check-circle text-green-500 mt-1"></i> <span>Read <a href="/managed-office-vs-coworking" class="text-brand-electric font-semibold hover:underline">Managed Office vs Coworking</a> to understand why we are different.</span></li>
      <li class="flex items-start gap-3"><i class="fas fa-check-circle text-green-500 mt-1"></i> <span>Browse office options in <a href="/managed-office-bkc" class="text-brand-electric font-semibold hover:underline">BKC</a>, <a href="/managed-office-lower-parel" class="text-brand-electric font-semibold hover:underline">Lower Parel</a>, <a href="/managed-office-goregaon" class="text-brand-electric font-semibold hover:underline">Goregaon</a>, <a href="/managed-office-andheri" class="text-brand-electric font-semibold hover:underline">Andheri</a>.</span></li>
    </ul>
  </div>

  <div class="flex flex-col sm:flex-row gap-3 justify-center">
    <a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20just%20filled%20the%20form%20on%20your%20website." target="_blank" rel="noopener" class="bg-green-500 text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-green-600 transition-all flex items-center justify-center gap-2">
      <i class="fab fa-whatsapp"></i> WhatsApp us now
    </a>
    <a href="tel:+919833089993" class="bg-slate-900 text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
      <i class="fas fa-phone"></i> Call +91 98330 89993
    </a>
    <a href="/" class="bg-white border border-slate-300 text-slate-700 px-6 py-3 rounded-lg font-medium text-sm hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
      <i class="fas fa-arrow-left"></i> Back to home
    </a>
  </div>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
