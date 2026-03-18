const portal = document.getElementById('view-portal');
let activeChart = null;
let heroWordInterval = null;

// --- ARTICLE DATA REPOSITORY ---
const postData = {
    'mumbai outlook': {
        title: "The 2026 Mumbai GCC Outlook: Why Managed HQs are Winning.",
        category: "Market Report",
        readTime: "8 Min Read",
        image: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200",
        content: `
            <p>Global Capability Centers (GCCs) are undergoing a radical shift in their real estate procurement strategy. Traditionally, large scale multinationals entering the Mumbai market preferred long term leaseholds where they managed their own fit outs and operations. However, our 2026 Outlook report identifies a distinct trend towards Institutional Managed Workspaces.</p>
            <h3>The Capital Efficiency Factor</h3>
            <p>In a high interest rate environment, preserving treasury capital has become a priority for CFOs. Managed office providers like CorpEasy allow enterprises to move from a heavy CapEx model to a predictable OpEx model. By funding 100% of the fit out, we enable MNCs to deploy their capital into core business functions—R&D, talent acquisition, and digital transformation—rather than interior civil work.</p>
            <h3>Speed to Market as a Competitive Advantage</h3>
            <p>A traditional office setup in Mumbai takes 6 to 9 months from property identification to "power on" status. In contrast, the managed model promises delivery quickly. This agility is crucial for GCCs competing for talent in the BKC and Goregaon micro markets.</p>
            <p>As we look towards the end of 2026, we expect over 70% of new office absorption in the 50,000+ sq ft bracket to be managed by institutional operators who can guarantee global ESG compliance and 99.9% operational uptime.</p>
        `
    },
    'neuro architecture': {
        title: "Neuro Architecture: Boosting Productivity by 15%",
        category: "Design Strategy",
        readTime: "5 Min Read",
        image: "https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200",
        content: `
            <p>The relationship between the physical environment and cognitive performance is no longer theoretical. Recent studies in neuro architecture demonstrate that workspace design directly impacts cortisol levels and focus durations.</p>
            <h3>Biophilic Integration</h3>
            <p>By incorporating specific patterns of natural light and greenery (biophilia), we've observed a 15% increase in creative problem solving capabilities within tech teams. This isn't just about putting plants on desks; it's about the fractal patterns in ceiling design and the spectral quality of lighting.</p>
            <h3>Zonal Acoustics</h3>
            <p>The "death of the open office" is being replaced by "Activity Based Working." In our Goregaon facility, we implemented acoustic baffles that create silent zones for deep work and high energy zones for collaboration, reducing cognitive load and increasing team satisfaction.</p>
        `
    },
    'bkc vs-goregaon': {
        title: "BKC vs Goregaon: The Battle for Grade A Superiority",
        category: "Market Trends",
        readTime: "6 Min Read",
        image: "https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200",
        content: `
            <p>Mumbai's commercial landscape is split between the premium status of Bandra Kurla Complex (BKC) and the emerging, cost efficient infrastructure of Goregaon East. For enterprises planning a 500-seat expansion, the choice isn't just about the rent per square foot—it's about the "Total Cost of Occupancy."</p>
            <h3>The BKC Premium</h3>
            <p>BKC remains the global finance hub. Rental yields here are significantly higher, but the connectivity and prestige attract a specific tier of high value consulting and banking firms. However, congestion remains a challenge for employee retention.</p>
            <h3>Goregaon's Strategic Value</h3>
            <p>Goregaon, specifically near the Western Express Highway, offers newer Grade A assets with much larger floor plates. For GCCs requiring scale and modern campus style amenities, Goregaon provides a 30-40% rental discount compared to BKC while offering superior metro connectivity.</p>
        `
    },
    'gst rental': {
        title: "Impact of GST on Office Rental Outflows",
        category: "Corporate Finance",
        readTime: "4 Min Read",
        image: "https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800",
        content: `
            <p>Tax compliance is a critical component of institutional real estate. Understanding the flow of Input Tax Credit (ITC) on commercial rentals is essential for MNCs moving their headquarters to Mumbai.</p>
            <h3>Reverse Charge Mechanisms</h3>
            <p>With recent regulatory updates, the treatment of GST on commercial leases has become more nuanced. CorpEasy’s managed model simplifies this by providing a single, consolidated invoice that includes property tax, maintenance, and facility management—making tax reconciliation significantly easier for corporate finance departments.</p>
        `
    }
};

function showToast(message, type = 'success') {
    const existing = document.getElementById('ce-toast');
    if (existing) existing.remove();
    
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        info: 'bg-brand-electric'
    };
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle', 
        info: 'fa-info-circle'
    };
    
    const toast = document.createElement('div');
    toast.id = 'ce-toast';
    toast.className = `fixed top-28 right-6 z-[500] ${colors[type]} text white px-6 py-4 rounded-2xl shadow-2xl flex items center gap-3 text sm font bold transition all duration-500 max w sm`;
    toast.style.transform = 'translateX(120%)';
    toast.innerHTML = `<i class="fas ${icons[type]}"></i> ${message}`;
    document.body.appendChild(toast);
    
    requestAnimationFrame(() => {
        toast.style.transform = 'translateX(0)';
    });
    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

// --- NAVIGATION ENGINE ---
function navigateTo(pageId, fromHash = false) {
    document.getElementById('mobile-menu').classList.add('hidden');
    
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.style.transition = 'none';
        loader.style.width = '0%';
        loader.style.opacity = '1';
        requestAnimationFrame(() => {
            loader.style.transition = 'width 0.35s ease';
            loader.style.width = '70%';
        });
    }

    const existingProgress = document.getElementById('reading-progress');
    if (existingProgress) existingProgress.remove();

    // Robust SPA Hash Routing
    if (!fromHash && pageId !== 'post-detail') {
        if (window.location.hash !== '#' + pageId) {
            window.location.hash = pageId;
            return; // Exit and let the hashchange event trigger the UI rendering
        }
    }

    // Clean up Article Schema if navigating away from a post
    if (pageId !== 'post-detail') {
        const existingSchema = document.getElementById('article-schema');
        if (existingSchema) existingSchema.remove();
    }

    portal.style.opacity = '0';
    portal.style.transform = 'translateY(15px)';
    
    setTimeout(() => {
        window.scrollTo(0, 0);
        if(activeChart) { activeChart.destroy(); activeChart = null; }
        
        portal.innerHTML = `<div class="page-transition">${pages[pageId] || pages['home']}</div>`;
        portal.style.opacity = '1';
        portal.style.transform = 'translateY(0)';
        
        if (pageId === 'home' || !pageId) initHomeLogic();
        initRevealObserver();
        initCountUps();
        initTiltCards();

        // Highlight active nav item
        document.querySelectorAll('[onclick^="navigateTo"]').forEach(el => {
            el.classList.remove('text-brand-electric', 'font-black');
            if (el.tagName === 'A' && el.classList.contains('text-xs')) {
                el.classList.add('text-slate-600');
            }
        });
        const activeLinks = document.querySelectorAll(`[onclick="navigateTo('${pageId}')"]`);
        activeLinks.forEach(el => {
            el.classList.remove('text-slate-600');
            el.classList.add('text-brand-electric', 'font-black');
        });

        if (loader) {
            loader.style.width = '100%';
            setTimeout(() => { loader.style.opacity = '0'; loader.style.width = '0%'; }, 400);
        }

        // Pro Mode Tracking: Virtual Pageview for SPA
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'virtual_pageview',
            'page_path': '/' + (pageId || 'home'),
            'page_title': 'CorpEasy | ' + (pageId || 'home').charAt(0).toUpperCase() + (pageId || 'home').slice(1)
        });
    }, 350);
}

