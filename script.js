const portal = document.getElementById('view-portal');
let activeChart = null;
let heroWordInterval = null;
let postData = {};
let postsLoaded = false;

async function loadPosts() {
    try {
        const response = await fetch('get_posts.php');
        const data = await response.json();
        if(data.success && data.posts && data.posts.length > 0) {
            postData = {};
            data.posts.forEach(post => {
                const slug = post.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                postData[slug] = {
                    id: post.id,
                    title: post.title,
                    category: post.category || 'Insights',
                    readTime: post.read_time || '5 Min Read',
                    image: post.image_url || 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
                    excerpt: post.excerpt || '',
                    content: post.content || '',
                    author: post.author || 'CorpEasy Team',
                    published_at: post.published_at
                };
            });
            postsLoaded = true;
        }
    } catch(e) {
        console.error('Failed to load posts:', e);
    }
    return postData;
}

function getCategoryColor(category) {
    const colors = {
        'Market Guide': 'text-brand-violet',
        'Market Trends': 'text-brand-cyan',
        'Finance & Compliance': 'text-brand-rose',
        'Explainer': 'text-brand-electric',
        'Insights': 'text-brand-electric',
        'Industry News': 'text-brand-amber',
        'Tips & Guide': 'text-brand-emerald'
    };
    return colors[category] || 'text-brand-electric';
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
}

const fallbackPosts = {
'mumbai-workspace-guide': {
title: "How to Find the Right Office Space in Mumbai: A Practical Guide for 2026.",
category: "Market Guide",
readTime: "6 Min Read",
image: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200",
content: `<p>Finding <strong>office space in Mumbai</strong> looks straightforward on paper but becomes complicated in practice. Between understanding micro-market rent differences, negotiating lease terms, coordinating furniture and IT setup, and managing multiple vendors, most companies spend far more time on it than they budgeted for. This guide walks through what the process actually looks like, and where things go wrong.</p> <h3>Start With the Right Micro-Market</h3> <p>Mumbai's commercial office market is not one market. It is several, each with its own rent levels, building quality, commute dynamics, and tenant profile. BKC commands the highest rents at roughly ₹450 to ₹750 per sq ft per month for Grade A space. Lower Parel and Worli sit in the ₹250 to ₹450 range with strong Western Railway access. Goregaon East, particularly around Nirlon Knowledge Park, suits tech and mid-size companies at ₹150 to ₹300. Andheri East offers airport proximity at ₹150 to ₹400. Powai is ideal for campus-style spaces at ₹115 to ₹310.</p> <p>The right location depends on where your team commutes from, whether clients visit your office, and your realistic monthly cost tolerance. Getting this wrong creates expensive problems downstream.</p> <h3>What Office Space in Mumbai Actually Costs</h3> <p>The headline rent is rarely the full cost. On top of base rent, budget for a security deposit of three to six months' rent paid upfront, a maintenance charge of ₹15 to ₹30 per sq ft per month on top of rent, GST at 18% (claimable as ITC for most registered businesses), parking, and the workspace setup itself. If you take a bare shell and do your own fit-out, you can add ₹800 to ₹2,000 per sq ft and three to six months of setup time.</p> <h3>Why the Managed Office Model Is Growing</h3> <p>The managed office model exists because the traditional route is genuinely time-consuming. When a company takes a managed workspace, they are not dealing with the landlord, the furniture vendor, and the IT contractor as separate parties. They deal with one operator, pay one monthly fee, and move in to a workspace that is ready from Day 1.</p>`
},
'bkc-vs-goregaon': {
title: "BKC or Goregaon? Choosing the Right Mumbai Location for Your Office.",
category: "Market Trends",
readTime: "5 Min Read",
image: "https://images.unsplash.com/photo-1554469384-e58fac16e23a?auto=format&fit=crop&q=80&w=1200",
content: `<p>One of the most common questions companies face when looking for <strong>office space in Mumbai</strong>: do we go to BKC for the address, or Goregaon for the value? Both are legitimate choices. The right answer depends on what actually matters for your business.</p> <h3>The Case for BKC</h3> <p>Bandra Kurla Complex is Mumbai's most recognised commercial address. It is home to major banks, global financial institutions, and professional services firms. If clients visit your office and an address shapes their perception of you, BKC is worth the premium. Metro Line 3 has improved access considerably, though road congestion during peak hours is a real issue for daily commuters. Rents currently run ₹450 to ₹750 per sq ft per month for Grade A space.</p> <h3>The Case for Goregaon</h3> <p>Goregaon East, particularly the Nirlon Knowledge Park and NESCO cluster, has matured significantly. It attracts tech companies, media businesses, and mid-size enterprises that need larger floor plates at prices that make operational sense. Rents typically sit at ₹150 to ₹300 per sq ft. This is a meaningful saving against BKC for equivalent building quality. Western Express Highway and Metro Line 2A provide solid western suburbs connectivity.</p>`
},
'managed-office-explainer': {
title: "What Is a Managed Office Space and Is It Right for Your Business?",
category: "Explainer",
readTime: "4 Min Read",
image: "https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200",
content: `<p>The term "managed office" gets used loosely in the Indian commercial real estate market. Here is what it actually means, and what it does not.</p> <h3>What a Managed Office Actually Is</h3> <p>A <strong>managed office space</strong> is a commercially leased workspace that has been sourced, set up, and is maintained on your behalf by a workspace operator. Instead of you finding the property, negotiating with the landlord, coordinating workspace setup, and managing facility issues, all of that is handled by the operator. You pay a single monthly fee per seat and get a space that is ready to work in from Day 1. The key distinction from coworking is exclusivity: in a coworking space, you share with other companies. In a managed office, the space is yours alone.</p>`
},
'gst-office-rental': {
title: "GST on Commercial Office Rentals in Mumbai: What You Need to Know.",
category: "Finance & Compliance",
readTime: "4 Min Read",
image: "https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800",
content: `<p>GST on commercial property rentals comes up in most conversations about leasing <strong>office space in Mumbai</strong>. Understanding the basics saves confusion later in the process.</p> <h3>The Basics</h3> <p>Commercial office rentals in India attract GST at 18%. This is charged on top of your base rent. If your company is GST-registered and uses the office for business purposes, you are generally eligible to claim Input Tax Credit on the GST paid. This means it offsets your outward GST liability rather than being a pure additional cost. For most registered businesses, the effective net GST burden is significantly lower than the headline 18%.</p>`
}
};

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

async function navigateTo(pageId, fromHash = false) {
document.getElementById('mobile-menu').classList.add('hidden');
const loader = document.getElementById('page-loader');
if (loader) {
loader.style.transition = 'none'; loader.style.width = '0%'; loader.style.opacity = '1';
requestAnimationFrame(() => { loader.style.transition = 'width 0.35s ease'; loader.style.width = '70%'; });
}
const existingProgress = document.getElementById('reading-progress');
if (existingProgress) existingProgress.remove();
if (!fromHash && pageId !== 'post-detail') {
if (window.location.hash !== '#' + pageId) { window.location.hash = pageId; return; }
}
if (pageId !== 'post-detail') {
const existingSchema = document.getElementById('article-schema');
if (existingSchema) existingSchema.remove();
}
portal.style.opacity = '0'; portal.style.transform = 'translateY(15px)';
const renderPage = async () => {
window.scrollTo(0, 0);
if(activeChart) { activeChart.destroy(); activeChart = null; }
let pageContent = pages[pageId] || pages['home'];
if (typeof pageContent === 'function') {
pageContent = await pageContent();
}
portal.innerHTML = `<div class="page-transition">${pageContent}</div>`;
portal.style.opacity = '1'; portal.style.transform = 'translateY(0)';
if (pageId === 'home' || !pageId) initHomeLogic();
initRevealObserver(); initCountUps(); initTiltCards();
document.querySelectorAll('[onclick^="navigateTo"]').forEach(el => {
el.classList.remove('text-brand-electric', 'font-black');
if (el.tagName === 'A' && el.classList.contains('text-xs')) el.classList.add('text-slate-600');
});
const activeLinks = document.querySelectorAll(`[onclick="navigateTo('${pageId}')"]`);
activeLinks.forEach(el => { el.classList.remove('text-slate-600'); el.classList.add('text-brand-electric', 'font-black'); });
if (loader) { loader.style.width = '100%'; setTimeout(() => { loader.style.opacity = '0'; loader.style.width = '0%'; }, 400); }
};
setTimeout(renderPage, 150);
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({ 'event': 'virtual_pageview', 'page_path': '/' + (pageId || 'home'), 'page_title': 'CorpEasy | ' + (pageId || 'home').charAt(0).toUpperCase() + (pageId || 'home').slice(1) });
}

