<?php
// Page-specific SEO variables (set before including this template):
// $page_title, $page_description, $page_keywords, $page_canonical, $page_og_title, $page_og_description, $page_og_image, $page_schema

// Defaults
$page_title = $page_title ?? 'CorpEasy | Managed Office Space in Mumbai - BKC, Lower Parel, Goregaon';
$page_description = $page_description ?? 'CorpEasy finds, sets up, and manages your office space in Mumbai. One point of contact. Clear per-seat monthly cost. Fixed lease. BKC, Lower Parel & Goregaon.';
$page_keywords = $page_keywords ?? 'managed office space Mumbai, office space for rent in Mumbai, commercial office space Mumbai, office space BKC, office space Lower Parel, office space Goregaon, managed workspace Mumbai, office space Andheri East, coworking space Mumbai, commercial property for lease Mumbai, workspace solutions Mumbai, office space Mumbai 2026, turnkey office space Mumbai, per seat office Mumbai';
$page_canonical = $page_canonical ?? 'https://www.corpeasy.in/';
$page_og_title = $page_og_title ?? $page_title;
$page_og_description = $page_og_description ?? $page_description;
$page_og_image = $page_og_image ?? 'https://www.corpeasy.in/CORPEASYHEADER.png';
$page_schema = $page_schema ?? '';
$page_id = $page_id ?? 'home';
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

    <!-- CRITICAL CSS - Prevents blank page flash -->
    <style>
        body{margin:0;font-family:system-ui,-apple-system,sans-serif;background:#f8fafc;color:#0f172a}
        .init-loader{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;background:#f8fafc;z-index:9999}
        .init-loader::after{content:"Loading...";font-size:14px;color:#6366f1;font-weight:500}
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

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MNJ99CDR');</script>

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
            "url": "https://www.corpeasy.in/CORPEASYHEADER.png",
            "width": 280,
            "height": 80
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
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://images.unsplash.com">
    <link rel="preload" as="image" href="modern_office.png?v=2026032102">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"></noscript>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans serif'] },
                    colors: {
                        brand: {
                            blue: '#1e3a8a',
                            electric: '#6366f1',
                            navy: '#f0f9ff',
                            cyan: '#06b6d4',
                            gold: '#fbbf24',
                            rose: '#f43f5e',
                            violet: '#8b5cf6',
                            slate: '#64748b',
                            ice: '#ffffff'
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="style.css?v=2026032301">
</head>
<body class="font-sans flex flex-col min-h-screen bg-tech-mesh">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNJ99CDR"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- Progress Line -->
    <div id="scroll-line" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-brand-electric via-brand-cyan to-brand-violet z-[1000] w-0 transition-all duration-100 shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>

    <!-- HEADER -->
    <nav role="navigation" class="fixed w-full z-[100] glass-nav transition-all duration-500 h-16 md:h-20 lg:h-28 flex items-center" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 w-full flex justify-between items-center">
            <!-- Brand -->
            <div class="flex items-center cursor-pointer group">
                <a href="/">
                    <img src="CORPEASYHEADER.png" alt="CorpEasy Header Logo" class="logo-img logo-img-light h-10 sm:h-14 lg:h-20 w-auto object-contain object-left group-hover:scale-105 transition-transform duration-300" width="140" height="80" fetchpriority="high">
                </a>
            </div>
            <!-- Navigation Links (Desktop) -->
            <div class="hidden xl:flex items-center gap-8">
                <div class="relative group">
                    <button class="text-sm font-semibold text-slate-700 flex items-center gap-2 group-hover:text-brand-electric transition-colors">
                        Solutions <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                    </button>
                    <div class="absolute top-full left-0 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-2 group-hover:translate-y-0 z-50">
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
    <div id="mobile-menu" class="fixed inset-0 bg-white/95 backdrop-blur-xl z-[90] hidden flex-col overflow-y-auto" style="padding-top: env(safe-area-inset-top, 0);">
        <div class="flex justify-between items-center px-6 py-4">
            <img src="CORPEASYHEADER.png" alt="CorpEasy" class="h-10 w-auto">
            <button onclick="document.getElementById('mobile-menu').classList.add('hidden'); document.getElementById('mobile-menu').classList.remove('flex');" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-slate-800 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="px-6 pb-8">
            <ul class="space-y-1">
                <li><a href="/" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Home</a></li>
                <li><a href="/managed-office-space-mumbai" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Managed Offices</a></li>
                <li><a href="/blog" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Insights</a></li>
                <li><a href="/office-space-for-rent-mumbai" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Find a Property</a></li>
                <li><a href="/list-commercial-property-mumbai" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">Lease Your Property</a></li>
                <li><a href="/facility-management-mumbai" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-rose cursor-pointer border-b border-slate-100/50">Facility Management</a></li>
                <li><a href="/about" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">About Us</a></li>
                <li><a href="/faq" class="block py-4 text-base font-semibold text-slate-800 hover:text-brand-electric cursor-pointer border-b border-slate-100/50">FAQ</a></li>
                <li><a href="/contact" class="block py-4 text-base font-bold text-brand-electric cursor-pointer">Contact Us</a></li>
            </ul>
            <div class="mt-8 pt-8 border-t border-slate-200">
                <a href="tel:+919833089993" class="flex items-center gap-3 py-3 text-slate-700 font-medium">
                    <i class="fas fa-phone-alt text-brand-electric"></i>
                    Dev Doshi: +91 98330 89993
                </a>
                <a href="tel:+917021134176" class="flex items-center gap-3 py-3 text-slate-700 font-medium">
                    <i class="fas fa-phone-alt text-brand-cyan"></i>
                    Jay Nishar: +91 70211 34176
                </a>
            </div>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-grow pt-16 md:pt-20 lg:pt-28">