// --- ARTICLE VIEWER ---
function viewPost(postId) {
    const post = postData[postId];
    if(!post) return;

    // Remove existing article schema if present
    const existingSchema = document.getElementById('article-schema');
    if (existingSchema) existingSchema.remove();

    // Inject Article Schema
    const schemaScript = document.createElement('script');
    schemaScript.type = 'application/ld+json';
    schemaScript.id = 'article-schema';
    schemaScript.text = JSON.stringify({
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": post.title,
        "datePublished": "2026-03-01",
        "author": {"@type": "Organization", "name": "CorpEasy Research"},
        "publisher": {"@id": "https://www.corpeasy.in/#organization"}
    });
    document.head.appendChild(schemaScript);

    const postTemplate = `
        <section class="max-w-4xl mx-auto px-6 py-12 lg:py-24">
            <button onclick="navigateTo('blog')" class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-electric transition-colors mb-12">
                <i class="fas fa-arrow-left"></i> Back to Insights
            </button>
            
            <div class="mb-12">
                <span class="px-4 py-1.5 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-[10px] font-bold rounded-full uppercase tracking-widest mb-6 inline-block">${post.category}</span>
                <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">${post.title}</h1>
                <div class="flex items-center gap-6 text-slate-600 text-sm font-medium">
                    <span><i class="far fa-clock mr-2 text-brand-electric"></i> ${post.readTime}</span>
                    <span><i class="far fa-calendar-alt mr-2 text-brand-electric"></i> March 2026</span>
                    <span><i class="far fa-user mr-2 text-brand-electric"></i> By CorpEasy Research</span>
                </div>
            </div>

            <div class="rounded-[3rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.1)] h-[400px] lg:h-[550px] mb-16 border border-white/80">
                <img loading="lazy" src="${post.image}" alt="${post.title}" class="w-full h-full object-cover">
            </div>

            <div class="prose-content">
                ${post.content}
            </div>

            <div class="mt-24 pt-16 border-t border-white/80 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Share this report</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-linkedin-in text-lg"></i></a>
                        <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-twitter text-lg"></i></a>
                        <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fas fa-link text-lg"></i></a>
                    </div>
                </div>
                <button onclick="navigateTo('contact')" class="bg-brand-electric text-white px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:scale-105 transition-all">Discuss these findings</button>
            </div>
        </section>
    `;

    pages['post-detail'] = postTemplate;
    navigateTo('post-detail');

    // Pro Mode Tracking: Article View
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        'event': 'article_view',
        'article_id': postId,
        'article_title': post.title
    });

    // Reading progress bar for articles
    setTimeout(() => {
        const article = document.querySelector('.prose-content');
        if (!article) return;
        const progressBar = document.createElement('div');
        progressBar.id = 'reading-progress';
        progressBar.className = 'fixed top-1 left-0 h-0.5 bg-brand-electric z-[998] w-0';
        progressBar.style.transition = 'width 0.1s linear';
        document.body.appendChild(progressBar);
        
        const updateProgress = () => {
            const articleRect = article.getBoundingClientRect();
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrolled = Math.max(0, -articleRect.top);
            const percent = Math.min(100, (scrolled / (articleHeight - windowHeight)) * 100);
            if (document.getElementById('reading-progress')) document.getElementById('reading-progress').style.width = percent + '%';
        };
        
        window.addEventListener('scroll', updateProgress, { passive: true });
    }, 400);
}

let roiEngaged = false;
// --- ROI ENGINE ---
function updateROI() {
    const seats = parseInt(document.getElementById('roi-slider').value);
    
    if (!roiEngaged) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({event: 'roi_calculator_engaged', seat_count: seats});
        roiEngaged = true;
    }
    
    document.getElementById('roi-seat-count').innerText = seats.toLocaleString();
    
    const capexPreserved = (seats * 1.95).toFixed(0); 
    const annualSavings = (seats * 5.4 * 12 / 100).toFixed(1);
    
    const capexVal = parseInt(capexPreserved);
    const savingsVal = parseFloat(annualSavings);

    document.getElementById('roi-capex').innerText = capexVal > 1000 ? (capexVal/100).toFixed(1) + " Cr" : capexVal.toLocaleString() + " L";
    document.getElementById('roi-savings').innerText = savingsVal > 100 ? (savingsVal/100).toFixed(1) + " Cr" : savingsVal.toLocaleString() + " L";

    if(activeChart) {
        const modifier = seats / 400;
        activeChart.data.datasets[1].data = [35, 60, 95, 130 + (modifier * 15), 170 + (modifier * 25)];
        activeChart.update('none'); 
    }
}

function initHomeLogic() {
    const ctx = document.getElementById('kineticChart');
    if(ctx) {
        Chart.defaults.color = '#475569';
        Chart.defaults.font.family = 'Plus Jakarta Sans';
        
        activeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Yr 1', 'Yr 2', 'Yr 3', 'Yr 4', 'Yr 5'],
                datasets: [
                    { label: 'Traditional Office', data: [80, 110, 150, 200, 260], borderColor: '#cbd5e1', borderWidth: 2, borderDash: [5, 5], tension: 0.4, pointRadius: 0 },
                    { 
                        label: 'CorpEasy Managed', 
                        data: [35, 60, 95, 140, 180], 
                        borderColor: '#6366f1', 
                        borderWidth: 4, 
                        tension: 0.4, 
                        fill: true, 
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                            gradient.addColorStop(0, 'rgba(99, 102, 241, 0)');
                            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)');
                            return gradient;
                        },
                        pointRadius: 6, pointBackgroundColor: '#6366f1', pointBorderColor: '#ffffff', pointBorderWidth: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { display: false }, 
                    x: { 
                        grid: { display: false }, 
                        ticks: { font: { weight: '700', size: 11 }, color: '#94a3b8' } 
                    } 
                }
            }
        });
        updateROI();
    }

    if (heroWordInterval) clearInterval(heroWordInterval);
    const heroWords = ['Work.', 'Scale.', 'HQ.', 'Growth.'];
    let wordIndex = 0;
    const heroWordEl = document.getElementById('hero-word');
    if (heroWordEl) {
        heroWordInterval = setInterval(() => {
            heroWordEl.style.opacity = '0';
            heroWordEl.style.transform = 'translateY(-12px)';
            setTimeout(() => {
                wordIndex = (wordIndex + 1) % heroWords.length;
                heroWordEl.textContent = heroWords[wordIndex];
                heroWordEl.style.opacity = '1';
                heroWordEl.style.transform = 'translateY(0)';
            }, 400);
        }, 2500);
    }
}

function initTiltCards() {
    if (window.innerWidth < 1024) return; // Desktop only
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -6;
            const rotateY = ((x - centerX) / centerX) * 6;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
            
            let shine = card.querySelector('.tilt-shine');
            if (!shine) {
                shine = document.createElement('div');
                shine.className = 'tilt-shine absolute inset-0 rounded-[2.5rem] pointer-events-none';
                card.style.position = 'relative';
                card.style.overflow = 'hidden';
                card.appendChild(shine);
            }
            if (shine) {
                shine.style.background = `radial gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.12), transparent 60%)`;
            }
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            const shine = card.querySelector('.tilt-shine');
            if (shine) shine.style.background = 'none';
        });
    });
}

function initRevealObserver() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}

function initCountUps() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                entry.target.dataset.counted = 'true';
                const target = +entry.target.getAttribute('data-val');
                let count = 0;
                const inc = target / 40;
                const timer = setInterval(() => {
                    count += inc;
                    if (count >= target) {
                        entry.target.innerText = target;
                        clearInterval(timer);
                    } else {
                        entry.target.innerText = Math.floor(count);
                    }
                }, 35);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-val').forEach(el => observer.observe(el));
}

function handleLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const formType = btn.innerText.trim().toLowerCase().replace(/\s+/g, '_').substring(0, 50);
    
    // Add hidden iframe for form submission
    let iframe = document.getElementById('form_target');
    if (!iframe) {
        iframe = document.createElement('iframe');
        iframe.id = 'form_target';
        iframe.name = 'form_target';
        iframe.style.display = 'none';
        document.body.appendChild(iframe);
    }
    
    // Add form_type and source_page as hidden fields
    let formTypeInput = form.querySelector('input[name="form_type"]');
    let sourcePageInput = form.querySelector('input[name="source_page"]');
    
    if (!formTypeInput) {
        formTypeInput = document.createElement('input');
        formTypeInput.type = 'hidden';
        formTypeInput.name = 'form_type';
        form.appendChild(formTypeInput);
    }
    formTypeInput.value = formType;
    
    if (!sourcePageInput) {
        sourcePageInput = document.createElement('input');
        sourcePageInput.type = 'hidden';
        sourcePageInput.name = 'source_page';
        form.appendChild(sourcePageInput);
    }
    sourcePageInput.value = window.location.hash || '#home';
    
    // Set form to target iframe
    form.method = 'POST';
    form.action = 'submit.php';
    form.target = 'form_target';
    
    // UI feedback
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending your request...';
    btn.disabled = true;
    
    // Timeout fallback
    let completed = false;
    
    // Listen for iframe load (form submission complete)
    iframe.onload = function() {
        if (completed) return;
        completed = true;
        
        try {
            const content = iframe.contentDocument.body.innerText;
            const data = JSON.parse(content);
            
            if (data.success) {
                btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> ' + 
                    (data.message || "Received! We'll be in touch within 4 hours.");
                btn.classList.remove('bg-brand-electric', 'bg-brand-gold', 'bg-brand-cyan', 'bg-transparent', 'text-brand-electric');
                btn.classList.add('bg-green-500', 'text-white', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
                form.reset();
                
                // Reset after 8 seconds
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                    btn.classList.remove('bg-green-500', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
                    btn.classList.add('bg-brand-electric');
                }, 8000);
            } else {
                btn.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> ' + (data.error || 'Submission failed');
                btn.classList.add('bg-red-500', 'text-white');
                btn.disabled = false;
            }
        } catch(err) {
            // Assume success if we can't parse response
            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Request received!';
            btn.classList.add('bg-green-500', 'text-white');
            btn.disabled = false;
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                btn.classList.remove('bg-green-500');
                btn.classList.add('bg-brand-electric');
            }, 8000);
        }
    };
    
    form.submit();
    
    // Fallback: if iframe doesn't load within 10 seconds, assume success
    setTimeout(() => {
        if (!completed) {
            completed = true;
            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Request received!';
            btn.classList.add('bg-green-500', 'text-white');
            btn.disabled = false;
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                btn.classList.remove('bg-green-500');
                btn.classList.add('bg-brand-electric');
            }, 8000);
        }
    }, 10000);
}