function viewPost(postId) {
let post = postData[postId];
if(!post) {
    post = fallbackPosts[postId];
}
if(!post) {
    console.error('Post not found:', postId);
    return;
}
const existingSchema = document.getElementById('article-schema');
if (existingSchema) existingSchema.remove();
const schemaScript = document.createElement('script');
schemaScript.type = 'application/ld+json'; schemaScript.id = 'article-schema';
schemaScript.text = JSON.stringify({ "@context": "https://schema.org", "@type": "Article", "headline": post.title, "datePublished": "2026-03-01", "author": {"@type": "Organization", "name": "CorpEasy"}, "publisher": {"@id": "https://www.corpeasy.in/#organization"} });
document.head.appendChild(schemaScript);
const postTemplate = `<section class="max-w-4xl mx-auto px-6 py-12 lg:py-24"> <button onclick="navigateTo('blog')" class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-electric transition-colors mb-12"> <i class="fas fa-arrow-left"></i> Back to Insights </button> <div class="mb-12"> <span class="px-4 py-1.5 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-xs font-medium rounded-full mb-6 inline-block">${post.category}</span> <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">${post.title}</h1> <div class="flex items-center gap-6 text-slate-600 text-sm font-medium"> <span><i class="far fa-clock mr-2 text-brand-electric"></i> ${post.readTime}</span> <span><i class="far fa-calendar-alt mr-2 text-brand-electric"></i> 2026</span> <span><i class="far fa-user mr-2 text-brand-electric"></i> CorpEasy</span> </div> </div> <div class="rounded-[3rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.1)] h-[400px] lg:h-[550px] mb-16 border border-white/80"> <img loading="lazy" src="${post.image}" alt="${post.title}" class="w-full h-full object-cover"> </div> <div class="prose-content">${post.content}</div> <div class="mt-24 pt-16 border-t border-white/80 flex flex-col md:flex-row justify-between items-center gap-8"> <div> <h4 class="text-xl font-bold text-slate-900 mb-4">Share this article</h4> <div class="flex gap-4"> <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-linkedin-in text-lg"></i></a> <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fab fa-twitter text-lg"></i></a> <a href="#" class="w-12 h-12 bg-white/70 border border-white/80 rounded-xl flex items-center justify-center hover:bg-brand-electric hover:text-white transition-all"><i class="fas fa-link text-lg"></i></a> </div> </div> <button onclick="navigateTo('contact')" class="bg-brand-electric text-white px-10 py-5 rounded-lg font-medium text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:scale-105 transition-all">Talk to Us About Your Requirement</button> </div> </section>`;
pages['post-detail'] = postTemplate;
navigateTo('post-detail');
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({ 'event': 'article_view', 'article_id': postId, 'article_title': post.title });
setTimeout(() => {
const article = document.querySelector('.prose-content');
if (!article) return;
const progressBar = document.createElement('div');
progressBar.id = 'reading-progress'; progressBar.className = 'fixed top-1 left-0 h-0.5 bg-brand-electric z-[998] w-0';
progressBar.style.transition = 'width 0.1s linear';
document.body.appendChild(progressBar);
const updateProgress = () => {
const articleRect = article.getBoundingClientRect(); const articleHeight = article.offsetHeight;
const windowHeight = window.innerHeight; const scrolled = Math.max(0, -articleRect.top);
const percent = Math.min(100, (scrolled / (articleHeight - windowHeight)) * 100);
if (document.getElementById('reading-progress')) document.getElementById('reading-progress').style.width = percent + '%';
};
window.addEventListener('scroll', updateProgress, { passive: true });
}, 400);
}

let roiEngaged = false;
function updateROI() {
const seats = parseInt(document.getElementById('roi-slider').value);
if (!roiEngaged) { window.dataLayer = window.dataLayer || []; window.dataLayer.push({event: 'roi_calculator_engaged', seat_count: seats}); roiEngaged = true; }
document.getElementById('roi-seat-count').innerText = seats.toLocaleString();
const capexPreserved = (seats * 1.95).toFixed(0); const annualSavings = (seats * 5.4 * 12 / 100).toFixed(1);
const capexVal = parseInt(capexPreserved); const savingsVal = parseFloat(annualSavings);
document.getElementById('roi-capex').innerText = capexVal > 1000 ? (capexVal/100).toFixed(1) + " Cr" : capexVal.toLocaleString() + " L";
document.getElementById('roi-savings').innerText = savingsVal > 100 ? (savingsVal/100).toFixed(1) + " Cr" : savingsVal.toLocaleString() + " L";
if(activeChart) { const modifier = seats / 400; activeChart.data.datasets[1].data = [35, 60, 95, 130 + (modifier * 15), 170 + (modifier * 25)]; activeChart.update('none'); }
}

function initHomeLogic() {
const ctx = document.getElementById('kineticChart');
if(ctx) {
Chart.defaults.color = '#475569'; Chart.defaults.font.family = 'Plus Jakarta Sans';
activeChart = new Chart(ctx, {
type: 'line',
data: {
labels: ['Yr 1', 'Yr 2', 'Yr 3', 'Yr 4', 'Yr 5'],
datasets: [
{ label: 'DIY Traditional Setup', data: [80, 110, 150, 200, 260], borderColor: '#cbd5e1', borderWidth: 2, borderDash: [5, 5], tension: 0.4, pointRadius: 0 },
{ label: 'With CorpEasy', data: [35, 60, 95, 140, 180], borderColor: '#6366f1', borderWidth: 4, tension: 0.4, fill: true,
backgroundColor: (context) => {
const chart = context.chart; const {ctx, chartArea} = chart; if (!chartArea) return null;
const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
gradient.addColorStop(0, 'rgba(99, 102, 241, 0)'); gradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)');
return gradient;
}, pointRadius: 6, pointBackgroundColor: '#6366f1', pointBorderColor: '#ffffff', pointBorderWidth: 3
}
]
},
options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false }, ticks: { font: { weight: '700', size: 11 }, color: '#94a3b8' } } } }
});
updateROI();
}
if (heroWordInterval) clearInterval(heroWordInterval);
const heroWords = ['Office.', 'Team.', 'Workspace.', 'Address.'];
let wordIndex = 0;
const heroWordEl = document.getElementById('hero-word');
if (heroWordEl) {
heroWordInterval = setInterval(() => {
heroWordEl.style.opacity = '0'; heroWordEl.style.transform = 'translateY(-12px)';
setTimeout(() => { wordIndex = (wordIndex + 1) % heroWords.length; heroWordEl.textContent = heroWords[wordIndex]; heroWordEl.style.opacity = '1'; heroWordEl.style.transform = 'translateY(0)'; }, 400);
}, 2500);
}
}

