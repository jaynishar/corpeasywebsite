/* ===== CorpEasy Interactions JS ===== */

/* ===== Toast Notifications ===== */
function showToast(message, type = 'success') {
    const existing = document.getElementById('ce-toast');
    if (existing) existing.remove();
    const colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-brand-electric' };
    const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle', info: 'fa-info-circle' };
    const toast = document.createElement('div');
    toast.id = 'ce-toast';
    toast.className = `fixed top-28 right-6 z-[500] ${colors[type]} text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-bold max-w-sm`;
    toast.style.cssText = 'transform:translateX(120%);transition:transform 0.4s cubic-bezier(0.16,1,0.3,1);will-change:transform';
    toast.innerHTML = `<i class="fas ${icons[type]}"></i> ${message}`;
    document.body.appendChild(toast);
    requestAnimationFrame(() => requestAnimationFrame(() => { toast.style.transform = 'translateX(0)'; }));
    setTimeout(() => { toast.style.transform = 'translateX(120%)'; setTimeout(() => toast.remove(), 400); }, 4000);
}

/* ===== Form Submission Handler ===== */
async function handleLead(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const formData = {};
    form.querySelectorAll('input, select, textarea').forEach(field => {
        if (field.name && field.name !== 'website') formData[field.name] = field.value;
    });
    formData.form_type = btn.innerText.trim().toLowerCase().replace(/\s+/g, '_').substring(0, 50);
    formData.source_page = window.location.pathname || '/';
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
    btn.disabled = true;
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: 'generate_lead', form_type: formData.form_type, lead_source: 'website_form' });
    try {
        const response = await fetch('submit.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(formData) });
        const result = await response.json();
        if (result.success) {
            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Received. We will be in touch within 24 hours.';
            btn.classList.remove('bg-brand-electric', 'bg-brand-gold', 'bg-brand-cyan', 'bg-brand-rose', 'bg-transparent', 'text-brand-electric');
            btn.classList.add('bg-green-500', 'text-white', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
            if (result.reference) {
                const refEl = document.createElement('p');
                refEl.className = 'text-center text-xs text-slate-500 mt-3 font-mono';
                refEl.textContent = 'Reference: ' + result.reference;
                btn.parentNode.insertBefore(refEl, btn.nextSibling);
            }
            setTimeout(() => {
                form.reset();
                btn.innerHTML = btn.getAttribute('data-original-text') || 'Send My Requirement';
                btn.disabled = false;
                btn.classList.remove('bg-green-500', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
                btn.classList.add('bg-brand-electric');
                const refEl = form.querySelector('.font-mono');
                if (refEl) refEl.remove();
            }, 8000);
        } else {
            throw new Error(result.error || 'Submission failed');
        }
    } catch (error) {
        btn.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Something went wrong. Please call or WhatsApp us.';
        btn.classList.add('bg-red-500', 'text-white');
        btn.disabled = false;
        console.error('Form error:', error);
    }
}

/* ===== Store original button text on click ===== */
document.addEventListener('click', (e) => {
    const btn = e.target.closest('button[type="submit"]');
    if (btn && !btn.getAttribute('data-original-text')) btn.setAttribute('data-original-text', btn.innerText.trim());
});

/* ===== FAQ Toggle ===== */
function toggleFAQ(row) {
    const answer = row.nextElementSibling;
    const icon = row.querySelector('i');
    const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
    document.querySelectorAll('.faq-answer').forEach(a => {
        a.style.maxHeight = '0px';
        const prevIcon = a.previousElementSibling?.querySelector('i');
        if (prevIcon) prevIcon.style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        if (icon) icon.style.transform = 'rotate(45deg)';
    }
}

/* ===== Tilt Cards (desktop only, GPU-composited) ===== */
function initTiltCards() {
    if (window.innerWidth < 1024) return;
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mouseenter', () => { card.style.willChange = 'transform'; }, { passive: true });
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const rotateX = ((y - rect.height / 2) / rect.height) * -5;
            const rotateY = ((x - rect.width / 2) / rect.width) * 5;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
            let shine = card.querySelector('.tilt-shine');
            if (!shine) {
                shine = document.createElement('div');
                shine.className = 'tilt-shine';
                shine.style.cssText = 'position:absolute;inset:0;border-radius:inherit;pointer-events:none';
                card.style.position = 'relative';
                card.style.overflow = 'hidden';
                card.appendChild(shine);
            }
            shine.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.1), transparent 55%)`;
        }, { passive: true });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.willChange = '';
            const shine = card.querySelector('.tilt-shine');
            if (shine) shine.style.background = 'none';
        }, { passive: true });
    });
}

/* ===== Reveal on Scroll (IntersectionObserver) ===== */
function initRevealObserver() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });

    document.querySelectorAll('.reveal').forEach(el => {
        const rect = el.getBoundingClientRect();
        // Already in viewport on page load — activate immediately, no animation delay
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add('active');
        } else {
            observer.observe(el);
        }
    });
}

/* ===== Count-Up Animation ===== */
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
                    if (count >= target) { entry.target.innerText = target; clearInterval(timer); }
                    else { entry.target.innerText = Math.floor(count); }
                }, 30);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-val').forEach(el => observer.observe(el));
}

/* ===== Passive RAF-throttled scroll handler ===== */
let scrollTicking = false;
const reportedDepths = new Set();

function onScrollFrame() {
    const winScroll = window.scrollY;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    if (height <= 0) { scrollTicking = false; return; }
    const pct = (winScroll / height) * 100;

    // Scroll progress bar (no transition — instant, looks crisp)
    const scrollLine = document.getElementById('scroll-line');
    if (scrollLine) scrollLine.style.width = pct + '%';

    // Navbar shadow
    const nav = document.getElementById('navbar');
    if (nav) nav.classList.toggle('shadow-[0_10px_30px_rgba(0,0,0,0.06)]', winScroll > 60);

    // Parallax hero image
    const heroImg = document.querySelector('.hero-parallax-img');
    if (heroImg && window.innerWidth >= 1024) heroImg.style.transform = `translateY(${winScroll * 0.1}px)`;

    // Scroll depth tracking (GTM)
    [25, 50, 75, 90].forEach(depth => {
        if (pct >= depth && !reportedDepths.has(depth)) {
            reportedDepths.add(depth);
            (window.dataLayer = window.dataLayer || []).push({ event: 'scroll_depth', depth_threshold: depth });
        }
    });

    scrollTicking = false;
}

window.addEventListener('scroll', () => {
    if (!scrollTicking) {
        requestAnimationFrame(onScrollFrame);
        scrollTicking = true;
    }
}, { passive: true });

/* ===== FAB (Floating Action Button) ===== */
let fabOpen = false;
const fabContainer = document.getElementById('fab-container');
const fabMain = document.getElementById('fab-main');
const fabIcon = document.getElementById('fab-icon');
const fabMinis = document.querySelectorAll('.fab-mini');

if (fabContainer && fabMain) {
    window.addEventListener('scroll', () => {
        const show = window.scrollY > 300;
        fabContainer.style.opacity = show ? '1' : '0';
        fabContainer.style.pointerEvents = show ? 'all' : 'none';
        fabContainer.style.transform = show ? 'translateY(0)' : 'translateY(20px)';
    }, { passive: true });

    fabMain.addEventListener('click', () => {
        fabOpen = !fabOpen;
        fabMinis.forEach((mini, i) => {
            setTimeout(() => {
                mini.style.opacity = fabOpen ? '1' : '0';
                mini.style.transform = fabOpen ? 'translateY(0)' : 'translateY(16px)';
            }, i * 50);
        });
        if (fabIcon) {
            fabIcon.style.transform = fabOpen ? 'rotate(45deg)' : 'rotate(0deg)';
            fabIcon.className = fabOpen
                ? 'fas fa-times text-2xl transition-transform duration-300'
                : 'fas fa-comments text-2xl transition-transform duration-300';
        }
    });
}

/* ===== Smooth Page Transitions ===== */
function initPageTransitions() {
    // Full-page overlay — covers navbar, dropdown, FAB, everything (z:9999)
    const overlay = document.createElement('div');
    overlay.id = 'page-overlay';
    overlay.style.cssText = 'position:fixed;inset:0;background:#f8fafc;opacity:0;pointer-events:none;z-index:9999;transition:opacity 0.18s ease';
    document.body.appendChild(overlay);

    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href]');
        if (!link) return;
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') ||
            href.startsWith('tel:') || href.startsWith('http') ||
            link.target === '_blank' || e.ctrlKey || e.metaKey || e.shiftKey) return;

        e.preventDefault();
        overlay.style.opacity = '1';
        overlay.style.pointerEvents = 'all';
        setTimeout(() => { window.location.href = link.href; }, 185);
    });
}

/* ===== Solutions Dropdown — click toggle (fixes touch/glitch) ===== */
function initSolutionsDropdown() {
    const nav = document.getElementById('solutions-nav');
    const btn = document.getElementById('solutions-btn');
    const chevron = document.getElementById('solutions-chevron');
    if (!nav || !btn) return;

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = nav.classList.toggle('is-open');
        if (chevron) chevron.style.transform = isOpen ? 'rotate(180deg)' : '';
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!nav.contains(e.target)) {
            nav.classList.remove('is-open');
            if (chevron) chevron.style.transform = '';
        }
    });

    // Close when a menu link is clicked
    nav.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            nav.classList.remove('is-open');
            if (chevron) chevron.style.transform = '';
        });
    });
}

/* ===== Mobile Menu Toggle ===== */
function initMobileMenu() {
    const mobileTrigger = document.getElementById('mobile-trigger');
    if (!mobileTrigger) return;
    mobileTrigger.addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            menu.classList.add('flex');
        } else {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
        }
    });

    document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobile-menu');
        const trigger = document.getElementById('mobile-trigger');
        if (menu && !menu.classList.contains('hidden')) {
            if (!menu.contains(e.target) && trigger && !trigger.contains(e.target)) {
                menu.classList.add('hidden');
                menu.classList.remove('flex');
            }
        }
    });
}

/* ===== DOMContentLoaded Initialization ===== */
document.addEventListener('DOMContentLoaded', () => {
    // Redirect old hash URLs
    const hashMap = {
        '#home': '/', '#managed': '/managed-office-space-mumbai',
        '#facility': '/facility-management-mumbai', '#find': '/office-space-for-rent-mumbai',
        '#list': '/list-commercial-property-mumbai', '#blog': '/blog',
        '#about': '/about', '#faq': '/faq', '#contact': '/contact'
    };
    if (window.location.hash && hashMap[window.location.hash]) {
        window.location.replace(hashMap[window.location.hash]);
    }

    initRevealObserver();
    initCountUps();
    initTiltCards();
    initSolutionsDropdown();
    initMobileMenu();
    initPageTransitions();

    // Cookie banner
    const cookieBanner = document.getElementById('cookie-banner');
    if (cookieBanner) {
        if (!localStorage.getItem('ce_cookie_consent')) {
            setTimeout(() => { cookieBanner.style.transform = 'translateY(0)'; }, 2000);
        }
        document.getElementById('cookie-accept')?.addEventListener('click', () => {
            localStorage.setItem('ce_cookie_consent', 'accepted');
            cookieBanner.style.transform = 'translateY(100%)';
            (window.dataLayer = window.dataLayer || []).push({ event: 'cookie_consent', choice: 'accepted' });
        });
        document.getElementById('cookie-decline')?.addEventListener('click', () => {
            localStorage.setItem('ce_cookie_consent', 'declined');
            cookieBanner.style.transform = 'translateY(100%)';
        });
    }
});