// Store original button text before any changes
document.addEventListener('click', (e) => {
    const btn = e.target.closest('button[type="submit"]');
    if (btn && !btn.getAttribute('data-original-text')) {
        btn.setAttribute('data-original-text', btn.innerText.trim());
    }
});

// Handle all forms including dynamically loaded ones
document.addEventListener('submit', function(e) {
    if (e.target.matches('form[onsubmit*="handleLead"]')) {
        // Let handleLead do its work
    }
});

function toggleFAQ(row) {
    const answer = row.nextElementSibling;
    const icon = row.querySelector('i');
    const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
    
    document.querySelectorAll('.faq-answer').forEach(a => {
        a.style.maxHeight = '0px';
        a.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
    });
    
    if (!isOpen) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(45deg)';
    }
}

// --- PAGE REPOSITORY ---
const pages = {
    home: `
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <div class="orb-drift absolute w-[600px] h-[600px] rounded-full bg-brand-electric/6 blur-[120px] -top-32 -left-32" style="animation-duration:22s"></div>
            <div class="orb-drift absolute w-[500px] h-[500px] rounded-full bg-brand-cyan/6 blur-[100px] bottom-0 right-0" style="animation-duration:28s; animation-delay: -8s"></div>
            <div class="orb-drift absolute w-[400px] h-[400px] rounded-full bg-brand-violet/5 blur-[80px] top-1/2 left-1/2 -translate-x-1/2" style="animation-duration:18s; animation-delay: -4s"></div>
        </div>
        
        <!-- Hero Section with Form at Top -->
        <section class="max-w-7xl mx-auto px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-12 lg:gap-16 items-center">
                <!-- Left: Value Prop -->
                <div class="reveal order-2 lg:order-1">
                    <div class="glow-blob w-96 h-96 bg-brand-electric -top-20 -left-20 opacity-20"></div>
                    <div class="flex items-center space-x-3 mb-8 bg-white/70 border border-white/80 w-max px-4 py-2 rounded-full backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse shadow-[0_0_10px_rgba(0,240,255,1)]"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-brand-electric">Mumbai's Trusted Workspace Partner</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl text-slate-900 mb-6 leading-tight">Your Next <br><span id="hero-word" class="text-gradient-vibrant inline-block transition-all duration-500">Work.</span><br>Starts Here.</h1>
                    <p class="text-lg text-slate-600 font-medium max-w-lg mb-8 leading-relaxed">Mumbai’s smartest workspace protocol. Whether you need a coworking desk for your startup or a 1,000-seat enterprise HQ — our fully managed offices adapt to your growth. Zero capital. <strong>Infinite scalability.</strong></p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="navigateTo('contact')" class="bg-brand-electric text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_30px_rgba(99,102,241,0.4)] hover:scale-105 transition-all">Book a Free Consultation</button>
                        <button onclick="navigateTo('managed')" class="bg-transparent text-slate-900 border-2 border-white/80 px-8 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-white/70 hover:border-white/20 transition-all flex items-center justify-center gap-3">
                            Explore Our Solutions <i class="fas fa-arrow-right-long text-brand-electric"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Right: Form (Quick Inquiry) -->
                <div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
                    <div class="glass-card p-8 border-t-4 border-t-brand-electric shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
                        <h3 class="text-xl font-black text-slate-900 mb-2 flex items-center gap-3">
                            <i class="fas fa-bolt text-brand-electric"></i>
                            Get Free Consultation
                        </h3>
                        <p class="text-sm text-slate-600 mb-6">Share your requirement. We’ll reach out within 4 hours with a tailored workspace plan.</p>
                        <form onsubmit="handleLead(event)" class="space-y-4">
                            <input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
                            <input type="text" name="company_name" placeholder="Company Name *" class="input-premium" required>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
                                <input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
                            </div>
                            <select name="requirement" class="input-premium">
                                <option value="">I am looking for...</option>
                                <option>Managed Office (50-200 seats)</option>
                                <option>Managed Office (200-1000 seats)</option>
                                <option>Custom Enterprise HQ (1000+ seats)</option>
                                <option>Find a property for lease</option>
                                <option>Lease my property</option>
                            </select>
                            <input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
                            <button type="submit" class="w-full bg-brand-electric text-white py-4 rounded-xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all">Submit Inquiry →</button>
                        </form>
                        <p class="text-xs text-slate-500 text-center mt-3 flex items-center justify-center gap-2">
                            <i class="fas fa-lock text-brand-electric text-xs"></i>
                            Your data is secure. No spam, ever.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stylish Image Section -->
        <section class="py-12 px-6">
            <div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[400px] lg:h-[600px] reveal group">
                <img src="modern_office.png" alt="Modern Managed Office" class="absolute inset-0 w-full h-full object-cover hero-parallax-img transform scale-105 group-hover:scale-100 transition-transform duration-[2s]">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                <div class="absolute bottom-10 left-10 lg:bottom-16 lg:left-16 right-10">
                    <h3 class="text-3xl lg:text-5xl font-black text-white mb-4 drop-shadow-lg tracking-tight">Where Ambition Meets Address.</h3>
                    <p class="text-white/90 text-lg lg:text-xl max-w-2xl drop-shadow">Premium managed offices and coworking spaces crafted for high-performing teams across Mumbai.</p>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="glass-card p-10 reveal">
                        <div class="w-14 h-14 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-8 text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.2)]"><i class="fas fa-coins text-2xl"></i></div>
                        <h4 class="text-xl font-bold mb-4 text-slate-900">Zero Upfront CapEx</h4>
                        <p class="text-slate-600 leading-relaxed">Keep your capital where it matters. We fund 100% of your office build-out — furniture, IT, interiors — and convert it into a single predictable monthly payment.</p>
                    </div>
                    <div class="glass-card p-10 reveal delay-100">
                        <div class="w-14 h-14 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-8 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-shield-halved text-2xl"></i></div>
                        <h4 class="text-xl font-bold mb-4 text-slate-900">Enterprise Grade Infrastructure</h4>
                        <p class="text-slate-600 leading-relaxed">Walk into spaces pre-certified for LEED Gold, ISO 27001, and fire safety compliance. Our managed offices meet audit standards demanded by global MNCs and GCCs.</p>
                    </div>
                    <div class="glass-card p-10 reveal delay-200">
                        <div class="w-14 h-14 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center mb-8 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-rocket text-2xl"></i></div>
                        <h4 class="text-xl font-bold mb-4 text-slate-900">Rapid Setup, Zero Delays</h4>
                        <p class="text-slate-600 leading-relaxed">Stop waiting months for contractors and approvals. Our plug and play office model delivers your custom workspace in Mumbai — operational and move-in ready — in record time.</p>
                    </div>
                </div>
            </div>
        </section>

        

        <!-- Ticker -->
        <section class="py-12 bg-white/70 border-y border-white/60 overflow-hidden backdrop-blur-sm">
            <div class="ticker-track">
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Coworking Space in Mumbai</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-calendar-check"></i> Trusted Managed Office Solutions</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-ruler-combined"></i> Flexible Workspace India</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-bolt"></i> Plug and Play Offices</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-indian-rupee-sign"></i> Zero Upfront CapEx</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-leaf"></i> LEED Certified Workspaces</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-shield-check"></i> Enterprise Grade Compliance</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-globe-asia"></i> Office Space for Startups</span>
                
                <!-- duplicate for seamless scroll loop -->
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-building"></i> Coworking Space in Mumbai</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-calendar-check"></i> Trusted Managed Office Solutions</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-ruler-combined"></i> Flexible Workspace India</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-bolt"></i> Plug and Play Offices</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-indian-rupee-sign"></i> Zero Upfront CapEx</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-leaf"></i> LEED Certified Workspaces</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-shield-check"></i> Enterprise Grade Compliance</span>
                <span class="text-3xl font-extrabold text-slate-700 mx-16 flex items-center gap-6"><i class="fas fa-globe-asia"></i> Office Space for Startups</span>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-24 relative bg-white/40">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter text-center mb-6">From Brief to Boardroom.</h2>
                <p class="text-xl text-slate-500 text-center mb-20">Three steps. One workspace partner. Zero friction.</p>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="glass-card p-10 reveal relative overflow-hidden">
                        <span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">01</span>
                        <div class="w-16 h-16 bg-brand-electric/10 border border-brand-electric/30 rounded-2xl flex items-center justify-center mb-6 text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.2)]"><i class="fas fa-clipboard-list text-2xl"></i></div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-brand-electric mb-4">Step 01 — Consult</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4">Consult & Curate</h4>
                        <p class="text-slate-600 leading-relaxed relative z-10">Share your team size, location preference, and timeline. Our workspace advisors build a tailored feasibility study and present curated options within 4 hours.</p>
                    </div>
                    <div class="glass-card p-10 reveal delay-100 relative overflow-hidden">
                        <span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">02</span>
                        <div class="w-16 h-16 bg-brand-cyan/10 border border-brand-cyan/30 rounded-2xl flex items-center justify-center mb-6 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-drafting-compass text-2xl"></i></div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-brand-electric mb-4">Step 02 — Build</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4">Design & Build</h4>
                        <p class="text-slate-600 leading-relaxed relative z-10">CorpEasy secures the Grade A property and handles everything — from civil and electrical work to furniture and IT infrastructure. All funded by us, at zero cost to you.</p>
                    </div>
                    <div class="glass-card p-10 reveal delay-200 relative overflow-hidden">
                        <span class="absolute text-[180px] font-black opacity-5 text-slate-900 top-4 right-6 leading-none select-none">03</span>
                        <div class="w-16 h-16 bg-brand-violet/10 border border-brand-violet/30 rounded-2xl flex items-center justify-center mb-6 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-key text-2xl"></i></div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-brand-electric mb-4">Step 03 — Scale</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4">Move In & Scale</h4>
                        <p class="text-slate-600 leading-relaxed relative z-10">Walk into a fully managed, plug and play office. We handle operations, security, housekeeping, and maintenance — while you focus entirely on growing your business.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 relative">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal">
                    <div class="inline-flex items-center space-x-2 mb-6 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
                        <span class="text-[10px] font-black uppercase tracking-widest text-brand-electric">Client Testimonials</span>
                    </div>
                    <h2 class="text-5xl lg:text-6xl font-black text-slate-900 mb-4">Trusted by Decision-Makers.</h2>
                    <p class="text-xl text-slate-500">Hear from leaders who chose CorpEasy for their Mumbai operations.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="glass-card p-12 relative overflow-hidden reveal">
                        <i class="fas fa-quote-left absolute top-8 left-8 text-8xl text-brand-electric/8"></i>
                        <div class="flex text-brand-gold mb-6 space-x-1 relative z-10">
                            <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i>
                        </div>
                        <p class="text-lg text-slate-700 leading-relaxed mb-8 relative z-10">"CorpEasy set up our 400-seat managed office in Mumbai in just 38 days — a week ahead of schedule. The zero CapEx model freed up critical capital for our India expansion roadmap."</p>
                        <div class="relative z-10">
                            <p class="font-bold text-slate-900">VP, Real Estate & Facilities</p>
                            <p class="text-[11px] font-bold text-brand-electric uppercase tracking-widest mt-1">Global Technology MNC, Mumbai</p>
                        </div>
                    </div>
                    <div class="glass-card p-12 relative overflow-hidden reveal delay-100">
                        <i class="fas fa-quote-left absolute top-8 left-8 text-8xl text-brand-electric/8"></i>
                        <div class="flex text-brand-gold mb-6 space-x-1 relative z-10">
                            <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i>
                        </div>
                        <p class="text-lg text-slate-700 leading-relaxed mb-8 relative z-10">"From compliance documentation to IT infrastructure, everything was enterprise-ready on Day 1. This is exactly how flexible workspace in India should work — seamless and institutional."</p>
                        <div class="relative z-10">
                            <p class="font-bold text-slate-900">Head of GCC Operations</p>
                            <p class="text-[11px] font-bold text-brand-electric uppercase tracking-widest mt-1">Fortune 500 Financial Services, Mumbai</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Locations Section -->
        <section class="py-24 relative bg-white/40">
            <div class="max-w-7xl mx-auto px-6">
                <div class="mb-16 reveal text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 mb-6 bg-brand-cyan/10 border border-brand-cyan/30 rounded-full px-4 py-1.5 backdrop-blur-md">
                        <span class="text-[10px] font-black uppercase tracking-widest text-brand-cyan">Mumbai Micro Markets</span>
                    </div>
                    <h2 class="text-5xl lg:text-6xl font-black text-slate-900 mb-4">Located Where Business Happens.</h2>
                    <p class="text-xl text-slate-500">Premium managed offices and coworking spaces in Mumbai’s most sought-after commercial corridors.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal">
                    <!-- BKC -->
                    <div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer" onclick="navigateTo('contact')">
                        <div class="inline-block px-3 py-1 bg-brand-gold/10 border border-brand-gold/30 text-brand-gold text-[10px] font-bold uppercase tracking-widest rounded-full mb-6">Premium Hub</div>
                        <div class="w-16 h-16 bg-brand-gold/10 border border-brand-gold/30 rounded-2xl flex items-center justify-center mb-6 text-brand-gold shadow-[0_0_15px_rgba(251,191,36,0.2)]"><i class="fas fa-star text-2xl"></i></div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Bandra Kurla Complex (BKC)</h4>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">The financial nerve center of India. Ideal for enterprise teams, consulting firms, and global banks seeking a premium managed office address in Mumbai.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/60">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Avg. Range</p>
                            <p class="text-sm font-bold text-slate-900">₹180–₹260/sqft</p>
                        </div>
                    </div>
                    <!-- Lower Parel -->
                    <div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-100" onclick="navigateTo('contact')">
                        <div class="inline-block px-3 py-1 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-[10px] font-bold uppercase tracking-widest rounded-full mb-6">Heritage Commercial</div>
                        <div class="w-16 h-16 bg-brand-electric/10 border border-brand-electric/30 rounded-2xl flex items-center justify-center mb-6 text-brand-electric shadow-[0_0_15px_rgba(99,102,241,0.2)]"><i class="fas fa-building-columns text-2xl"></i></div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Lower Parel & Worli</h4>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">Iconic Grade A towers with a legacy of prestige. A coveted corridor for companies seeking managed office solutions with unmatched connectivity and brand value.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/60">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Avg. Range</p>
                            <p class="text-sm font-bold text-slate-900">₹140–₹200/sqft</p>
                        </div>
                    </div>
                    <!-- Goregaon East -->
                    <div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-200" onclick="navigateTo('contact')">
                        <div class="inline-block px-3 py-1 bg-brand-cyan/10 border border-brand-cyan/30 text-brand-cyan text-[10px] font-bold uppercase tracking-widest rounded-full mb-6">High Growth</div>
                        <div class="w-16 h-16 bg-brand-cyan/10 border border-brand-cyan/30 rounded-2xl flex items-center justify-center mb-6 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-chart-line text-2xl"></i></div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Goregaon & Nirlon Park</h4>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">Mumbai’s GCC capital. Large floor plates built for tech hubs and 500+ seat scale-ups — at price points that maximize your enterprise workspace ROI.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/60">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Avg. Range</p>
                            <p class="text-sm font-bold text-slate-900">₹100–₹140/sqft</p>
                        </div>
                    </div>
                    <!-- Andheri East -->
                    <div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-300" onclick="navigateTo('contact')">
                        <div class="inline-block px-3 py-1 bg-brand-violet/10 border border-brand-violet/30 text-brand-violet text-[10px] font-bold uppercase tracking-widest rounded-full mb-6">Airport Corridor</div>
                        <div class="w-16 h-16 bg-brand-violet/10 border border-brand-violet/30 rounded-2xl flex items-center justify-center mb-6 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-plane-departure text-2xl"></i></div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Andheri East & SEEPZ</h4>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">The connectivity hub near the international airport. Ideal for startups and remote teams seeking an affordable coworking space in Mumbai with stellar access.</p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/60">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Avg. Range</p>
                            <p class="text-sm font-bold text-slate-900">₹90–₹130/sqft</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Capital Intel Section -->
        <section class="py-32 relative overflow-hidden bg-white/20">
            <div class="glow-blob w-[600px] h-[600px] bg-brand-cyan opacity-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="max-w-7xl mx-auto px-6 text-center">
                <div class="mb-20 reveal">
                    <h2 class="text-6xl text-slate-900 mb-8 font-black leading-tight">Capital Intel.</h2>
                    <p class="text-xl text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed">Maximize operational efficiency across Mumbai’s commercial landscape with CorpEasy’s data-driven managed office model.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal delay-100">
                    <div class="glass-card p-12 group hover:border-brand-electric/50 transition-all text-left">
                        <div class="w-16 h-16 bg-brand-electric/10 rounded-2xl flex items-center justify-center mb-8 text-brand-electric group-hover:bg-brand-electric group-hover:text-white transition-all duration-500">
                            <i class="fas fa-microchip text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black mb-4 text-slate-900">Strategic Sourcing</h4>
                        <p class="text-slate-600 leading-relaxed font-medium">Our team scans 500+ commercial nodes daily across Mumbai. We identify high value Grade A assets before they hit the open market — giving you early access to prime managed office locations.</p>
                    </div>
                    
                    <div class="glass-card p-12 group hover:border-brand-cyan/50 transition-all text-left">
                        <div class="w-16 h-16 bg-brand-cyan/10 rounded-2xl flex items-center justify-center mb-8 text-brand-cyan group-hover:bg-brand-cyan group-hover:text-white transition-all duration-500">
                            <i class="fas fa-chart-network text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black mb-4 text-slate-900">Managed Operations</h4>
                        <p class="text-slate-600 leading-relaxed font-medium">Real-time monitoring of facility health, energy consumption, and workspace utilization. Every rupee of your operating expenditure is tracked and optimized for maximum efficiency.</p>
                    </div>
                    
                    <div class="glass-card p-12 group hover:border-brand-violet/50 transition-all text-left">
                        <div class="w-16 h-16 bg-brand-violet/10 rounded-2xl flex items-center justify-center mb-8 text-brand-violet group-hover:bg-brand-violet group-hover:text-white transition-all duration-500">
                            <i class="fas fa-shield-check text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black mb-4 text-slate-900">Compliance Automation</h4>
                        <p class="text-slate-600 leading-relaxed font-medium">Automated audit trails for ESG, SOC 2, and ISO readiness. We maintain institutional compliance standards across your entire portfolio — so you clear every audit, every time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Comparison Table -->
        <section class="py-24 relative bg-white/40">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-center mb-16 reveal">
                    <div class="inline-flex items-center space-x-2 mb-6 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
                        <span class="text-[10px] font-black uppercase tracking-widest text-brand-electric">CorpEasy vs. Traditional Setup</span>
                    </div>
                    <p class="text-xl text-slate-500">See why enterprises choose the managed office model over traditional leasing.</p>
                </div>
                <div class="glass-card overflow-hidden reveal">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border-collapse whitespace-nowrap min-w-[600px]">
                            <thead>
                                <tr>
                                    <th class="py-5 px-8 text-left text-[11px] font-black uppercase tracking-widest text-slate-500 bg-white/30 border-b border-white/60 w-1/3">Feature</th>
                                    <th class="py-5 px-8 text-center text-[11px] font-black uppercase tracking-widest text-slate-500 bg-white/30 border-b border-white/60">Traditional Lease</th>
                                    <th class="py-5 px-8 text-center text-[11px] font-black uppercase tracking-widest text-brand-electric bg-brand-electric/5 border-b border-brand-electric/20">
                                        <span class="block">CorpEasy Managed</span>
                                        <span class="text-[9px] bg-brand-electric text-white px-2 py-0.5 rounded-full mt-1 inline-block">★ Recommended</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white/20">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Setup Time</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">6–9 Months</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Rapid</td>
                                </tr>
                                <tr class="bg-white/40">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Upfront CapEx</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">₹2,000–5,000 / seat</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Zero</td>
                                </tr>
                                <tr class="bg-white/20">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Operations</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Multiple Vendors</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Consolidated</td>
                                </tr>
                                <tr class="bg-white/40">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">IT & Security</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Self Managed</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ SOC 2 Ready</td>
                                </tr>
                                <tr class="bg-white/20">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Facility Management</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Separate vendor</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Integrated</td>
                                </tr>
                                <tr class="bg-white/40">
                                    <td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Lease Liability</td>
                                    <td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Full tenant risk</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Operator backed</td>
                                </tr>
                                <tr class="bg-white/20">
                                    <td class="py-5 px-8 text-slate-700 font-semibold">Scalability</td>
                                    <td class="py-5 px-8 text-slate-500 text-center">Fixed term</td>
                                    <td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5">✅ Flexible</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    `,

    blog: `
        <section class="max-w-7xl mx-auto px-6 py-24 reveal">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center space-x-2 mb-8 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-brand-electric">Market Intelligence</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 leading-none">The <span class="text-gradient-vibrant">Intel</span> Hub.</h1>
                    <p class="text-xl text-slate-600 mt-8 leading-relaxed">Expert analysis on Mumbai commercial real estate, managed office trends, and enterprise workspace strategies.</p>
                </div>
            </div>

            <!-- Featured Article -->
            <div class="group cursor-pointer mb-24 reveal delay-100" onclick="viewPost('mumbai-outlook')">
                <div class="glass-card p-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="rounded-[2rem] overflow-hidden h-[450px]">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200" alt="The 2026 Mumbai GCC Outlook: Why Managed HQs are Winning." class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90">
                    </div>
                    <div class="p-6 lg:p-10">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="px-4 py-1.5 bg-brand-electric text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-[0_0_15px_rgba(99,102,241,0.4)]">Featured Report</span>
                            <span class="text-xs text-slate-600 font-bold flex items-center"><i class="far fa-clock mr-2"></i> 8 Min Read</span>
                        </div>
                        <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-8 leading-tight group-hover:text-brand-electric transition-colors">The 2026 Mumbai GCC Outlook: Why Managed HQs are Winning.</h2>
                        <p class="text-lg text-slate-600 mb-10 leading-relaxed">Analyzing why 85% of incoming Global Capability Centers in Mumbai are choosing managed operating models over traditional leaseholds.</p>
                        <a class="text-sm font-black uppercase tracking-widest text-brand-electric flex items-center gap-4 group-hover:gap-6 transition-all">Read Full Report <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Article Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="blog-card group cursor-pointer reveal" onclick="viewPost('neuro architecture')">
                    <div class="h-56 overflow-hidden rounded-t-[2rem]">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=800" alt="Neuro Architecture: Boosting Productivity by 15%" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-80 group-hover:opacity-100">
                    </div>
                    <div class="p-8">
                        <p class="text-[10px] font-bold text-brand-violet uppercase tracking-widest mb-4">Design Strategy</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4 leading-tight group-hover:text-brand-electric transition-colors">Neuro Architecture: Boosting Productivity by 15%</h4>
                        <p class="text-sm text-slate-600 mb-8 leading-relaxed">How biophilic elements and light optimization reduce burnout in high intensity technical teams.</p>
                        <span class="text-xs font-black uppercase tracking-widest text-brand-electric flex items-center gap-2 group-hover:gap-4 transition-all">Read More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
                <div class="blog-card group cursor-pointer reveal delay-100" onclick="viewPost('bkc-vs-goregaon')">
                    <div class="h-56 overflow-hidden rounded-t-[2rem]">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=800" alt="BKC vs Goregaon: The Battle for Grade A Superiority" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-80 group-hover:opacity-100">
                    </div>
                    <div class="p-8">
                        <p class="text-[10px] font-bold text-brand-cyan uppercase tracking-widest mb-4">Market Trends</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4 leading-tight group-hover:text-brand-electric transition-colors">BKC vs Goregaon: The Battle for Grade A Superiority</h4>
                        <p class="text-sm text-slate-600 mb-8 leading-relaxed">A comparative rental yield analysis for enterprises expanding in the Mumbai MMR region.</p>
                        <span class="text-xs font-black uppercase tracking-widest text-brand-electric flex items-center gap-2 group-hover:gap-4 transition-all">Read More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
                <div class="blog-card group cursor-pointer reveal delay-200" onclick="viewPost('gst-rental')">
                    <div class="h-56 overflow-hidden rounded-t-[2rem]">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800" alt="Impact of GST on Office Rental Outflows" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-80 group-hover:opacity-100">
                    </div>
                    <div class="p-8">
                        <p class="text-[10px] font-bold text-brand-rose uppercase tracking-widest mb-4">Corporate Finance</p>
                        <h4 class="text-2xl font-bold text-slate-900 mb-4 leading-tight group-hover:text-brand-electric transition-colors">Impact of GST on Office Rental Outflows</h4>
                        <p class="text-sm text-slate-600 mb-8 leading-relaxed">Navigating the complex regulatory landscape for MNCs entering the Indian commercial market.</p>
                        <span class="text-xs font-black uppercase tracking-widest text-brand-electric flex items-center gap-2 group-hover:gap-4 transition-all">Read More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </section>
    `,

    managed: `
        <section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">

          <!-- LEFT: Value Prop -->
          <div class="order-2 lg:order-1 flex flex-col justify-center">
            <div class="inline-flex items-center space-x-2 mb-6 bg-brand-cyan/10 border border-brand-cyan/30 rounded-full px-4 py-1.5 backdrop-blur-md w-max">
                <span class="text-[10px] font-black uppercase tracking-widest text-brand-cyan">Enterprise Workspace Solutions</span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-6">Zero CapEx <br><span class="text-gradient-vibrant">Enterprise Offices.</span></h1>
            
            <div class="space-y-3 mb-4">
                <p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> Zero upfront CapEx — we fund 100% of fit out</p>
                <p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> Institutional standards (LEED, Fire Safety, ISO 27001)</p>
                <p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> Custom fit out with infinite scalability</p>
            </div>
            
            <p class="text-lg text-slate-600 mt-4 leading-relaxed">Whether you need a coworking desk for your startup or a 1,000-seat enterprise HQ — our fully managed offices adapt to your growth. Zero capital. <strong>Infinite scalability.</strong></p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                <div class="glass-card p-5">
                    <h4 class="text-base font-bold text-slate-900">OpEx Model</h4>
                    <p class="text-xs text-slate-600 mt-1">We fund the entire fit-out, converting your CapEx into a single monthly payment.</p>
                </div>
                <div class="glass-card p-5">
                    <h4 class="text-base font-bold text-slate-900">99.9% Uptime</h4>
                    <p class="text-xs text-slate-600 mt-1">Redundant power and dual ISP backbones for uninterrupted operations.</p>
                </div>
                <div class="glass-card p-5">
                    <h4 class="text-base font-bold text-slate-900">ESG & Security</h4>
                    <p class="text-xs text-slate-600 mt-1">LEED Gold, ISO 27001, and complete regulatory compliance built in.</p>
                </div>
            </div>
          </div>

          <!-- RIGHT: Form (sticky) -->
          <div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
            <div class="glass-card p-8 border-t-4 border-t-brand-electric shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
              <h3 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                <i class="fas fa-building text-brand-electric"></i>
                Request a Feasibility Study
              </h3>
              <form onsubmit="handleLead(event)" class="space-y-4">
                <input type="text" name="full_name" placeholder="Full Name" class="input-premium" required>
                <input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
                <input type="email" name="email" placeholder="Work Email" class="input-premium" required>
                <input type="tel" name="phone" placeholder="Phone Number" class="input-premium" required>
                <input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
                <button type="submit" class="w-full bg-brand-electric text-white py-4 rounded-xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all">Get Free Consultation →</button>
              </form>
              
              <p class="text-xs text-slate-500 text-center mt-3 flex items-center justify-center gap-2">
                <i class="fas fa-lock text-brand-electric text-xs"></i>
                Your data is secure. No spam, ever.
              </p>
            </div>
          </div>
        </section>

        <!-- Workspace Showcase -->
        <section class="py-12 px-6">
            <div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[400px] lg:h-[550px] reveal group border border-white/60">
                <img src="managed_workspace.png" alt="Managed Workspace Render" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]">
                <div class="absolute inset-0 bg-gradient-to-tr from-brand-electric/40 via-transparent to-transparent"></div>
                <!-- Interactive hotspots or subtle tags could go here to show features -->
                <div class="absolute bottom-6 right-6 lg:bottom-10 lg:right-10 bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-xs font-black uppercase tracking-widest text-slate-900">Custom Fit out Example</span>
                </div>
            </div>
        </section>

        <!-- Below the fold -->
        <section class="py-24 bg-white/40">
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center">
                     <h2 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-6">An Operating System for Your Office.</h2>
                     <p class="text-xl text-slate-500 mb-16 max-w-3xl mx-auto">Our managed office solutions go beyond four walls. They are high-performance environments engineered for enterprises that refuse to compromise.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 reveal">
                    <div class="glass-card p-10">
                        <div class="w-16 h-16 bg-brand-blue/30 border border-brand-electric/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-electric shadow-[0_0_20px_rgba(0,240,255,0.2)]"><i class="fas fa-sitemap"></i></div>
                        <h4 class="text-2xl font-bold mb-4 text-slate-900">OpEx Model</h4>
                        <p class="text-slate-600 leading-relaxed">We fund 100% of the fit-out, IT infrastructure, and furnishing — converting heavy capital expenditure into a predictable, manageable monthly cost.</p>
                    </div>
                    <div class="glass-card p-10">
                        <div class="w-16 h-16 bg-brand-cyan/20 border border-brand-cyan/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-cyan shadow-[0_0_20px_rgba(6,182,212,0.2)]"><i class="fas fa-wifi"></i></div>
                        <h4 class="text-2xl font-bold mb-4 text-slate-900">99.9% Uptime</h4>
                        <p class="text-slate-600 leading-relaxed">Redundant ISP backbones, enterprise firewalls, and integrated facility management ensure your team stays productive without interruption.</p>
                    </div>
                    <div class="glass-card p-10">
                        <div class="w-16 h-16 bg-brand-violet/20 border border-brand-violet/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-violet shadow-[0_0_20px_rgba(139,92,246,0.2)]"><i class="fas fa-shield-alt"></i></div>
                        <h4 class="text-2xl font-bold mb-4 text-slate-900">ESG & Security</h4>
                        <p class="text-slate-600 leading-relaxed">Full adherence to global infosec policies, ISO certifications, occupational health standards, and LEED sustainability protocols.</p>
                    </div>
                </div>
            </div>
        </section>
    `,

    find: `
        <section class="py-16 lg:py-24 relative reveal">
            <div class="glow-blob w-[600px] h-[600px] bg-brand-cyan opacity-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
            
            <!-- Form at Top -->
            <div class="max-w-2xl mx-auto px-6 mb-16 relative z-10">
                <div class="glass-card p-8 border-t-4 border-t-brand-cyan shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
                    <h3 class="text-xl font-black text-slate-900 mb-2 flex items-center gap-3">
                        <i class="fas fa-search-location text-brand-cyan"></i>
                        Find a Property for Lease
                    </h3>
                    <p class="text-sm text-slate-600 mb-6">Tell us your ideal location, size, and budget. Our team will curate the best available options across Mumbai.</p>
                    <form onsubmit="handleLead(event)" class="space-y-4">
                        <input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
                        <input type="text" name="company_name" placeholder="Company Name *" class="input-premium" required>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
                            <input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
                        </div>
                        <input type="text" name="requirement" placeholder="Property Requirement (e.g., BKC, 5000 sqft)" class="input-premium">
                        <input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
                        <button type="submit" class="w-full bg-brand-cyan text-white py-4 rounded-xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all">Search Properties →</button>
                    </form>
                </div>
            </div>
            
            <!-- Info Below Form -->
            <div class="max-w-4xl mx-auto px-6 text-center relative z-10 p-12 bg-white/40 backdrop-blur-md rounded-[3rem] border border-white/60">
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 mb-8">Property <span class="text-gradient">Inventory.</span></h1>
                <p class="text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Off market and curated Grade A properties for managed offices and plug and play coworking spaces across Mumbai’s most prime commercial zones. Start your capital efficient journey here.</p>
            </div>
        </section>
    `,

    list: `
        <section class="py-16 lg:py-24 relative">
            <div class="glow-blob w-[800px] h-[800px] bg-brand-gold opacity-10 -top-20 -right-20"></div>
            
            <!-- Form at Top -->
            <div class="max-w-2xl mx-auto px-6 mb-16 relative z-10">
                <div class="glass-card p-8 border-t-4 border-t-brand-gold shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
                    <h3 class="text-xl font-black text-slate-900 mb-2 flex items-center gap-3">
                        <i class="fas fa-building text-brand-gold"></i>
                        Lease Your Property
                    </h3>
                    <p class="text-sm text-slate-600 mb-6">List your commercial asset with CorpEasy. We deliver guaranteed occupancy, institutional management, and long-term yield.</p>
                    <form onsubmit="handleLead(event)" class="space-y-4">
                        <input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
                        <input type="text" name="company_name" placeholder="Company / Property Owner Name" class="input-premium">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
                            <input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
                        </div>
                        <input type="text" name="property_location" placeholder="Property Address or Area *" class="input-premium" required>
                        <input type="number" name="property_area" placeholder="Total Area (Sq Ft)" class="input-premium">
                        <input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
                        <button type="submit" class="w-full bg-brand-gold text-white py-4 rounded-xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] shadow-[0_0_20px_rgba(251,191,36,0.4)] transition-all">Submit Property →</button>
                    </form>
                </div>
            </div>

            <!-- Strategic Content -->
            <div class="max-w-4xl mx-auto px-6 text-center relative z-10 p-12 bg-white/40 backdrop-blur-md rounded-[3rem] border border-white/60 mb-20">
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 mb-8">Asset <span class="text-gradient-gold">Partnership.</span></h1>
                <p class="text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Turn your commercial property into a high-yield managed workspace. We handle full build-out, operations, and tenant sourcing — delivering Fortune 500-grade occupants and stable long-term returns.</p>
            </div>
            
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
                <div class="reveal">
                    <h1 class="text-5xl lg:text-7xl font-black mb-8 leading-none tracking-tighter text-slate-900">Monetize <br><span class="text-gradient-gold text-brand-gold">Assets.</span></h1>
                    <p class="text-xl text-slate-600 mb-10 leading-relaxed">Convert your Grade A real estate into an institutional grade managed workspace — with stabilized, high margin yields and zero vacancy risk.</p>
                </div>
                <div class="glass-card p-10 reveal delay-2 border border-brand-gold/20 shadow-[0_0_40px_rgba(251,191,36,0.1)]">
                    <h4 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3"><i class="fas fa-star text-brand-gold"></i> Why Partner With Us?</h4>
                    <div class="space-y-4">
                        <p class="flex items-center gap-3 text-slate-700"><i class="fas fa-check-circle text-brand-gold"></i> Guaranteed occupancy — zero vacancy risk</p>
                        <p class="flex items-center gap-3 text-slate-700"><i class="fas fa-check-circle text-brand-gold"></i> Institutional grade fit out funding</p>
                        <p class="flex items-center gap-3 text-slate-700"><i class="fas fa-check-circle text-brand-gold"></i> Full facility management included</p>
                        <p class="flex items-center gap-3 text-slate-700"><i class="fas fa-check-circle text-brand-gold"></i> Long term lease agreements</p>
                    </div>
                </div>
            </div>
        </section>
    `,

    about: `
        <section class="max-w-7xl mx-auto px-6 py-32 text-center reveal min-h-[80vh] flex flex-col justify-center relative">
            <div class="glow-blob w-[600px] h-[600px] bg-brand-blue opacity-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative z-10">
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-brand-electric mb-6 block text-center">The CorpEasy Story</span>
                <h1 class="text-6xl lg:text-8xl text-slate-900 font-black mb-12 text-center leading-[0.9]">Redefining How <span class="text-gradient-vibrant">India</span> Works.</h1>
                <p class="text-xl text-slate-600 text-center max-w-3xl mx-auto leading-relaxed mb-20 font-medium italic">"We didn't just build an office company; We built a workspace engine designed to eliminate every barrier between a company’s ambition and its physical presence in India."</p>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 text-center">
                    <div class="glass-card p-10 group hover:border-brand-electric/50">
                        <p class="text-5xl lg:text-7xl font-black text-slate-900 mb-6 tracking-tighter group-hover:text-brand-electric transition-colors">100%</p>
                        <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">OpEx Funded</p>
                    </div>
                    <div class="glass-card p-10 group hover:border-brand-cyan/50">
                        <p class="text-5xl lg:text-7xl font-black text-slate-900 mb-6 tracking-tighter group-hover:text-brand-cyan transition-colors">Zero</p>
                        <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">CapEx Risk</p>
                    </div>
                    <div class="glass-card p-10 group hover:border-brand-violet/50">
                        <p class="text-5xl lg:text-7xl font-black text-slate-900 mb-6 tracking-tighter group-hover:text-brand-violet transition-colors">Grade A</p>
                        <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">Commercial Facilities</p>
                    </div>
                    <div class="glass-card p-10 group hover:border-brand-rose/50">
                        <p class="text-5xl lg:text-7xl font-black text-slate-900 mb-6 tracking-tighter group-hover:text-brand-rose transition-colors">24/7</p>
                        <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">Enterprise Uptime</p>
                    </div>
                </div>

                <!-- Team Graphic -->
                <div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] lg:h-[500px] mt-24 reveal group">
                    <img src="professional_team.png" alt="CorpEasy Office Dynamics" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]">
                    <div class="absolute inset-0 bg-brand-electric/10 mix-blend-multiply"></div>
                </div>

                <!-- Co-Founders -->
                <div class="mt-32 text-center">
                    <h3 class="text-4xl font-black text-slate-900 mb-4">Our Founders</h3>
                    <p class="text-slate-500 max-w-2xl mx-auto mb-16 uppercase tracking-[0.2em] font-bold text-xs">Direct accountability. No layers. No friction.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                        <!-- Dev Doshi -->
                        <div class="glass-card p-10 group bg-white/50 border border-white/60">
                            <div class="w-32 h-32 mx-auto mb-8 rounded-full overflow-hidden border-4 border-white shadow-2xl transition-transform duration-500 group-hover:scale-110 grayscale-[50%] group-hover:grayscale-0">
                                <img src="DEV DOSHI.png" alt="Dev Doshi" class="w-full h-full object-cover">
                            </div>
                            <h4 class="text-2xl font-black text-slate-900 mb-2">Dev Doshi</h4>
                            <p class="text-brand-electric font-black text-[10px] uppercase tracking-widest mb-6">Strategic Alliances & Business Development</p>
                            <p class="text-sm text-slate-600 leading-relaxed italic border-t border-white/40 pt-6">"Integrity isn’t a tagline — it’s our foundation. Every square foot we manage is designed to deliver measurable returns for our partners and tenants alike."</p>
                        </div>
                        <!-- Jay Nishar -->
                        <div class="glass-card p-10 group bg-white/50 border border-white/60">
                            <div class="w-32 h-32 mx-auto mb-8 rounded-full overflow-hidden border-4 border-white shadow-2xl transition-transform duration-500 group-hover:scale-110 grayscale-[50%] group-hover:grayscale-0">
                                <img src="JAY NISHAR.png" alt="Jay Nishar" class="w-full h-full object-cover">
                            </div>
                            <h4 class="text-2xl font-black text-slate-900 mb-2">Jay Nishar</h4>
                            <p class="text-brand-electric font-black text-[10px] uppercase tracking-widest mb-6">Operations & Growth Infrastructure</p>
                            <p class="text-sm text-slate-600 leading-relaxed italic border-t border-white/40 pt-6">"We built CorpEasy for the fast movers. If you’re ready to scale in Mumbai, your workspace should accelerate your growth — not hold it back."</p>
                        </div>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="mt-32 max-w-4xl mx-auto text-left">
                    <h3 class="text-4xl lg:text-5xl font-black text-slate-900 mb-16">Our Journey.</h3>
                    <div class="relative">
                        <div class="relative pl-16 mb-8">
                            <div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
                            <div class="absolute left-[7px] top-4 w-0.5 bg-gradient-to-b from-brand-electric to-brand-cyan h-full z-0"></div>
                            <h4 class="text-gradient-vibrant text-2xl font-black mb-2">2025 October</h4>
                            <div class="glass-card p-6 reveal">Founded in October 2025. First managed office delivered in Bandra Kurla Complex, Mumbai — establishing CorpEasy as a new-generation workspace operator.</div>
                        </div>
                        
                        
                        <div class="relative pl-16">
                            <div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
                            <h4 class="text-gradient-vibrant text-2xl font-black mb-2">2026</h4>
                            <div class="glass-card p-6 reveal delay-300">Rapid expansion across Mumbai. Growing portfolio of Grade A managed workspaces serving startups, SMEs, and enterprise teams across BKC, Lower Parel, Goregaon & Andheri corridors.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    `,

    faq: `
        <section class="max-w-7xl mx-auto px-6 pt-32 pb-16 reveal relative">
            <h2 class="text-5xl font-black text-slate-900 mb-16 text-center">Common Questions.</h2>
            <div class="max-w-3xl mx-auto">
                <div class="border-b border-white/60">
                    <div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)">
                        <span class="text-lg font-bold text-slate-900">What is the difference between coworking and managed offices?</span>
                        <i class="fas fa-plus text-brand-electric transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px">
                        <p class="text-slate-600 pb-6 leading-relaxed">Coworking offers shared desks and communal amenities — ideal for freelancers and small teams. A managed office is a private, custom-branded workspace exclusively for your company — fully built, funded, and operated by CorpEasy. Both options require zero CapEx.</p>
                    </div>
                </div>
                <div class="border-b border-white/60">
                    <div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)">
                        <span class="text-lg font-bold text-slate-900">Can we customize the floor plan?</span>
                        <i class="fas fa-plus text-brand-electric transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px">
                        <p class="text-slate-600 pb-6 leading-relaxed">Absolutely. Our design team collaborates with you to create a layout tailored to your workflow — private cabins, collaboration zones, breakout areas, and specialized tech rooms — all finalized before you move in.</p>
                    </div>
                </div>
                <div class="border-b border-white/60">
                    <div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)">
                        <span class="text-lg font-bold text-slate-900">Is the price inclusive of electricity and security?</span>
                        <i class="fas fa-plus text-brand-electric transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px">
                        <p class="text-slate-600 pb-6 leading-relaxed">Yes. Your single monthly payment covers high-speed redundant internet, 24/7 security, daily housekeeping, property tax, and utility bills. One invoice. No hidden costs.</p>
                    </div>
                </div>
                <div class="border-b border-white/60">
                    <div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)">
                        <span class="text-lg font-bold text-slate-900">Do we need to sign a long term lease?</span>
                        <i class="fas fa-plus text-brand-electric transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px">
                        <p class="text-slate-600 pb-6 leading-relaxed">We offer flexible agreements starting from 12 months. Standard enterprise terms range from 3–5 years, designed around your business planning cycle. No rigid lock-ins — just terms that match your growth stage.</p>
                    </div>
                </div>
                <div class="border-b border-white/60">
                    <div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)">
                        <span class="text-lg font-bold text-slate-900">Which Mumbai areas do you operate in?</span>
                        <i class="fas fa-plus text-brand-electric transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px">
                        <p class="text-slate-600 pb-6 leading-relaxed">We currently operate in BKC, Lower Parel, Goregaon East, and Andheri East. We are actively sourcing assets in Powai and Navi Mumbai for H2 2026 availability.</p>
                    </div>
                </div>
            </div>
        </section>
    `,

    contact: `
        <section class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-12 gap-20 items-start reveal relative">
            <div class="lg:col-span-5 relative z-10">
                <div class="inline-flex items-center space-x-2 mb-10 bg-brand-rose/10 border border-brand-rose/30 rounded-full px-4 py-1.5 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand-rose animate-pulse"></span>
                    <span class="text-[10px] font-black text-brand-rose uppercase tracking-[0.4em]">Available Now</span>
                </div>
                <h1 class="text-6xl text-slate-900 font-black mb-10 leading-tight">Let's <br><span class="text-gradient-vibrant">Talk.</span></h1>
                <p class="text-xl text-slate-600 leading-relaxed mb-16 max-w-sm">Connect directly with our workspace strategy team. Whether you need a 10-seat coworking setup or a 1,000-seat managed HQ in Mumbai — we’ll build a plan around your exact requirements.</p>
                
                <div class="space-y-10">
                    <div class="flex items-center gap-8 group glass-card p-6 border border-white/60 w-max">
                        <div class="w-16 h-16 bg-white/70 border border-white/80 rounded-2xl flex items-center justify-center text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.1)] group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-terminal text-xl"></i></div>
                        <div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Email Us</p><a href="mailto:devdoshi@corpeasy.in" class="text-xl font-bold text-slate-900 tracking-wide hover:text-brand-electric transition-colors">devdoshi@corpeasy.in</a></div>
                    </div>
                    <div class="flex items-center gap-8 group glass-card p-6 border border-white/60 w-max mt-4">
                        <div class="w-16 h-16 bg-white/70 border border-white/80 rounded-2xl flex items-center justify-center text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.1)] group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-envelope text-xl"></i></div>
                        <div><p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Alternate Email</p><a href="mailto:jaynishar@corpeasy.in" class="text-xl font-bold text-slate-900 tracking-wide hover:text-brand-electric transition-colors">jaynishar@corpeasy.in</a></div>
                    </div>
                    <div class="flex items-center gap-8 group glass-card p-6 border border-white/60 w-max mt-4">
                        <div class="w-16 h-16 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-center justify-center text-green-500 shadow-[0_0_15px_rgba(34,197,94,0.1)] group-hover:bg-green-500 group-hover:text-white transition-all duration-500">
                          <i class="fab fa-whatsapp text-2xl"></i>
                        </div>
                        <div>
                          <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">WhatsApp</p>
                          <a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20would%20like%20a%20consultation." target="_blank" class="text-xl font-bold text-slate-900 tracking-wide hover:text-green-500 transition-colors">Chat With Us</a>
                        </div>
                    </div>
                    
                    <!-- Office Address -->
                    <div class="glass-card p-6 border border-white/60 mt-8">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Our Office</p>
                        <p class="text-sm text-slate-700 leading-relaxed">Office No. 30, 2nd Floor, Gopal Bhavan,<br>Shamaldas Gandhi Marg, Marine Lines East,<br>Mumbai, Maharashtra 400002</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7 glass-card p-12 lg:p-16 border-t-[10px] border-t-brand-electric reveal delay-2 relative z-10 shadow-[0_20px_40px_rgba(0,0,0,0.1)]">
                <form onsubmit="handleLead(event)" class="space-y-6">
                    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-white/80">
                        <i class="fas fa-shield-check text-brand-electric text-2xl"></i>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Get in Touch</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
                        <input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="email" name="email" placeholder="Work Email Address" class="input-premium" required>
                        <input type="tel" name="phone" placeholder="Phone Number (with country code)" class="input-premium" required>
                    </div>
                    <select name="requirement" class="input-premium" required>
                        <option value="">I am looking for...</option>
                        <option>Managed Office (50-200 seats)</option>
                        <option>Managed Office (200-1000 seats)</option>
                        <option>Custom Enterprise HQ (1000+ seats)</option>
                        <option>Find a property for lease</option>
                        <option>Lease my property</option>
                    </select>
                    <input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
                    <button type="submit" class="w-full bg-brand-electric text-white py-6 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all hover:scale-[1.02] mt-6">Schedule a Free Consultation</button>
                </form>
            </div>
        </section>
    `
};

