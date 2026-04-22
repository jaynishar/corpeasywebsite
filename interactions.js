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
    toast.style.cssText = 'transform:translateX(120%);transition:transform 0.4s cubic-bezier(0.16,1,0.3,1)';
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

    // ── CLIENT-SIDE VALIDATION ────────────────────
    // Full name: must be at least 2 chars
    const nameVal = (formData.full_name || '').trim();
    if (nameVal.length < 2) {
        const nameField = form.querySelector('[name="full_name"]');
        if (nameField) { nameField.style.borderColor = '#ef4444'; nameField.focus(); setTimeout(() => { nameField.style.borderColor = ''; }, 3000); }
        showToast('Please enter your full name.', 'error');
        return;
    }
    // Company name: must not look like a phone number (all digits/symbols)
    const companyVal = (formData.company_name || '').trim();
    if (companyVal && /^[\d\s\+\-\(\)\.]+$/.test(companyVal)) {
        const companyField = form.querySelector('[name="company_name"]');
        if (companyField) {
            companyField.style.borderColor = '#ef4444';
            companyField.value = '';
            companyField.placeholder = 'Company name — not a phone number';
            companyField.focus();
            setTimeout(() => { companyField.style.borderColor = ''; companyField.placeholder = 'Company Name (optional)'; }, 3000);
        }
        showToast('Company Name cannot be a phone number. Please enter your company name.', 'error');
        return;
    }
    // ─────────────────────────────────────────────

    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
    btn.disabled = true;
    try {
        const response = await fetch('submit.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(formData) });
        const result = await response.json();
        if (result.success) {
            // ── CONVERSION TRACKING (fires only after a confirmed server save) ──
            // GA4 key event
            if (typeof gtag === 'function') {
                gtag('event', 'generate_lead', {
                    'currency': 'INR',
                    'value': 5000,
                    'form_type': formData.form_type,
                    'lead_source': 'website_form',
                    'source_page': formData.source_page
                });
                // Google Ads conversion. The send_to label is read from
                // window.CORPEASY_ADS_CONVERSION set in templates/header.php.
                if (window.CORPEASY_ADS_CONVERSION) {
                    gtag('event', 'conversion', {
                        'send_to': window.CORPEASY_ADS_CONVERSION,
                        'value': 5000,
                        'currency': 'INR',
                        'transaction_id': (result.reference || Date.now().toString())
                    });
                }
            }
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'generate_lead',
                'form_type': formData.form_type,
                'lead_source': 'website_form',
                'value': 5000,
                'currency': 'INR',
                'lead_reference': result.reference || ''
            });
            // ──────────────────────────────────────────────────────────────────
            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Received. Redirecting...';
            btn.classList.remove('bg-brand-electric', 'bg-brand-gold', 'bg-brand-cyan', 'bg-brand-rose', 'bg-transparent', 'text-brand-electric');
            btn.classList.add('bg-green-500', 'text-white', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
            // Redirect to thank-you page, this is the most reliable conversion
            // signal because it is a URL based pageview Google Ads can track
            // even if a specific event tag fails.
            setTimeout(() => {
                const ref = result.reference ? ('?ref=' + encodeURIComponent(result.reference)) : '';
                window.location.href = '/thank-you' + ref;
            }, 900);
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
    if (window.innerWidth < 1024 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    // Skip on low-end mobile devices
    if (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4) return;
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const rotateX = ((y - rect.height / 2) / rect.height) * -4;
            const rotateY = ((x - rect.width / 2) / rect.width) * 4;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
        }, { passive: true });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
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

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}

/* ===== Count-Up Animation (uses RAF instead of setInterval) ===== */
function initCountUps() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                entry.target.dataset.counted = 'true';
                const target = +entry.target.getAttribute('data-val');
                const duration = 800; // ms
                const start = performance.now();
                function tick(now) {
                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease-out curve for smooth deceleration
                    const eased = 1 - Math.pow(1 - progress, 3);
                    entry.target.innerText = Math.floor(target * eased);
                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        entry.target.innerText = target;
                    }
                }
                requestAnimationFrame(tick);
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

    // Scroll progress bar
    const scrollLine = document.getElementById('scroll-line');
    if (scrollLine) scrollLine.style.width = pct + '%';

    // Navbar shadow
    const nav = document.getElementById('navbar');
    if (nav) {
        if (winScroll > 60) {
            nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.06)';
        } else {
            nav.style.boxShadow = '';
        }
    }

    // Parallax hero image (desktop only, instant — no CSS transition)
    const heroImg = document.querySelector('.hero-parallax-img');
    if (heroImg && window.innerWidth >= 1024) heroImg.style.transform = `translateY(${winScroll * 0.08}px) scale(1.05)`;

    // FAB show/hide (merged into single RAF handler — no separate listener)
    if (fabContainer) {
        const show = winScroll > 300;
        if (show !== fabVisible) {
            fabVisible = show;
            fabContainer.style.opacity = show ? '1' : '0';
            fabContainer.style.pointerEvents = show ? 'all' : 'none';
            fabContainer.style.transform = show ? 'translateY(0)' : 'translateY(20px)';
        }
    }

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
let fabVisible = false;
const fabContainer = document.getElementById('fab-container');
const fabMain = document.getElementById('fab-main');
const fabIcon = document.getElementById('fab-icon');
const fabMinis = document.querySelectorAll('.fab-mini');

