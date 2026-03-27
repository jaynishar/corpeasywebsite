/* ===== CorpEasy Interactions JS ===== */
/* Extracted interactive behaviors from SPA script.js for PHP multi-page site */

/* ===== Toast Notifications ===== */
function showToast(message, type = 'success') {
    const existing = document.getElementById('ce-toast');
    if (existing) existing.remove();
    const colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-brand-electric' };
    const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle', info: 'fa-info-circle' };
    const toast = document.createElement('div');
    toast.id = 'ce-toast';
    toast.className = `fixed top-28 right-6 z-[500] ${colors[type]} text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-bold transition-all duration-500 max-w-sm`;
    toast.style.transform = 'translateX(120%)';
    toast.innerHTML = `<i class="fas ${icons[type]}"></i> ${message}`;
    document.body.appendChild(toast);
    requestAnimationFrame(() => { toast.style.transform = 'translateX(0)'; });
    setTimeout(() => { toast.style.transform = 'translateX(120%)'; setTimeout(() => toast.remove(), 500); }, 4000);
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
            btn.classList.remove('bg-brand-electric', 'bg-brand-gold', 'bg-transparent', 'text-brand-electric');
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
        a.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(45deg)';
    }
}

/* ===== Tilt Cards (desktop only) ===== */
function initTiltCards() {
    if (window.innerWidth < 1024) return;
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
            if (shine) shine.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.12), transparent 60%)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            const shine = card.querySelector('.tilt-shine');
            if (shine) shine.style.background = 'none';
        });
    });
}

/* ===== Reveal on Scroll (IntersectionObserver) ===== */
function initRevealObserver() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
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

/* ===== Scroll Event Handlers ===== */
const reportedDepths = new Set();
window.onscroll = () => {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    if (height <= 0) return;
    const scrolled = (winScroll / height) * 100;

    // Scroll progress bar
    const scrollLine = document.getElementById('scroll-line');
    if (scrollLine) scrollLine.style.width = scrolled + '%';

    // Scroll depth tracking (GTM dataLayer)
    const depths = [25, 50, 75, 90];
    depths.forEach(depth => {
        if (scrolled >= depth && !reportedDepths.has(depth)) {
            reportedDepths.add(depth);
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({ event: 'scroll_depth', depth_threshold: depth });
        }
    });

    // Navbar shadow on scroll
    const nav = document.getElementById('navbar');
    if (nav) {
        if (winScroll > 60) {
            nav.classList.add('shadow-[0_10px_30px_rgba(0,0,0,0.06)]');
        } else {
            nav.classList.remove('shadow-[0_10px_30px_rgba(0,0,0,0.06)]');
        }
    }

    // Parallax for hero image
    const heroImg = document.querySelector('.hero-parallax-img');
    if (heroImg && window.innerWidth >= 1024) {
        heroImg.style.transform = `translateY(${winScroll * 0.12}px)`;
    }
};

/* ===== FAB (Floating Action Button) ===== */
let fabOpen = false;
const fabContainer = document.getElementById('fab-container');
const fabMain = document.getElementById('fab-main');
const fabIcon = document.getElementById('fab-icon');
const fabMinis = document.querySelectorAll('.fab-mini');

if (fabContainer && fabMain) {
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
        if (fabIcon) {
            fabIcon.style.transform = fabOpen ? 'rotate(45deg)' : 'rotate(0deg)';
            fabIcon.className = fabOpen
                ? 'fas fa-times text-2xl transition-transform duration-300'
                : 'fas fa-comments text-2xl transition-transform duration-300';
        }
    });
}

/* ===== Mobile Menu Toggle ===== */
const mobileTrigger = document.getElementById('mobile-trigger');
if (mobileTrigger) {
    mobileTrigger.onclick = () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        if (!menu.classList.contains('hidden')) {
            menu.classList.add('flex');
        }
    };
}

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

/* ===== DOMContentLoaded Initialization ===== */
document.addEventListener('DOMContentLoaded', () => {
    // Redirect old hash URLs to new clean URLs
    const hashMap = {
        '#home': '/',
        '#managed': '/managed-office-space-mumbai',
        '#facility': '/facility-management-mumbai',
        '#find': '/office-space-for-rent-mumbai',
        '#list': '/list-commercial-property-mumbai',
        '#blog': '/blog',
        '#about': '/about',
        '#faq': '/faq',
        '#contact': '/contact'
    };
    if (window.location.hash && hashMap[window.location.hash]) {
        window.location.replace(hashMap[window.location.hash]);
    }

    // Initialize interactive components
    initRevealObserver();
    initCountUps();
    initTiltCards();

    // Cookie banner
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
            window.dataLayer.push({ event: 'cookie_consent', choice: 'accepted' });
        });
        document.getElementById('cookie-decline')?.addEventListener('click', () => {
            localStorage.setItem('ce_cookie_consent', 'declined');
            cookieBanner.style.transform = 'translateY(100%)';
        });
    }
});