// --- GLOBAL UI HANDLERS ---
document.getElementById('mobile-trigger').onclick = () => {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
    if(!menu.classList.contains('hidden')) {
        menu.classList.add('flex');
    }
};

document.addEventListener('click', (e) => {
    const menu = document.getElementById('mobile-menu');
    const trigger = document.getElementById('mobile-trigger');
    if (menu && !menu.classList.contains('hidden')) {
        if (!menu.contains(e.target) && !trigger.contains(e.target)) {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
        }
    }
});

const reportedDepths = new Set();
window.onscroll = () => {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    if(height <= 0) return;
    const scrolled = (winScroll / height) * 100;
    const scrollLine = document.getElementById("scroll-line");
    if(scrollLine) scrollLine.style.width = scrolled + "%";
    
    // Scroll Depth Tracking
    const depths = [25, 50, 75, 90];
    depths.forEach(depth => {
        if (scrolled >= depth && !reportedDepths.has(depth)) {
            reportedDepths.add(depth);
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'scroll_depth',
                depth_threshold: depth
            });
        }
    });
    
    const nav = document.getElementById('navbar');
    if(nav) {
        if(winScroll > 60) {
            nav.classList.add('shadow-[0_10px_30px_rgba(0,0,0,0.6)]');
            nav.style.height = '96px';
        } else {
            nav.classList.remove('shadow-[0_10px_30px_rgba(0,0,0,0.6)]');
            nav.style.height = '128px';
        }
    }
    
    // Parallax on hero image
    const heroImg = document.querySelector('.hero-parallax-img');
    if (heroImg && window.innerWidth >= 1024) {
        heroImg.style.transform = `translateY(${winScroll * 0.12}px)`;
    }
};