function initTiltCards() {
if (window.innerWidth < 1024) return;
document.querySelectorAll('.glass-card').forEach(card => {
card.addEventListener('mousemove', (e) => {
const rect = card.getBoundingClientRect(); const x = e.clientX - rect.left; const y = e.clientY - rect.top;
const centerX = rect.width / 2; const centerY = rect.height / 2;
const rotateX = ((y - centerY) / centerY) * -6; const rotateY = ((x - centerX) / centerX) * 6;
card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
let shine = card.querySelector('.tilt-shine');
if (!shine) { shine = document.createElement('div'); shine.className = 'tilt-shine absolute inset-0 rounded-[2.5rem] pointer-events-none'; card.style.position = 'relative'; card.style.overflow = 'hidden'; card.appendChild(shine); }
if (shine) shine.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(255,255,255,0.12), transparent 60%)`;
});
card.addEventListener('mouseleave', () => { card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)'; const shine = card.querySelector('.tilt-shine'); if (shine) shine.style.background = 'none'; });
});
}

function initRevealObserver() {
const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); }); }, { threshold: 0.15 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}

function initCountUps() {
const observer = new IntersectionObserver((entries) => {
entries.forEach(entry => {
if (entry.isIntersecting && !entry.target.dataset.counted) {
entry.target.dataset.counted = 'true';
const target = +entry.target.getAttribute('data-val'); let count = 0; const inc = target / 40;
const timer = setInterval(() => { count += inc; if (count >= target) { entry.target.innerText = target; clearInterval(timer); } else { entry.target.innerText = Math.floor(count); } }, 35);
}
});
}, { threshold: 0.5 });
document.querySelectorAll('.stat-val').forEach(el => observer.observe(el));
}

async function handleLead(e) {
e.preventDefault();
const form = e.target; const btn = form.querySelector('button[type="submit"]');
const formData = {};
form.querySelectorAll('input, select, textarea').forEach(field => { if (field.name && field.name !== 'website') formData[field.name] = field.value; });
formData.form_type = btn.innerText.trim().toLowerCase().replace(/\s+/g, '_').substring(0, 50);
formData.source_page = window.location.hash || '#home';
btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...'; btn.disabled = true;
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({ event: 'generate_lead', form_type: formData.form_type, lead_source: 'website_form' });

// Google Ads conversion tracking
if (typeof gtag === 'function') {
  gtag('event', 'conversion', {
    'send_to': 'AW-17703392736/SUBMIT_LEAD_FORM',
    'event_category': 'lead',
    'event_label': formData.form_type || 'website_form'
  });
}

try {
const response = await fetch('submit.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(formData) });
const result = await response.json();
if (result.success) {
btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Received. We will be in touch within 24 hours.';
btn.classList.remove('bg-brand-electric', 'bg-brand-gold', 'bg-transparent', 'text-brand-electric');
btn.classList.add('bg-green-500', 'text-white', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent');
if (result.reference) { const refEl = document.createElement('p'); refEl.className = 'text-center text-xs text-slate-500 mt-3 font-mono'; refEl.textContent = 'Reference: ' + result.reference; btn.parentNode.insertBefore(refEl, btn.nextSibling); }
setTimeout(() => { form.reset(); btn.innerHTML = btn.getAttribute('data-original-text') || 'Send My Requirement'; btn.disabled = false; btn.classList.remove('bg-green-500', 'shadow-[0_0_20px_rgba(34,197,94,0.5)]', 'border-transparent'); btn.classList.add('bg-brand-electric'); const refEl = form.querySelector('.font-mono'); if (refEl) refEl.remove(); }, 8000);
} else { throw new Error(result.error || 'Submission failed'); }
} catch (error) {
btn.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Something went wrong. Please call or WhatsApp us.';
btn.classList.add('bg-red-500', 'text-white'); btn.disabled = false; console.error('Form error:', error);
}
}

document.addEventListener('click', (e) => { const btn = e.target.closest('button[type="submit"]'); if (btn && !btn.getAttribute('data-original-text')) btn.setAttribute('data-original-text', btn.innerText.trim()); });

function toggleFAQ(row) {
const answer = row.nextElementSibling; const icon = row.querySelector('i');
const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
document.querySelectorAll('.faq-answer').forEach(a => { a.style.maxHeight = '0px'; a.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)'; });
if (!isOpen) { answer.style.maxHeight = answer.scrollHeight + 'px'; icon.style.transform = 'rotate(45deg)'; }
}

const pages = {
home: `
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
<button onclick="navigateTo('contact')" class="bg-brand-electric text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-brand-blue transition-all w-full sm:w-auto">Get a Free Consultation</button>
<a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20am%20looking%20for%20office%20space%20in%20Mumbai." target="_blank" class="bg-green-500 text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-green-600 transition-all flex items-center justify-center gap-2 w-full sm:w-auto">
<i class="fab fa-whatsapp"></i> WhatsApp
</a>
</div>
<button onclick="navigateTo('managed')" class="text-slate-600 text-sm font-medium flex items-center gap-2 hover:text-brand-electric transition-colors">
Learn how it works <i class="fas fa-arrow-right text-sm"></i>
</button>
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
<a onclick="navigateTo('facility')" class="inline-flex items-center gap-2 mt-6 text-xs font-black uppercase tracking-widest text-brand-rose hover:gap-4 transition-all cursor-pointer">Learn More <i class="fas fa-arrow-right"></i></a>
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
<div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer" onclick="navigateTo('contact')">
<div class="inline-block px-3 py-1 bg-brand-gold/10 border border-brand-gold/30 text-brand-gold text-xs font-medium uppercase rounded-full mb-6">Premium Hub</div>
<div class="w-16 h-16 bg-brand-gold/10 border border-brand-gold/30 rounded-2xl flex items-center justify-center mb-6 text-brand-gold shadow-[0_0_15px_rgba(251,191,36,0.2)]"><i class="fas fa-star text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">BKC, Mumbai</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">Mumbai's most recognised commercial address. We source <strong>managed office space in BKC</strong> for companies that need a credible address in India's financial district.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹450 to ₹750/sqft</p></div>
</div>
<div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-100" onclick="navigateTo('contact')">
<div class="inline-block px-3 py-1 bg-brand-electric/10 border border-brand-electric/30 text-brand-electric text-xs font-medium uppercase rounded-full mb-6">Well Connected</div>
<div class="w-16 h-16 bg-brand-electric/10 border border-brand-electric/30 rounded-2xl flex items-center justify-center mb-6 text-brand-electric shadow-[0_0_15px_rgba(99,102,241,0.2)]"><i class="fas fa-building-columns text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Lower Parel & Worli</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">A well connected commercial corridor with Grade A buildings and strong transport links. Popular with companies looking for <strong>office space for rent in Lower Parel</strong>.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹250 to ₹450/sqft</p></div>
</div>
<div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-200" onclick="navigateTo('contact')">
<div class="inline-block px-3 py-1 bg-brand-cyan/10 border border-brand-cyan/30 text-brand-cyan text-xs font-medium uppercase rounded-full mb-6">Good Value</div>
<div class="w-16 h-16 bg-brand-cyan/10 border border-brand-cyan/30 rounded-2xl flex items-center justify-center mb-6 text-brand-cyan shadow-[0_0_15px_rgba(6,182,212,0.2)]"><i class="fas fa-chart-line text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Goregaon & Nirlon</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">One of Mumbai's most active commercial zones, particularly for tech and mid-size companies. Strong availability of <strong>commercial office space in Goregaon</strong> at practical costs.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹150 to ₹300/sqft</p></div>
</div>
<div class="glass-card p-8 group hover:border-brand-electric/40 cursor-pointer delay-300" onclick="navigateTo('contact')">
<div class="inline-block px-3 py-1 bg-brand-violet/10 border border-brand-violet/30 text-brand-violet text-xs font-medium uppercase rounded-full mb-6">Airport Corridor</div>
<div class="w-16 h-16 bg-brand-violet/10 border border-brand-violet/30 rounded-2xl flex items-center justify-center mb-6 text-brand-violet shadow-[0_0_15px_rgba(139,92,246,0.2)]"><i class="fas fa-plane-departure text-2xl"></i></div>
<h4 class="text-2xl font-bold text-slate-900 mb-3">Andheri East & SEEPZ</h4>
<p class="text-sm text-slate-500 leading-relaxed mb-6">Well connected to the airport and the western suburbs. A practical choice for teams looking for <strong>office space for rent in Andheri</strong> with solid metro and road access.</p>
<div class="flex items-center justify-between pt-4 border-t border-white/60"><p class="text-xs text-slate-500 font-medium">Typical Rent</p><p class="text-sm font-bold text-slate-900">₹150 to ₹400/sqft</p></div>
</div>
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
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Dealing with the landlord</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">You do it directly</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ We handle it</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Coordinating workspace setup</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">You manage the vendors</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ We take care of it</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Time from decision to move in</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Several months, typically</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ A few weeks, typically</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Cost clarity before signing</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Hard to pin down upfront</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Clear per seat cost shown first</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Number of vendors to manage</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Multiple, separately</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Just us</td></tr>
<tr class="bg-white/40"><td class="py-5 px-8 text-slate-700 font-semibold border-b border-white/60">Commitment structure</td><td class="py-5 px-8 text-slate-500 text-center border-b border-white/60">Open ended or complex</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5 border-b border-brand-electric/20">✅ Fixed lease, clear terms</td></tr>
<tr class="bg-white/20"><td class="py-5 px-8 text-slate-700 font-semibold">Property sourcing expertise</td><td class="py-5 px-8 text-slate-500 text-center">Limited to your own network</td><td class="py-5 px-8 text-green-600 font-bold text-center bg-brand-electric/5">✅ Our core strength</td></tr>
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
`,
blog: async () => {
const posts = postsLoaded ? postData : fallbackPosts;
const postKeys = Object.keys(posts);
const featuredKey = postKeys[0];
const featured = posts[featuredKey];
const gridPosts = postKeys.slice(1);
const gridHTML = gridPosts.map((key, i) => {
    const p = posts[key];
    return `<div class="blog-card group cursor-pointer reveal ${i === 1 ? 'delay-100' : i === 2 ? 'delay-200' : ''}" onclick="viewPost('${key}')">
<div class="h-56 overflow-hidden rounded-t-[2rem]"><img loading="lazy" src="${p.image}" alt="${p.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-80 group-hover:opacity-100"></div>
<div class="p-8">
<p class="text-xs font-medium ${getCategoryColor(p.category)} uppercase mb-3">${p.category}</p>
<h4 class="text-2xl font-bold text-slate-900 mb-4 leading-tight group-hover:text-brand-electric transition-colors">${p.title}</h4>
<p class="text-sm text-slate-600 mb-8 leading-relaxed">${p.excerpt || p.content.replace(/<[^>]*>/g, '').substring(0, 150)}...</p>
<span class="text-sm font-medium text-brand-electric flex items-center gap-2 group-hover:gap-4 transition-all">Read More <i class="fas fa-arrow-right"></i></span>
</div>
</div>`;
}).join('');
return `<section class="max-w-7xl mx-auto px-6 py-24 reveal">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
<div class="max-w-2xl">
<div class="inline-flex items-center space-x-2 mb-8 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse"></span>
<span class="text-xs font-semibold uppercase tracking-wide text-brand-electric">Useful Reading</span>
</div>
<h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 leading-none">The <span class="text-gradient-vibrant">Insights</span> Hub.</h1>
<p class="text-xl text-slate-600 mt-8 leading-relaxed">Practical articles on office space in Mumbai, commercial real estate, and workspace decisions. Written plainly for business owners and operations teams.</p>
</div>
</div>
${featured ? `<div class="group cursor-pointer mb-24 reveal delay-100" onclick="viewPost('${featuredKey}')">
<div class="glass-card p-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="rounded-[2rem] overflow-hidden h-[450px]">
<img loading="lazy" src="${featured.image}" alt="${featured.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90">
</div>
<div class="p-6 lg:p-10">
<div class="flex items-center gap-4 mb-6">
<span class="px-4 py-1.5 bg-brand-electric text-white text-xs font-semibold rounded-full uppercase tracking-widest shadow-[0_0_15px_rgba(99,102,241,0.4)]">Featured Guide</span>
<span class="text-xs text-slate-600 font-bold flex items-center"><i class="far fa-clock mr-2"></i> ${featured.readTime}</span>
</div>
<h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-8 leading-tight group-hover:text-brand-electric transition-colors">${featured.title}</h2>
<p class="text-lg text-slate-600 mb-10 leading-relaxed">${featured.excerpt || featured.content.replace(/<[^>]*>/g, '').substring(0, 200)}...</p>
<a class="text-sm font-black uppercase tracking-widest text-brand-electric flex items-center gap-4 group-hover:gap-6 transition-all">Read the Guide <i class="fas fa-arrow-right"></i></a>
</div>
</div>
</div>` : ''}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
${gridHTML}
</div>
</section>
`;
},
managed: `
<section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">
<div class="order-2 lg:order-1 flex flex-col justify-center">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-cyan/10 border border-brand-cyan/30 rounded-full px-4 py-1.5 backdrop-blur-md w-max">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-cyan">Managed Office Space · Mumbai</span>
</div>
<h1 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-6">Your Office,<br><span class="text-gradient-vibrant">Found and Ready.</span></h1>
<div class="space-y-3 mb-4">
<p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> We find the right commercial space for your team in Mumbai.</p>
<p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> We handle the workspace setup. You coordinate zero contractors.</p>
<p class="flex items-center gap-3 text-slate-700 font-medium"><i class="fas fa-check-circle text-brand-electric"></i> One clear per seat cost. A fixed lease. No hidden charges.</p>
</div>
<p class="text-lg text-slate-600 mt-4 leading-relaxed">Looking for <strong>managed office space in Mumbai</strong> without months of searching, negotiating, and setting up? We handle the entire process. From identifying the right commercial property to handing you a workspace that is ready when your team is.</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
<div class="glass-card p-5"><h4 class="text-base font-bold text-slate-900">No Landlord Hassle</h4><p class="text-xs text-slate-600 mt-1">We negotiate with the landlord directly. You have one clean agreement with us.</p></div>
<div class="glass-card p-5"><h4 class="text-base font-bold text-slate-900">Setup Included</h4><p class="text-xs text-slate-600 mt-1">Basic furniture, internet, and workspace essentials sorted before you move in.</p></div>
<div class="glass-card p-5"><h4 class="text-base font-bold text-slate-900">Fixed Monthly Cost</h4><p class="text-xs text-slate-600 mt-1">A clear per seat fee for a fixed lease period. No surprises month to month.</p></div>
</div>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
<div class="glass-card p-8 border-t-4 border-t-brand-electric shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3"><i class="fas fa-building text-brand-electric"></i> Tell Us Your Office Requirement</h3>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
<input type="email" name="email" placeholder="Work Email" class="input-premium" required>
<input type="tel" name="phone" placeholder="Phone Number" class="input-premium" required>
<input type="text" name="requirement" placeholder="Team size and preferred location (e.g. 30 seats, BKC)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-electric text-white py-3 rounded-lg font-medium text-sm hover:bg-brand-blue transition-all">Submit Your Requirement</button>
</form>
<p class="text-xs text-slate-500 text-center mt-3 flex items-center justify-center gap-2"><i class="fas fa-lock text-brand-electric text-xs"></i> Your details are safe with us. No spam, ever.</p>
</div>
</div>
</section>
<section class="py-12 px-6">
<div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[400px] lg:h-[550px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1920" alt="Managed office space Mumbai" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1200" height="550">
<div class="absolute inset-0 bg-gradient-to-tr from-brand-electric/40 via-transparent to-transparent"></div>
<div class="absolute bottom-6 right-6 lg:bottom-10 lg:right-10 bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Managed and Ready</span>
</div>
</div>
</section>
<section class="py-24 bg-white/40">
<div class="max-w-7xl mx-auto px-6 relative z-10">
<div class="text-center">
<h2 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter mb-6">What CorpEasy Takes Off Your Plate.</h2>
<p class="text-xl text-slate-500 mb-16 max-w-3xl mx-auto">Setting up an office in Mumbai involves more moving parts than most companies expect. Here is what we handle from start to finish.</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 reveal">
<div class="glass-card p-10">
<div class="w-16 h-16 bg-brand-blue/30 border border-brand-electric/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-electric shadow-[0_0_20px_rgba(0,240,255,0.2)]"><i class="fas fa-search-location"></i></div>
<h4 class="text-2xl font-bold mb-4 text-slate-900">Property Search and Negotiation</h4>
<p class="text-slate-600 leading-relaxed">We identify suitable commercial properties across Mumbai based on your requirement, approach landlords, and negotiate the lease on your behalf.</p>
</div>
<div class="glass-card p-10">
<div class="w-16 h-16 bg-brand-cyan/20 border border-brand-cyan/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-cyan shadow-[0_0_20px_rgba(6,182,212,0.2)]"><i class="fas fa-tools"></i></div>
<h4 class="text-2xl font-bold mb-4 text-slate-900">Workspace Setup and Readiness</h4>
<p class="text-slate-600 leading-relaxed">Once the space is secured, we manage the basic setup. Furniture, internet connection, and a clean functional working environment ready for Day 1.</p>
</div>
<div class="glass-card p-10">
<div class="w-16 h-16 bg-brand-violet/20 border border-brand-violet/50 rounded-2xl flex items-center justify-center text-3xl mb-8 text-brand-violet shadow-[0_0_20px_rgba(139,92,246,0.2)]"><i class="fas fa-headset"></i></div>
<h4 class="text-2xl font-bold mb-4 text-slate-900">Your Ongoing Point of Contact</h4>
<p class="text-slate-600 leading-relaxed">After you move in, we remain available for any issues related to the space or the lease. You have a single point of contact.</p>
</div>
</div>
</div>
</section>
`,
find: `
<section class="py-12 lg:py-24 px-4 sm:px-6 relative reveal">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] bg-brand-cyan opacity-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
<div class="max-w-2xl mx-auto mb-12 relative z-10">
<div class="glass-card p-6 sm:p-8 border-t-4 border-t-brand-cyan shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg sm:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-search-location text-brand-cyan"></i> Tell Us What You Are Looking For</h3>
<p class="text-sm text-slate-600 mb-4 sm:mb-6">Share your location preference, team size, and budget. We will come back with suitable options within 24 to 48 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Full Name *" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name *" class="input-premium" required>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
<input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
</div>
<input type="text" name="requirement" placeholder="Your requirement (e.g. BKC, 30 seats)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-cyan text-white py-3 sm:py-4 rounded-xl font-bold uppercase tracking-wider text-xs sm:text-sm hover:scale-[1.02] shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all">Share My Requirement</button>
</form>
</div>
</div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 p-6 sm:p-10 lg:p-12 bg-white/40 backdrop-blur-md rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] border border-white/60 mb-12">
<h1 class="text-3xl sm:text-4xl lg:text-6xl xl:text-7xl font-black text-slate-900 mb-6 sm:mb-8">Find <span class="text-gradient">Office Space</span> in Mumbai.</h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Looking for <strong>commercial office space for rent in Mumbai</strong>? Tell us your team size, location preference, and budget.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 relative z-10">
<div class="glass-card p-6 sm:p-8 reveal">
<div class="w-12 h-12 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-6 text-brand-cyan"><i class="fas fa-map-marked-alt text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">We Know What Is Available</h4>
<p class="text-slate-600 leading-relaxed text-sm">We actively track commercial properties across BKC, Lower Parel, Goregaon, Andheri, and Powai.</p>
</div>
<div class="glass-card p-6 sm:p-8 reveal delay-100">
<div class="w-12 h-12 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-6 text-brand-electric"><i class="fas fa-handshake text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">We Handle the Landlord Conversations</h4>
<p class="text-slate-600 leading-relaxed text-sm">Once we identify a space that fits, we approach the landlord and manage the negotiation.</p>
</div>
<div class="glass-card p-6 sm:p-8 reveal delay-200">
<div class="w-12 h-12 bg-brand-violet/10 border border-brand-violet/30 rounded-xl flex items-center justify-center mb-6 text-brand-violet"><i class="fas fa-file-contract text-xl"></i></div>
<h4 class="text-lg sm:text-xl font-bold text-slate-900 mb-3">Clear Terms Before You Commit</h4>
<p class="text-slate-600 leading-relaxed text-sm">Before you agree to anything, we lay out the cost clearly. No surprises after you have signed.</p>
</div>
</div>
</section>
`,
list: `
<section class="py-12 lg:py-24 px-4 sm:px-6 relative">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] lg:w-[800px] lg:h-[800px] bg-brand-gold opacity-10 top-0 right-0 lg:-top-20 lg:-right-20"></div>
<div class="max-w-2xl mx-auto mb-12 relative z-10">
<div class="glass-card p-6 sm:p-8 border-t-4 border-t-brand-gold shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg sm:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-building text-brand-gold"></i> Tell Us About Your Property</h3>
<p class="text-sm text-slate-600 mb-4 sm:mb-6">Share your property details and we will get back to you within 24 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4">
<input type="text" name="full_name" placeholder="Your Name *" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company or Property Owner Name" class="input-premium">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<input type="tel" name="phone" placeholder="Phone Number *" class="input-premium" required>
<input type="email" name="email" placeholder="Email ID *" class="input-premium" required>
</div>
<input type="text" name="property_location" placeholder="Property Address or Area *" class="input-premium" required>
<input type="number" name="property_area" placeholder="Approximate Area (Sq Ft)" class="input-premium">
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-gold text-white py-3 sm:py-4 rounded-xl font-bold uppercase tracking-wider text-xs sm:text-sm hover:scale-[1.02] shadow-[0_0_20px_rgba(251,191,36,0.4)] transition-all">Submit Property Details</button>
</form>
</div>
</div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 p-6 sm:p-10 lg:p-12 bg-white/40 backdrop-blur-md rounded-2xl sm:rounded-[2rem] lg:rounded-[3rem] border border-white/60 mb-12 lg:mb-20">
<h1 class="text-3xl sm:text-4xl lg:text-6xl xl:text-7xl font-black text-slate-900 mb-6 sm:mb-8">List Your <span class="text-gradient-gold">Commercial Property.</span></h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">Have a commercial property in Mumbai that is sitting empty or coming up for lease? We work with property owners to find the right tenants.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center relative z-10">
<div class="reveal">
<h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black mb-6 sm:mb-8 leading-tight lg:leading-none tracking-tight lg:tracking-tighter text-slate-900">The Right Tenant<br><span class="text-gradient-gold">For Your Space.</span></h2>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 mb-4 sm:mb-6 leading-relaxed">We are actively sourcing commercial office spaces across Mumbai for our clients. If you own or manage a commercial property and are looking for a reliable business tenant, we would like to hear from you.</p>
<p class="text-sm sm:text-base lg:text-lg text-slate-600 leading-relaxed">We bring genuine, vetted business tenants to you. This is not a listing portal. We do the matchmaking ourselves.</p>
</div>
<div class="glass-card p-6 sm:p-8 lg:p-10 reveal delay-100 border border-brand-gold/20 shadow-[0_0_40px_rgba(251,191,36,0.1)]">
<h4 class="text-lg sm:text-xl font-black text-slate-900 mb-4 sm:mb-6 flex items-center gap-3"><i class="fas fa-star text-brand-gold"></i> Why List With CorpEasy?</h4>
<div class="space-y-3 sm:space-y-4">
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We bring genuine, pre qualified business tenants to you.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We manage the sourcing, conversations, and lease negotiations.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> We aim to place tenants on fixed, medium term lease agreements.</p>
<p class="flex items-start gap-3 text-slate-700 text-sm sm:text-base"><i class="fas fa-check-circle text-brand-gold mt-1"></i> No spammy broker networks. Just serious businesses.</p>
</div>
</div>
</section>
<section class="py-12 px-4 sm:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[350px] lg:h-[500px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&fit=crop&q=80&w=1920" alt="Premium commercial building for lease in Mumbai" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-l from-brand-gold/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 right-6 lg:bottom-10 lg:right-10 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Premium Property Portfolio</span>
</div>
</div>
</section>
`,
facility: `
<section class="max-w-7xl mx-auto px-4 lg:px-6 py-8 lg:py-16 grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-16 items-start min-h-[calc(100vh-96px)]">
<div class="order-2 lg:order-1 flex flex-col justify-center reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-rose/10 border border-brand-rose/30 rounded-full px-4 py-1.5 backdrop-blur-md w-max">
<span class="w-2 h-2 rounded-full bg-brand-rose animate-pulse"></span>
<span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-rose">Facility Management</span>
</div>
<h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-none">Your Office, <br><span class="text-gradient-vibrant">Perfectly Run.</span></h1>
<p class="text-base lg:text-lg text-slate-600 leading-relaxed mb-8 max-w-lg">Stop letting office management distract your team from real work. CorpEasy takes over the complete day-to-day operations of your existing office — from housekeeping and security to vendor contracts and compliance — so you never have to think about it again.</p>
<div class="space-y-3 mb-8">
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Housekeeping, security & pantry — fully managed</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">AMC contracts & vendor negotiation handled by us</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Fire safety, compliance & statutory requirements covered</p>
</div>
<div class="flex items-center gap-3">
<div class="w-5 h-5 rounded-full bg-brand-rose/10 border border-brand-rose/30 flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-brand-rose text-[9px]"></i></div>
<p class="text-sm font-semibold text-slate-700">Single monthly invoice — no vendor chaos</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 reveal delay-100">
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-rose/10 border border-brand-rose/30 rounded-xl flex items-center justify-center mb-3 text-brand-rose"><i class="fas fa-broom text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Daily Operations</h4>
<p class="text-xs text-slate-500 leading-relaxed">Housekeeping, pantry, and reception management</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-electric/10 border border-brand-electric/30 rounded-xl flex items-center justify-center mb-3 text-brand-electric"><i class="fas fa-file-contract text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Vendor & AMC</h4>
<p class="text-xs text-slate-500 leading-relaxed">AC, electrical, plumbing, and IT vendor contracts</p>
</div>
<div class="glass-card p-5">
<div class="w-10 h-10 bg-brand-cyan/10 border border-brand-cyan/30 rounded-xl flex items-center justify-center mb-3 text-brand-cyan"><i class="fas fa-shield-alt text-sm"></i></div>
<h4 class="text-base font-bold text-slate-900 mb-1">Compliance & Safety</h4>
<p class="text-xs text-slate-500 leading-relaxed">Fire NOC, statutory audits, and security management</p>
</div>
</div>
</div>
<div class="order-1 lg:order-2 lg:sticky lg:top-[120px] self-start">
<div class="glass-card p-6 lg:p-8 border-t-4 border-t-brand-rose shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
<h3 class="text-lg lg:text-xl font-black text-slate-900 mb-2 flex items-center gap-3"><i class="fas fa-tools text-brand-rose"></i> Get a Facility Management Quote</h3>
<p class="text-xs text-slate-500 mb-6 leading-relaxed">Tell us about your office. We will send a detailed proposal within 24 hours.</p>
<form onsubmit="handleLead(event)" class="space-y-4 relative">
<input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
<input type="email" name="email" placeholder="Work Email Address" class="input-premium" required>
<input type="tel" name="phone" placeholder="+91 Phone Number" class="input-premium" required>
<select name="requirement" class="input-premium" required>
<option value="" disabled selected>Office Size</option>
<option>Small Office (Up to 20 seats)</option>
<option>Mid-Size Office (20–100 seats)</option>
<option>Large Office (100–500 seats)</option>
<option>Enterprise Campus (500+ seats)</option>
</select>
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-rose text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_20px_rgba(244,63,94,0.35)] hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(244,63,94,0.5)] transition-all">Request Facility Quote</button>
<p class="text-xs text-slate-400 text-center flex items-center justify-center gap-1.5 mt-2"><i class="fas fa-lock text-brand-rose text-[10px]"></i> No spam. Response within 24 hours.</p>
</form>
</div>
</div>
</section>
<section class="py-20 relative bg-white/40">
<div class="max-w-7xl mx-auto px-4 lg:px-6">
<div class="text-center mb-14 reveal">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-rose/10 border border-brand-rose/30 rounded-full px-4 py-1.5"><span class="text-[9px] font-black uppercase tracking-[0.4em] text-brand-rose">What We Handle</span></div>
<h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-4">Everything Your Office Needs.</h2>
<p class="text-lg text-slate-500 max-w-2xl mx-auto">One team. One invoice. Zero headaches.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
<div class="glass-card p-7"><i class="fas fa-broom text-brand-rose text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Housekeeping</h4><p class="text-sm text-slate-500 leading-relaxed">Daily cleaning, washroom upkeep, deep cleaning, and waste management</p></div>
<div class="glass-card p-7"><i class="fas fa-shield-alt text-brand-electric text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Security</h4><p class="text-sm text-slate-500 leading-relaxed">Trained security personnel, CCTV monitoring, access control management</p></div>
<div class="glass-card p-7"><i class="fas fa-coffee text-brand-cyan text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Pantry & Cafe</h4><p class="text-sm text-slate-500 leading-relaxed">Tea, coffee, snack stations, catering coordination and vendor tie-ups</p></div>
<div class="glass-card p-7"><i class="fas fa-tools text-brand-violet text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Maintenance</h4><p class="text-sm text-slate-500 leading-relaxed">Electrical, plumbing, AC servicing, and preventive maintenance schedules</p></div>
<div class="glass-card p-7"><i class="fas fa-file-contract text-brand-gold text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">AMC Contracts</h4><p class="text-sm text-slate-500 leading-relaxed">Annual maintenance contracts negotiated, managed, and tracked on your behalf</p></div>
<div class="glass-card p-7"><i class="fas fa-fire-extinguisher text-brand-rose text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Fire & Safety</h4><p class="text-sm text-slate-500 leading-relaxed">Fire NOC renewals, safety drills, first aid kits, and compliance audits</p></div>
<div class="glass-card p-7"><i class="fas fa-users text-brand-electric text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Reception & Admin</h4><p class="text-sm text-slate-500 leading-relaxed">Front desk management, visitor handling, couriers, and office supplies</p></div>
<div class="glass-card p-7"><i class="fas fa-chart-bar text-brand-cyan text-2xl mb-4"></i><h4 class="text-lg font-bold text-slate-900 mb-2">Monthly Reports</h4><p class="text-sm text-slate-500 leading-relaxed">Detailed monthly MIS reports on costs, vendor performance, and incidents</p></div>
</div>
</div>
</section>
<section class="py-20 relative">
<div class="max-w-5xl mx-auto px-4 lg:px-6 text-center reveal">
<h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-6">Built for Companies That Are Done<br><span class="text-gradient-vibrant">Thinking About Their Office.</span></h2>
<p class="text-lg text-slate-500 mb-12 max-w-2xl mx-auto">If your HR team is handling AMC complaints, your finance team is chasing vendor invoices, or your ops head is managing housekeeping — you need CorpEasy Facility Management.</p>
<button onclick="navigateTo('contact')" class="inline-flex items-center gap-3 bg-brand-rose text-white px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-[0_0_25px_rgba(244,63,94,0.35)] hover:scale-105 transition-all">Talk to Our Team <i class="fas fa-arrow-right"></i></button>
</div>
</section>
<section class="py-16 px-4 lg:px-6">
<div class="max-w-7xl mx-auto rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] lg:h-[450px] reveal group border border-white/60">
<img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=1920" alt="Professional facility management team in action" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1920" height="1080">
<div class="absolute inset-0 bg-gradient-to-r from-brand-rose/30 via-transparent to-transparent"></div>
<div class="absolute bottom-6 left-6 lg:bottom-10 lg:left-10 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
<span class="w-2 h-2 rounded-full bg-brand-rose animate-pulse"></span>
<span class="text-sm font-medium text-slate-900">Professional Operations Team</span>
</div>
</div>
</section>
`,
about: `
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24 lg:py-32 text-center reveal relative">
<div class="glow-blob w-[400px] h-[400px] sm:w-[600px] sm:h-[600px] bg-brand-blue opacity-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
<div class="relative z-10">
<span class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.3em] sm:tracking-[0.4em] text-brand-electric mb-4 sm:mb-6 block text-center">Our Story</span>
<h1 class="text-4xl sm:text-5xl lg:text-7xl xl:text-8xl text-slate-900 font-black mb-8 sm:mb-12 text-center leading-[0.95]">Making <span class="text-gradient-vibrant">Office Space</span> Simple.</h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 text-center max-w-3xl mx-auto leading-relaxed mb-4 sm:mb-6 font-medium">CorpEasy is a Mumbai based workspace solutions company, founded in October 2025. We are a young, asset-light startup with a straightforward mission: to make the process of finding, setting up, and occupying commercial office space in Mumbai genuinely easier for businesses of all sizes.</p>
<p class="text-sm sm:text-base lg:text-lg text-slate-500 text-center max-w-2xl mx-auto leading-relaxed mb-12 sm:mb-20">We are building something better, one client at a time.</p>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-12 text-center">
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-electric/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-electric transition-colors">Mumbai</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Focus Market</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-cyan/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-cyan transition-colors">3</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Services</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-violet/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-violet transition-colors">24 Hr</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Response</p></div>
<div class="glass-card p-4 sm:p-6 lg:p-10 group hover:border-brand-rose/50"><p class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 sm:mb-4 lg:mb-6 tracking-tighter group-hover:text-brand-rose transition-colors">2025</p><p class="text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-slate-600 uppercase tracking-wider lg:tracking-widest">Founded</p></div>
</div>
<div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl relative h-[300px] lg:h-[500px] mt-24 reveal group">
<img src="professional_team.png" alt="Dev Doshi, founder of CorpEasy, in a modern Mumbai office" class="absolute inset-0 w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-[2s]" loading="lazy" width="1200" height="500">
<div class="absolute inset-0 bg-brand-electric/10 mix-blend-multiply"></div>
</div>
<div class="mt-32 text-center">
<h3 class="text-4xl font-black text-slate-900 mb-4">Our Founder</h3>
<p class="text-slate-500 max-w-2xl mx-auto mb-16 uppercase tracking-[0.2em] font-bold text-xs">Direct accountability. No layers. No friction.</p>
<div class="max-w-xl mx-auto">
<div class="glass-card p-10 group bg-white/50 border border-white/60">
<div class="w-32 h-32 mx-auto mb-8 rounded-full overflow-hidden border-4 border-white shadow-2xl transition-transform duration-500 group-hover:scale-110 grayscale-[50%] group-hover:grayscale-0">
<img src="https://ui-avatars.com/api/?name=Dev+Doshi&background=0D9488&color=fff&size=256" alt="Dev Doshi Founder CorpEasy" class="w-full h-full object-cover" loading="lazy" width="128" height="128">
</div>
<h4 class="text-2xl font-black text-slate-900 mb-2">Dev Doshi</h4>
<p class="text-brand-electric text-xs font-semibold uppercase mb-4">Founder: Business Development & Strategy</p>
<p class="text-sm text-slate-600 leading-relaxed border-t border-white/40 pt-6">Dev brings experience in partnerships, business development, and building relationships across sectors. He leads CorpEasy's client facing work and strategic direction.</p>
</div>
</div>
</div>
<div class="mt-32 max-w-4xl mx-auto text-left">
<h3 class="text-4xl lg:text-5xl font-black text-slate-900 mb-16">Our Journey.</h3>
<div class="relative">
<div class="relative pl-16 mb-8">
<div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
<div class="absolute left-[7px] top-4 w-0.5 bg-gradient-to-b from-brand-electric to-brand-cyan h-full z-0"></div>
<h4 class="text-gradient-vibrant text-2xl font-black mb-2">October 2025</h4>
<div class="glass-card p-6 reveal">CorpEasy founded in Mumbai. We started with a simple belief: finding and setting up office space in this city should not be this complicated. That belief has not changed.</div>
</div>
<div class="relative pl-16">
<div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-brand-electric z-10"></div>
<h4 class="text-gradient-vibrant text-2xl font-black mb-2">2026 and Beyond</h4>
<div class="glass-card p-6 reveal delay-300">Building our client base across Mumbai. Helping startups, growing teams, and property owners navigate the city's commercial office market. We are early, and we are focused.</div>
</div>
</div>
</div>
</div>
</section>
`,
faq: `
<section class="max-w-7xl mx-auto px-6 pt-24 pb-16 reveal relative">
<div class="text-center mb-16">
<div class="inline-flex items-center space-x-2 mb-6 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-4 py-1.5 backdrop-blur-md">
<span class="text-xs font-semibold uppercase tracking-wide text-brand-electric">Common Questions</span>
</div>
<h1 class="text-5xl font-black text-slate-900 mb-4">Questions People Ask Us.</h1>
<p class="text-xl text-slate-500">Straight answers about how CorpEasy works and what we actually do.</p>
</div>
<div class="max-w-3xl mx-auto">
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">Do you have ready offices available right now?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">No, and that is intentional. We work on a requirement first basis. When you tell us what you need, we go and find the right commercial space for you in Mumbai. This means the office is sourced and set up specifically for your team, rather than you inheriting something generic that does not quite fit.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">What does "managed office" mean at CorpEasy?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">It means we handle the end to end process of getting you into a working office space. We identify a suitable commercial property in Mumbai, negotiate the lease with the landlord, arrange the basic workspace setup. Furniture, internet, the essentials, and give you a clear per seat monthly cost on a fixed lease. You deal with us, not with landlords, brokers, or contractors.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">How is the per seat cost calculated?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">We calculate your per seat monthly cost based on the actual commercial property we identify for you. The rent, the basic setup costs, and our service fee, divided across your team size. We share this breakdown clearly before you commit to anything. There are no hidden charges.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">How much does managed office space in Mumbai cost?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">It depends on location, team size, and the specific property. As a general guide: BKC ranges from approximately ₹450 to ₹750 per sq ft (avg ₹542); Worli and Lower Parel ₹250 to ₹450 (avg ₹320); Goregaon ₹150 to ₹300 (avg ₹228); Andheri East ₹150 to ₹400 (avg ₹253); Powai ₹115 to ₹310 (avg ₹179); and Navi Mumbai ₹100 to ₹160 (avg ₹110). CorpEasy shares your exact cost based on the actual property, before you commit to anything. See our pricing table on the home page for full breakdown.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">How long does the whole process take?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">It depends on property availability and your specific requirement. Typically a few weeks from when we identify a suitable space to the day your team can move in. This is significantly faster than finding, negotiating, and setting up a space entirely on your own, which usually takes several months.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">Which areas in Mumbai do you cover?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">We actively source <strong>commercial office space</strong> across BKC, Lower Parel, Worli, Goregaon East, Andheri East, and Powai. If you have a different location in mind within Mumbai, tell us, we will do our best to find something suitable.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">What is the minimum team size you work with?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">There is no strict minimum. The managed office model tends to make the most practical sense for teams of around ten or more. For very small teams, we will be honest with you about whether this is the right fit or whether a different arrangement would serve you better.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">What does the workspace setup include?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">We handle the basics. Functional furniture, internet connectivity, and a clean professional working environment. The exact scope depends on the property and your requirement. We are transparent about what is and is not included in your per-seat cost before you agree to anything.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">I own a commercial property. Can CorpEasy find me a tenant?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">Yes. We work with property owners across Mumbai who are looking for reliable business tenants. If you have a commercial space available, get in touch with us. We will review whether it fits our active client requirements and discuss next steps.</p></div></div>
<div><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">Are you a broker, a portal, or something else?</span><i class="fas fa-plus text-brand-electric transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">Neither, strictly speaking. We are a workspace solutions company. We find the right commercial property, take the lease, handle the setup, and offer the space to you on a managed basis. We are not a listing portal and we are not a traditional broker. We stay involved through the entire process. From the first conversation to the day you move in.</p></div></div>
<div class="border-b border-white/60"><div class="flex items-center justify-between py-6 cursor-pointer" onclick="toggleFAQ(this)"><span class="text-lg font-bold text-slate-900 pr-8">Do you offer facility management for existing offices?</span><i class="fas fa-plus text-brand-rose transition-transform duration-300 flex-shrink-0"></i></div><div class="faq-answer overflow-hidden transition-all duration-500" style="max-height:0px"><p class="text-slate-600 pb-6 leading-relaxed">Yes. CorpEasy Facility Management is designed for companies that already have their own office space but want to outsource day-to-day operations — including housekeeping, security, vendor management, AMC contracts, and compliance. We handle everything under one monthly invoice so your team can focus entirely on your business.</p></div></div>
</div>
<div class="text-center mt-16">
<p class="text-slate-600 mb-6">Have a question that is not answered here?</p>
<button onclick="navigateTo('contact')" class="bg-brand-electric text-white px-10 py-5 rounded-lg font-medium text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:scale-105 transition-all">Ask Us Directly →</button>
</div>
</section>
`,
contact: `
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 xl:gap-20 items-start reveal relative">
<div class="lg:col-span-5 relative z-10">
<div class="inline-flex items-center space-x-2 mb-6 sm:mb-10 bg-brand-electric/10 border border-brand-electric/30 rounded-full px-3 sm:px-4 py-1.5 backdrop-blur-md">
<span class="w-2 h-2 rounded-full bg-brand-electric animate-pulse"></span>
<span class="text-[10px] sm:text-xs font-semibold text-brand-electric uppercase tracking-[0.2em] sm:tracking-[0.4em]">Get in Touch</span>
</div>
<h1 class="text-4xl sm:text-5xl lg:text-6xl text-slate-900 font-black mb-6 sm:mb-10 leading-tight">Let's<br><span class="text-gradient-vibrant">Talk.</span></h1>
<p class="text-base sm:text-lg lg:text-xl text-slate-600 leading-relaxed mb-8 sm:mb-16 max-w-sm">Whether you are looking for office space in Mumbai, want help finding a tenant for your property, or just have a question, fill in the form and we will be back in touch within 24 hours.</p>
<div class="space-y-4 sm:space-y-6 lg:space-y-10">
<div class="flex items-center gap-4 sm:gap-6 lg:gap-8 group glass-card p-4 sm:p-6 border border-white/60">
<div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-white/70 border border-white/80 rounded-xl sm:rounded-2xl flex items-center justify-center text-brand-electric shadow-[0_0_15px_rgba(0,240,255,0.1)] group-hover:bg-brand-electric group-hover:text-white transition-all duration-500"><i class="fas fa-envelope text-lg sm:text-xl"></i></div>
<div><p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-1">Email Our Team</p><a href="mailto:devdoshi@corpeasy.in" class="text-base sm:text-lg lg:text-xl font-bold text-slate-900 hover:text-brand-electric transition-colors">devdoshi@corpeasy.in</a></div>
</div>
<div class="flex items-center gap-4 sm:gap-6 lg:gap-8 group glass-card p-4 sm:p-6 border border-white/60">
<div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-green-500/10 border border-green-500/30 rounded-xl sm:rounded-2xl flex items-center justify-center text-green-500 shadow-[0_0_15px_rgba(34,197,94,0.1)] group-hover:bg-green-500 group-hover:text-white transition-all duration-500"><i class="fab fa-whatsapp text-xl sm:text-2xl"></i></div>
<div><p class="text-[10px] sm:text-xs text-slate-500 font-medium mb-1">WhatsApp</p><a href="https://wa.me/919833089993?text=Hi%20CorpEasy%2C%20I%20would%20like%20to%20discuss%20an%20office%20requirement." target="_blank" class="text-base sm:text-lg lg:text-xl font-bold text-slate-900 hover:text-green-500 transition-colors">Chat With Us</a></div>
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
<input type="text" name="full_name" placeholder="Your Full Name" class="input-premium" required>
<input type="text" name="company_name" placeholder="Company Name" class="input-premium" required>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
<input type="email" name="email" placeholder="Email Address" class="input-premium" required>
<input type="tel" name="phone" placeholder="Phone Number" class="input-premium" required>
</div>
<select name="requirement" class="input-premium" required>
<option value="">What can we help you with?</option>
<option>I need a managed office space in Mumbai</option>
<option>I need help finding a commercial office for rent</option>
<option>I want to list my commercial property</option>
<option>I need facility management for my office</option>
<option>General enquiry</option>
</select>
<input type="text" name="website" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
<button type="submit" class="w-full bg-brand-electric text-white py-4 sm:py-6 rounded-lg font-bold sm:font-medium text-sm sm:text-xs shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all hover:scale-[1.02] mt-4 sm:mt-6">Send My Enquiry</button>
<p class="text-[10px] sm:text-xs text-slate-500 text-center">We respond to every enquiry within 24 hours (Mon to Sat, 9 AM to 7 PM IST).</p>
</form>
</div>
</section>
`
};

/* ===== EVENT HANDLERS ===== */
document.getElementById('mobile-trigger').onclick = () => {
const menu = document.getElementById('mobile-menu');
menu.classList.toggle('hidden');
if(!menu.classList.contains('hidden')) { menu.classList.add('flex'); }
};
document.addEventListener('click', (e) => {
const menu = document.getElementById('mobile-menu'); const trigger = document.getElementById('mobile-trigger');
if (menu && !menu.classList.contains('hidden')) {
if (!menu.contains(e.target) && !trigger.contains(e.target)) { menu.classList.add('hidden'); menu.classList.remove('flex'); }
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
const depths = [25, 50, 75, 90];
depths.forEach(depth => {
if (scrolled >= depth && !reportedDepths.has(depth)) {
reportedDepths.add(depth); window.dataLayer = window.dataLayer || [];
window.dataLayer.push({ event: 'scroll_depth', depth_threshold: depth });
}
});
const nav = document.getElementById('navbar');
if(nav) { if(winScroll > 60) { nav.classList.add('shadow-[0_10px_30px_rgba(0,0,0,0.06)]'); } else { nav.classList.remove('shadow-[0_10px_30px_rgba(0,0,0,0.06)]'); } }
const heroImg = document.querySelector('.hero-parallax-img');
if (heroImg && window.innerWidth >= 1024) { heroImg.style.transform = `translateY(${winScroll * 0.12}px)`; }
};
let fabOpen = false;
const fabContainer = document.getElementById('fab-container');
const fabMain = document.getElementById('fab-main');
const fabIcon = document.getElementById('fab-icon');
const fabMinis = document.querySelectorAll('.fab-mini');
window.addEventListener('scroll', () => {
if (window.scrollY > 300) { fabContainer.style.opacity = '1'; fabContainer.style.pointerEvents = 'all'; fabContainer.style.transform = 'translateY(0)'; }
else { fabContainer.style.opacity = '0'; fabContainer.style.pointerEvents = 'none'; fabContainer.style.transform = 'translateY(20px)'; }
}, { passive: true });
fabMain.addEventListener('click', () => {
fabOpen = !fabOpen;
fabMinis.forEach((mini, i) => { setTimeout(() => { mini.style.opacity = fabOpen ? '1' : '0'; mini.style.transform = fabOpen ? 'translateY(0)' : 'translateY(16px)'; }, i * 60); });
fabIcon.style.transform = fabOpen ? 'rotate(45deg)' : 'rotate(0deg)';
fabIcon.className = fabOpen ? 'fas fa-times text-2xl transition-transform duration-300' : 'fas fa-comments text-2xl transition-transform duration-300';
});
window.addEventListener('hashchange', () => {
const hash = window.location.hash.substring(1) || 'home';
if (pages[hash] || hash === 'post-detail') navigateTo(hash, true);
});
document.addEventListener('DOMContentLoaded', async () => {
const hash = window.location.hash.substring(1) || 'home';
await loadPosts();
navigateTo(hash);
const cookieBanner = document.getElementById('cookie-banner');
if (cookieBanner) {
const consent = localStorage.getItem('ce_cookie_consent');
if (!consent) { setTimeout(() => { cookieBanner.style.transform = 'translateY(0)'; }, 2000); }
document.getElementById('cookie-accept')?.addEventListener('click', () => { localStorage.setItem('ce_cookie_consent', 'accepted'); cookieBanner.style.transform = 'translateY(100%)'; window.dataLayer = window.dataLayer || []; window.dataLayer.push({event: 'cookie_consent', choice: 'accepted'}); });
document.getElementById('cookie-decline')?.addEventListener('click', () => { localStorage.setItem('ce_cookie_consent', 'declined'); cookieBanner.style.transform = 'translateY(100%)'; });
}
});
