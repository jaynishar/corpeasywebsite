<?php
// Page-specific SEO variables (set before including this template):
// $page_title, $page_description, $page_keywords, $page_canonical, $page_og_title, $page_og_description, $page_og_image, $page_schema

// Defaults
$page_title = $page_title ?? 'Managed Office Space Mumbai | From ₹10,000/Seat | CorpEasy';
$page_description = $page_description ?? 'CorpEasy finds, sets up, and manages your office space in Mumbai. One point of contact. Clear per-seat monthly cost. Fixed lease. BKC, Lower Parel & Goregaon.';
$page_keywords = $page_keywords ?? 'managed office space Mumbai, office space for rent in Mumbai, commercial office space Mumbai, office space BKC, office space Lower Parel, office space Goregaon, managed workspace Mumbai, office space Andheri East, coworking space Mumbai, commercial property for lease Mumbai, workspace solutions Mumbai, office space Mumbai 2026, turnkey office space Mumbai, per seat office Mumbai';
$page_canonical = $page_canonical ?? 'https://www.corpeasy.in/';
$page_og_title = $page_og_title ?? $page_title;
$page_og_description = $page_og_description ?? $page_description;
$page_og_image = $page_og_image ?? 'https://www.corpeasy.in/CORPEASYHEADER.png';
$page_schema = $page_schema ?? '';
$page_id = $page_id ?? 'home';
$page_lcp_image = $page_lcp_image ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="geo.region" content="IN-MH">
    <meta name="geo.placename" content="Mumbai, Maharashtra">
    <meta name="geo.position" content="19.0176;72.8562">
    <meta name="ICBM" content="19.0176, 72.8562">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%231e3a8a'/><text y='72' x='50' text-anchor='middle' font-size='60' font-family='sans-serif' fill='white' font-weight='900'>CE</text></svg>">
    <meta name="theme-color" content="#1e3a8a">

    <!-- CRITICAL CSS — above-the-fold only, eliminates render-blocking for FCP -->
    <style>
        *,*::before,*::after{box-sizing:border-box}
        html{max-width:100vw;overflow-x:hidden;scroll-behavior:smooth}
        body{margin:0;padding:0;font-family:'Plus Jakarta Sans',system-ui,-apple-system,sans-serif;background:#f8fafc;color:#0f172a;overflow-x:hidden;-webkit-font-smoothing:antialiased}
        /* Navbar */
        #navbar{position:fixed!important;top:0;left:0;right:0;width:100%;z-index:100;background:rgba(255,255,255,0.96);border-bottom:1px solid rgba(226,232,240,0.6);box-shadow:0 1px 8px rgba(0,0,0,0.04);height:4rem;display:flex;align-items:center;transition:box-shadow 0.3s}
        @media(min-width:768px){#navbar{height:5rem}}
        @media(min-width:1024px){#navbar{height:7rem}}
        /* Main offset */
        main.flex-grow{padding-top:4rem}
        @media(min-width:768px){main.flex-grow{padding-top:5rem}}
        @media(min-width:1024px){main.flex-grow{padding-top:7rem}}
        /* Layout */
        .flex{display:flex}.flex-col{flex-direction:column}.min-h-screen{min-height:100vh}.flex-grow{flex-grow:1}.items-center{align-items:center}.justify-between{justify-content:space-between}.w-full{width:100%}
        /* Background */
        .bg-tech-mesh{background-color:#f8fafc;background-image:radial-gradient(circle at 15% 50%,rgba(99,102,241,.12),transparent 30%),radial-gradient(circle at 85% 30%,rgba(6,182,212,.12),transparent 30%),linear-gradient(rgba(15,23,42,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(15,23,42,.03) 1px,transparent 1px);background-size:100% 100%,100% 100%,30px 30px,30px 30px}
        /* Typography */
        h1,h2,h3{letter-spacing:-.03em;line-height:1.1;font-weight:800;word-break:break-word;overflow-wrap:break-word}
        @media(max-width:640px){h1{font-size:clamp(2rem,10vw,3rem)!important;line-height:1.1!important}h2{font-size:clamp(1.75rem,8vw,2.5rem)!important}}
        /* Glass card (hero form visible immediately) */
        .glass-card{background:rgba(255,255,255,0.85);border:1px solid rgba(255,255,255,1);border-radius:2.5rem;box-shadow:0 10px 30px -10px rgba(15,23,42,.05),inset 0 0 0 1px rgba(255,255,255,.5)}
        /* Input */
        .input-premium{background:rgba(255,255,255,0.8);border:1px solid rgba(203,213,225,0.8);padding:1.25rem 1.5rem;border-radius:1rem;width:100%;color:#0f172a;font-weight:500;font-size:1rem;transition:all .3s ease}
        @media(max-width:768px){.input-premium{font-size:16px;padding:1rem 1.25rem}}
        /* Text gradients */
        .text-gradient-vibrant{background:linear-gradient(135deg,#6366f1 0%,#06b6d4 50%,#8b5cf6 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
        .text-gradient{background:linear-gradient(135deg,#334155 0%,#0f172a 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
        /* Reveal animation — GPU-only properties, subtle 16px lift */
        .reveal{opacity:0;transform:translateY(16px);transition:opacity 0.65s cubic-bezier(.16,1,.3,1),transform 0.65s cubic-bezier(.16,1,.3,1)}
        .reveal.active{opacity:1;transform:translateY(0)}
        .delay-100{transition-delay:100ms}.delay-200{transition-delay:200ms}.delay-300{transition-delay:300ms}
        /* Page entrance — fires on every load, cinematic fade-up */
        @keyframes pageEnter{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
        .page-enter{animation:pageEnter 0.45s cubic-bezier(.16,1,.3,1) 0.04s both}
        /* Scroll progress bar */
        #scroll-line{position:fixed;top:0;left:0;height:4px;background:linear-gradient(90deg,#6366f1,#06b6d4,#8b5cf6);z-index:1000;width:0;transition:width .1s;box-shadow:0 0 15px rgba(99,102,241,.5)}
        /* Font Awesome — block display prevents icon boxes; icons invisible until loaded */
        @font-face{font-family:'Font Awesome 6 Free';font-display:block}
        @font-face{font-family:'Font Awesome 6 Brands';font-display:block}
        @font-face{font-family:'Font Awesome 6 Free';font-style:normal;font-weight:900;font-display:block}
        /* Plus Jakarta Sans fallback — prevents font-swap layout shift */
        @font-face{font-family:'Plus Jakarta Sans';font-display:optional}
        /* Prevent image overflow */
        img,video,iframe,canvas,svg{max-width:100%}
        section{max-width:100vw;overflow-x:hidden}
        /* Logo fixed size — prevents FOUC/enlarge before tailwind.min.css loads */
        .logo-img{height:2.5rem!important;width:auto!important}
        @media(min-width:640px){.logo-img{height:3.5rem!important;width:auto!important}}
        @media(min-width:1024px){.logo-img{height:5rem!important;width:auto!important}}
        /* Prevent CLS: ensure positioning classes work before Tailwind loads */
        .glow-blob,.orb-drift{position:absolute;pointer-events:none;overflow:hidden}
        .fixed{position:fixed}.absolute{position:absolute}.relative{position:relative}
        .inset-0{inset:0}.pointer-events-none{pointer-events:none}.overflow-hidden{overflow:hidden}.z-0{z-index:0}
        /* Hide JS-controlled elements before Tailwind loads — prevents flash */
        /* transition:none!important blocks any CSS transition firing during async CSS load */
        #solutions-panel{opacity:0;visibility:hidden;transition:none!important}
        #fab-container{opacity:0;pointer-events:none;transition:none!important}
        /* Mobile performance: disable heavy animations on low-end devices */
        @media(max-width:768px){
            .orb-drift{display:none!important}
            .glow-blob{display:none!important}
            .reveal{opacity:1;transform:none;transition:none}
            .page-enter{animation:none;opacity:1;transform:none}
            .tilt-shine{display:none!important}
        }
    </style>

    <!-- SEO -->
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($page_canonical); ?>">
    <link rel="alternate" hreflang="en-IN" href="<?php echo htmlspecialchars($page_canonical); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($page_canonical); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="CorpEasy">

    <!-- Google Tag Manager (deferred until user interaction or 5s idle — eliminates main-thread blocking) -->
    <script>
    (function(w,d,s,l,i){
      w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
      function loadGTM(){var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);loaded=true}
      var loaded=false;
      ['mousemove','keydown','touchstart','scroll'].forEach(function(e){d.addEventListener(e,function(){if(!loaded){loaded=true;loadGTM()}},{once:true})});
      setTimeout(function(){if(!loaded){loaded=true;loadGTM()}},5000);
    })(window,document,'script','dataLayer','GTM-MNJ99CDR');
    </script>

    <!-- Google Analytics 4 (GA4) — deferred until user interaction or 5s idle -->
    <script>
    (function(){
      function loadGA4(){
        if(window.ga4loaded) return;
        window.ga4loaded=true;
        window.dataLayer=window.dataLayer||[];
        function gtag(){dataLayer.push(arguments)}
        gtag('js',new Date());
        gtag('config','G-SHF2TZQSEQ',{send_page_view:true});
        var s=document.createElement('script');s.async=true;
        s.src='https://www.googletagmanager.com/gtag/js?id=G-SHF2TZQSEQ';
        document.head.appendChild(s);
      }
      ['mousemove','keydown','touchstart','scroll'].forEach(function(e){
        document.addEventListener(e,function(){loadGA4()},{once:true});
      });
      setTimeout(loadGA4,5000);
    })();
    </script>

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_og_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_og_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($page_canonical); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($page_og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo htmlspecialchars($page_og_title); ?>">
    <meta property="og:locale" content="en_IN">
    <meta property="og:site_name" content="CorpEasy">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@corpeasy">
    <meta name="twitter:creator" content="@corpeasy">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_og_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_og_description); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($page_og_image); ?>">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": ["LocalBusiness", "ProfessionalService"],
          "@id": "https://www.corpeasy.in/#organization",
          "name": "CorpEasy",
          "alternateName": "CorpEasy Enterprise Solutions",
          "description": "CorpEasy provides managed office spaces, tenant representation, lease advisory, and facility management services for startups, SMEs, and enterprises across Mumbai.",
          "url": "https://www.corpeasy.in/",
          "logo": {
            "@type": "ImageObject",
            "url": "https://www.corpeasy.in/CORPEASYHEADER-sm.png",
            "width": 400,
            "height": 225
          },
          "image": "https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&q=80&w=1200&h=630",
          "telephone": "+919833089993",
          "email": "devdoshi@corpeasy.in",
          "foundingDate": "2025-10",
          "foundingLocation": "Mumbai, Maharashtra, India",
          "founder": [
            { "@type": "Person", "name": "Dev Doshi", "jobTitle": "Co-Founder, Business Development & Strategy" },
            { "@type": "Person", "name": "Jay Nishar", "jobTitle": "Co-Founder, Operations & Growth" }
          ],
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Office No. 30, 2nd Floor, Gopal Bhavan, Shamaldas Gandhi Marg, Marine Lines",
            "addressLocality": "Mumbai",
            "addressRegion": "Maharashtra",
            "postalCode": "400002",
            "addressCountry": "IN"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 19.0176,
            "longitude": 72.8562
          },
          "areaServed": [
            {"@type": "City", "name": "Mumbai"},
            {"@type": "Place", "name": "BKC, Mumbai"},
            {"@type": "Place", "name": "Lower Parel, Mumbai"},
            {"@type": "Place", "name": "Goregaon, Mumbai"},
            {"@type": "Place", "name": "Andheri, Mumbai"}
          ],
          "contactPoint": [
            {
              "@type": "ContactPoint",
              "telephone": "+919833089993",
              "contactType": "sales",
              "areaServed": "IN",
              "availableLanguage": ["English", "Hindi"],
              "hoursAvailable": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
                "opens": "09:00",
                "closes": "19:00"
              }
            },
            {
              "@type": "ContactPoint",
              "telephone": "+917021134176",
              "contactType": "customer service",
              "areaServed": "IN",
              "availableLanguage": ["English", "Hindi"]
            }
          ],
          "priceRange": "₹10,000 - ₹40,000 per seat/month",
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
              "opens": "09:00",
              "closes": "19:00"
            }
          ],
          "knowsAbout": [
            "Managed Office Space",
            "Commercial Real Estate Mumbai",
            "Office Space for Rent Mumbai",
            "Facility Management",
            "Tenant Representation",
            "Commercial Lease Negotiation"
          ],
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5.0",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "12",
            "reviewCount": "12"
          },
          "sameAs": [
            "https://www.linkedin.com/company/corpeasy",
            "https://www.instagram.com/corpeasy",
            "https://twitter.com/corpeasy"
          ],
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "CorpEasy Services",
            "itemListElement": [
              {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Managed Office Space Mumbai", "url": "https://www.corpeasy.in/managed-office-space-mumbai"}},
              {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Office Space for Rent Mumbai", "url": "https://www.corpeasy.in/office-space-for-rent-mumbai"}},
              {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Facility Management Services Mumbai", "url": "https://www.corpeasy.in/facility-management-mumbai"}},
              {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "List Commercial Property Mumbai", "url": "https://www.corpeasy.in/list-commercial-property-mumbai"}}
            ]
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://www.corpeasy.in/#website",
          "url": "https://www.corpeasy.in/",
          "name": "CorpEasy",
          "description": "Managed office space, commercial property search, and facility management in Mumbai.",
          "publisher": { "@id": "https://www.corpeasy.in/#organization" }
        },
        {
          "@type": "BreadcrumbList",
          "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.corpeasy.in/" }
            <?php if ($page_id !== 'home'): ?>
            ,{ "@type": "ListItem", "position": 2, "name": "<?php echo htmlspecialchars($page_title); ?>", "item": "<?php echo htmlspecialchars($page_canonical); ?>" }
            <?php endif; ?>
          ]
        }
        <?php if (!empty($page_schema)): ?>
        ,<?php echo $page_schema; ?>
        <?php endif; ?>
      ]
    }
    </script>

    <!-- Resource Hints -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://images.unsplash.com">

    <!-- Preload critical font (weight 800 for H1 LCP) — cuts 1-2s off LCP for text-based pages -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@800&display=swap" onload="this.rel='stylesheet'">

    <?php if (!empty($page_lcp_image)): ?>
    <!-- LCP image preload — tells browser to fetch hero image immediately -->
    <link rel="preload" as="image" href="<?php echo htmlspecialchars($page_lcp_image); ?>" fetchpriority="high">
    <?php endif; ?>

    <!-- Tailwind = render-blocking (controls all layout — async causes FOUC) -->
    <link rel="stylesheet" href="/tailwind.min.css?v=20260403">
    <!-- Style.css = non-blocking (decorative animations, card styles, etc.) -->
    <link rel="stylesheet" href="/style.min.css?v=20260403" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="/style.min.css?v=20260403"></noscript>

    <!-- Font (non-blocking) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>

    <!-- Font Awesome — preload webfont so icons appear fast, not as boxes -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
</head>
<body class="font-sans flex flex-col min-h-screen bg-tech-mesh">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNJ99CDR"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- Progress Line -->
    <div id="scroll-line" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-brand-electric via-brand-cyan to-brand-violet z-[1000] w-0 shadow-[0_0_15px_rgba(99,102,241,0.5)]" style="will-change:width"></div>

    <!-- HEADER -->
    <nav role="navigation" class="fixed w-full z-[100] glass-nav transition-all duration-500 h-16 md:h-20 lg:h-28 flex items-center" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 w-full flex justify-between items-center">
            <!-- Brand -->
            <div class="flex items-center cursor-pointer group">
                <a href="/">
                    <picture>
                        <source srcset="/CORPEASYHEADER-sm.webp" type="image/webp">
                        <img src="/CORPEASYHEADER-sm.png" alt="CorpEasy Header Logo" class="logo-img logo-img-light h-10 sm:h-14 lg:h-20 w-auto object-contain object-left group-hover:scale-105 transition-transform duration-300" width="400" height="225" fetchpriority="high">
                    </picture>
                </a>
            </div>
            <!-- Navigation Links (Desktop) -->
            <div class="hidden xl:flex items-center gap-8">
                <div class="relative" id="solutions-nav">
                    <button id="solutions-btn" class="text-sm font-semibold text-slate-700 flex items-center gap-2 hover:text-brand-electric transition-colors">
                        Solutions <i id="solutions-chevron" class="fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
                    </button>
                    <div id="solutions-panel" class="absolute top-full left-0 pt-4 opacity-0 invisible transition-[opacity,transform,visibility] duration-200 translate-y-2 z-50">
                        <div class="bg-white rounded-3xl shadow-[0_30px_60px_-15px_rgba(0,0,0,0.15)] border border-slate-100 p-4 w-[460px] min-w-[460px] space-y-2 !max-w-none">
                            <a href="/managed-office-space-mumbai" class="flex items-center gap-5 p-4 rounded-2xl hover:bg-brand-navy border border-transparent hover:border-brand-electric/10 transition-all cursor-pointer group/item">
                                <div class="w-12 h-12 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-brand-electric group-hover/item:bg-brand-electric group-hover/item:text-white transition-all duration-300"><i class="fas fa-building text-lg"></i></div>
                                <div><p class="text-[15px] font-bold text-slate-800 group-hover/item:text-brand-electric transition-colors">Managed Office Space</p><p class="text-xs text-slate-500 font-medium">End-to-end workspace setup & operation</p></div>
                            </a>
                            <a href="/office-space-for-rent-mumbai" class="flex items-center gap-5 p-4 rounded-2xl hover:bg-brand-navy border border-transparent hover:border-brand-cyan/10 transition-all cursor-pointer group/item">
                                <div class="w-12 h-12 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-brand-cyan group-hover/item:bg-brand-cyan group-hover/item:text-white transition-all duration-300"><i class="fas fa-search-location text-lg"></i></div>
                                <div><p class="text-[15px] font-bold text-slate-800 group-hover/item:text-brand-cyan transition-colors">Find a Property</p><p class="text-xs text-slate-500 font-medium">Expert negotiation & tenant representation</p></div>
                            </a>
                            <a href="/list-commercial-property-mumbai" class="flex items-center gap-5 p-4 rounded-2xl hover:bg-brand-navy border border-transparent hover:border-brand-gold/10 transition-all cursor-pointer group/item">
                                <div class="w-12 h-12 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-brand-gold group-hover/item:bg-brand-gold group-hover/item:text-white transition-all duration-300"><i class="fas fa-handshake text-lg"></i></div>
                                <div><p class="text-[15px] font-bold text-slate-800 group-hover/item:text-brand-gold transition-colors">Lease Your Property</p><p class="text-xs text-slate-500 font-medium">Quality tenants for your commercial asset</p></div>
                            </a>
                            <div class="h-px bg-slate-100/80 mx-4 my-1"></div>
                            <a href="/facility-management-mumbai" class="flex items-center gap-5 p-4 rounded-2xl hover:bg-brand-navy border border-transparent hover:border-brand-rose/10 transition-all cursor-pointer group/item">
                                <div class="w-12 h-12 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-brand-rose group-hover/item:bg-brand-rose group-hover/item:text-white transition-all duration-300"><i class="fas fa-tools text-lg"></i></div>
                                <div><p class="text-[15px] font-bold text-slate-800 group-hover/item:text-brand-rose transition-colors">Facility Management</p><p class="text-xs text-slate-500 font-medium">Professional office maintenance & logistics</p></div>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="/blog" class="text-sm font-medium text-slate-600 hover:text-brand-electric cursor-pointer transition-colors">Insights</a>
                <a href="/about" class="text-sm font-medium text-slate-600 hover:text-brand-electric cursor-pointer transition-colors">About Us</a>
                <a href="/faq" class="text-sm font-medium text-slate-600 hover:text-brand-electric cursor-pointer transition-colors">FAQ</a>
                <a href="/contact" class="text-sm font-medium text-slate-600 hover:text-brand-electric cursor-pointer transition-colors">Contact</a>
            </div>

            <!-- Action -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="/contact" class="hidden md:flex items-center gap-2 bg-brand-electric text-white px-4 py-2 rounded-lg text-xs sm:text-sm font-medium hover:bg-brand-blue transition-all shadow-sm">
                    Get Free Consultation
                </a>
                <button id="mobile-trigger" aria-label="Toggle Mobile Menu" class="xl:hidden flex items-center justify-center w-10 h-10 bg-white/80 hover:bg-white rounded-lg border border-slate-200 text-slate-700 transition-all shadow-sm">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="fixed inset-0 bg-white z-[90] hidden flex-col overflow-y-auto" style="padding-top: env(safe-area-inset-top, 0);">
        <div class="flex justify-between items-center px-6 py-4">
            <picture>
                <source srcset="/CORPEASYHEADER.webp" type="image/webp">
                <img src="/CORPEASYHEADER.png" alt="CorpEasy" class="h-10 w-auto" width="140" height="40">
            </picture>
            <button onclick="document.getElementById('mobile-menu').classList.add('hidden'); document.getElementById('mobile-menu').classList.remove('flex');" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-slate-800 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="px-6 pb-8">
            <ul class="space-y-1">
                <li><a href="/" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Home</a></li>
                <li><a href="/managed-office-space-mumbai" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Managed Offices</a></li>
                <li><a href="/blog" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Insights</a></li>
                <li><a href="/office-space-for-rent-mumbai" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Find a Property</a></li>
                <li><a href="/list-commercial-property-mumbai" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Lease Your Property</a></li>
                <li><a href="/facility-management-mumbai" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-rose cursor-pointer border-b border-slate-100/50">Facility Management</a></li>
                <li><a href="/about" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">About Us</a></li>
                <li><a href="/faq" class="flex items-center min-h-[48px] py-2 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">FAQ</a></li>
                <li><a href="/contact" class="flex items-center min-h-[48px] py-2 text-base font-bold text-brand-electric cursor-pointer">Contact Us</a></li>
            </ul>
            <div class="mt-8 pt-8 border-t border-slate-200">
                <a href="tel:+919833089993" class="flex items-center gap-3 min-h-[48px] py-2 text-slate-700 font-medium">
                    <i class="fas fa-phone-alt text-brand-electric"></i>
                    Dev Doshi: +91 98330 89993
                </a>
                <a href="tel:+917021134176" class="flex items-center gap-3 min-h-[48px] py-2 text-slate-700 font-medium">
                    <i class="fas fa-phone-alt text-brand-cyan"></i>
                    Jay Nishar: +91 70211 34176
                </a>
            </div>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-grow pt-16 md:pt-20 lg:pt-28 page-enter">