let fabOpen = false;
const fabContainer = document.getElementById('fab-container');
const fabMain = document.getElementById('fab-main');
const fabIcon = document.getElementById('fab-icon');
const fabMinis = document.querySelectorAll('.fab-mini');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        fabContainer.style.opacity = '1';
        fabContainer.style.pointerEvents = 'all';
        fabContainer.style.transform = 'translateY(0)';
    } else {
        fabContainer.style.opacity = '0';
        fabContainer.style.pointerEvents = 'none';
        fabContainer.style.transform = 'translateY(20px)';
    }
}, { passive: true });

fabMain.addEventListener('click', () => {
    fabOpen = !fabOpen;
    fabMinis.forEach((mini, i) => {
        setTimeout(() => {
            mini.style.opacity = fabOpen ? '1' : '0';
            mini.style.transform = fabOpen ? 'translateY(0)' : 'translateY(16px)';
        }, i * 60);
    });
    fabIcon.style.transform = fabOpen ? 'rotate(45deg)' : 'rotate(0deg)';
    fabIcon.className = fabOpen ? 'fas fa-times text-2xl transition-transform duration-300' : 'fas fa-comments text-2xl transition-transform duration-300';
});

window.addEventListener('hashchange', () => {
    const hash = window.location.hash.substring(1) || 'home';
    if (pages[hash] || hash === 'post-detail') navigateTo(hash, true);
});

document.addEventListener('DOMContentLoaded', () => {
    const hash = window.location.hash.substring(1) || 'home';
    navigateTo(hash);

    // Cookie consent
    const cookieBanner = document.getElementById('cookie-banner');
    if (cookieBanner) {
        const consent = localStorage.getItem('ce_cookie_consent');
        if (!consent) {
            setTimeout(() => {
                cookieBanner.style.transform = 'translateY(0)';
            }, 2000);
        }
        document.getElementById('cookie-accept')?.addEventListener('click', () => {
            localStorage.setItem('ce_cookie_consent', 'accepted');
            cookieBanner.style.transform = 'translateY(100%)';
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({event: 'cookie_consent', choice: 'accepted'});
        });
        document.getElementById('cookie-decline')?.addEventListener('click', () => {
            localStorage.setItem('ce_cookie_consent', 'declined');
            cookieBanner.style.transform = 'translateY(100%)';
        });
    }
});