if (fabContainer && fabMain) {
    fabContainer.style.opacity = '0';
    fabContainer.style.pointerEvents = 'none';
    fabContainer.style.transform = 'translateY(20px)';

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

/* ===== Fast Page Transitions (80ms, down from 185ms) ===== */
function initPageTransitions() {
    const overlay = document.createElement('div');
    overlay.id = 'page-overlay';
    overlay.style.cssText = 'position:fixed;inset:0;background:#f8fafc;opacity:0;pointer-events:none;z-index:9999;transition:opacity 0.12s ease';
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
        setTimeout(() => { window.location.href = link.href; }, 80);
    });
}

/* ===== Solutions Dropdown ===== */
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

    document.addEventListener('click', () => {
        nav.classList.remove('is-open');
        if (chevron) chevron.style.transform = '';
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

/* ===== Mobile Persistent WhatsApp FAB (show below the fold) ===== */
function initMobileWhatsAppFab() {
    const fab = document.getElementById('mobile-whatsapp-fab');
    if (!fab) return;
    let shown = false;
    function onScroll() {
        const y = window.scrollY;
        const show = y > 240; // below the fold
        if (show !== shown) {
            shown = show;
            fab.style.opacity = show ? '1' : '0';
            fab.style.pointerEvents = show ? 'auto' : 'none';
            fab.style.transform = show ? 'translateY(0)' : 'translateY(16px)';
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* ===== Exit-Intent Popup (desktop only, once per session) ===== */
function initExitIntent() {
    if (window.innerWidth < 1024) return; // desktop only
    const popup = document.getElementById('exit-intent-popup');
    if (!popup) return;
    if (sessionStorage.getItem('ce_exit_shown')) return;
    const card = popup.querySelector('div');
    const closeBtn = document.getElementById('exit-intent-close');
    let fired = false;

    function open() {
        if (fired) return;
        fired = true;
        sessionStorage.setItem('ce_exit_shown', '1');
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        requestAnimationFrame(() => {
            popup.style.opacity = '1';
            if (card) card.style.transform = 'translateY(0) scale(1)';
        });
        (window.dataLayer = window.dataLayer || []).push({ event: 'exit_intent_shown' });
    }
    function close() {
        popup.style.opacity = '0';
        if (card) card.style.transform = 'translateY(16px) scale(0.98)';
        setTimeout(() => {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
        }, 300);
    }
    document.addEventListener('mouseout', (e) => {
        if (!e.relatedTarget && e.clientY <= 0) open();
    });
    closeBtn?.addEventListener('click', close);
    popup.addEventListener('click', (e) => { if (e.target === popup) close(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !popup.classList.contains('hidden')) close(); });
}

/* ===== DOMContentLoaded Initialization ===== */
document.addEventListener('DOMContentLoaded', () => {
    // Mark JS as loaded — unlocks CSS transitions
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            document.documentElement.classList.add('js-loaded');
        });
    });

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
    initMobileWhatsAppFab();
    initExitIntent();

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

/* ===== bfcache (Back/Forward Cache) Fix =====
 * The page-overlay turns opaque (white) before navigating away.
 * When Chrome restores a page from bfcache on back/forward navigation,
 * event.persisted === true and the overlay is still white — causing the
 * white screen. We reset it immediately on restore.
 */
window.addEventListener('pageshow', function(event) {
    // Always reset the transition overlay — whether from bfcache or normal load
    const overlay = document.getElementById('page-overlay');
    if (overlay) {
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
    }

    if (event.persisted) {
        // Page restored from bfcache — reset any UI state left from navigation
        document.body.style.opacity = '1';
        document.body.style.visibility = 'visible';

        // Close mobile menu if it was open when user navigated away
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) mobileMenu.classList.add('hidden');
    }
});
