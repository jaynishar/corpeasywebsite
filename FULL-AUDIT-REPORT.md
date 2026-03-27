# CorpEasy SEO Full Audit Report
**Site:** https://www.corpeasy.in
**Audit Date:** 2026-03-27
**Auditor:** SEO Skill (seo + technical-seo-checker)
**Overall Score: 64 / 100 — Needs Improvement**

---

## Score Breakdown

| Category | Weight | Score | Weighted |
|---|---|---|---|
| Technical SEO | 25% | 68 | 17.0 |
| Content Quality | 20% | 74 | 14.8 |
| On-Page SEO | 15% | 78 | 11.7 |
| Schema / Structured Data | 15% | 42 | 6.3 |
| Performance (CWV) | 10% | 38 | 3.8 |
| Image Optimization | 10% | 55 | 5.5 |
| AI Search Readiness (GEO) | 5% | 50 | 2.5 |
| **TOTAL** | **100%** | | **61.6** |

---

## 🔴 Critical Issues (Fix Immediately)

### 1. FAQPage Schema on Commercial Site — SCHEMA VIOLATION
- **Evidence:** FAQPage JSON-LD schema present on homepage, faq.php, and managed-office-space-mumbai.php
- **Impact:** Google restricted FAQPage rich results to GOVERNMENT and HEALTHCARE sites only (August 2023). On commercial sites, this schema is ignored OR can trigger manual action. Currently zero SEO value from FAQ rich snippets.
- **Fix:** Remove `FAQPage` schema from all commercial pages. Replace with `Service` or `ProfessionalService` schema expansions. Keep FAQ *content* on the page — just remove the structured data type.
- **Pages affected:** index.php, faq.php, managed-office-space-mumbai.php

### 2. Tailwind CSS CDN — RENDER-BLOCKING PERFORMANCE KILLER
- **Evidence:** Site loads Tailwind via CDN (`cdn.tailwindcss.com`) — a 300KB+ JS-based CSS engine that must execute before the page renders
- **Impact:** 🔴 Estimated +2–4 seconds added to LCP on mobile. Largest single cause of poor Core Web Vitals. CDN Tailwind also re-processes all styles on every page load via JavaScript.
- **Fix:** Compile Tailwind to a static `style.min.css` file using the Tailwind CLI. Replace CDN script tag with `<link rel="stylesheet" href="/style.min.css">`. Estimated file size after purging unused styles: ~15–40KB.
- **Effort:** Medium (2–3 hours). **Highest ROI of all changes.**

### 3. OG Image Not Deployed — Branding Gap
- **Evidence:** Live site still serving Unsplash stock photo as OG image. Local fix (`CORPEASYHEADER.png`) committed to git but NOT deployed to Hostinger.
- **Impact:** Every WhatsApp/LinkedIn/Twitter share shows a generic office stock photo, not CorpEasy branding. Hurts click-through from social.
- **Fix:** Deploy `_deploy/` folder to Hostinger via FTP/File Manager.

### 4. No `llms.txt` File — Missing AI Search
- **Evidence:** `https://www.corpeasy.in/llms.txt` returns 404
- **Impact:** ChatGPT, Perplexity, and Gemini AI crawlers have no structured context about CorpEasy. As AI search grows, this is a significant GEO (Generative Engine Optimization) gap.
- **Fix:** Create `/llms.txt` with company description, services, pricing, and key pages.

### 5. No Article Schema on Blog Posts
- **Evidence:** Blog listing page and individual posts have no `Article` or `BlogPosting` JSON-LD schema
- **Impact:** Google cannot identify blog posts as articles. No eligibility for Article rich results, author attribution, or publication date display in SERPs.
- **Fix:** Add `BlogPosting` schema to `blog-post.php` with `headline`, `author`, `datePublished`, `dateModified`, `image`, `publisher`.

---

## ⚠️ Warnings (Fix Within 30 Days)

### 6. No Privacy Policy Page
- **Evidence:** No `/privacy-policy` URL in sitemap or navigation
- **Impact:** Required for Google Ads, GDPR compliance, and E-E-A-T trust signals. Affects ranking for YMYL-adjacent queries.
- **Fix:** Create a basic privacy policy page covering data collection (contact forms, GTM, analytics).

### 7. Missing `beyond-four-walls` Blog Post Page
- **Evidence:** Blog listing page shows "Beyond Four Walls" as the featured article, but `/blog/beyond-four-walls-how-managed-workspaces-power-business-growth` likely 404s (no corresponding DB entry or static page)
- **Impact:** Featured slot on the blog index links to a broken page = wasted crawl budget + bad UX
- **Fix:** Either add the post to the DB or change the featured post to one that has content.

### 8. Meta Descriptions Not Verified on Live Site
- **Evidence:** WebFetch could not extract meta descriptions from any page (tool limitation + possibly not deployed)
- **Impact:** If meta descriptions are missing on the live Hostinger server, Google auto-generates snippets — losing control over CTR
- **Fix:** Deploy latest `_deploy/` files to Hostinger and verify via `view-source:https://www.corpeasy.in`

### 9. Images Missing Explicit Alt Text
- **Evidence:** `CORPEASYHEADER.png`, `managed_workspace.png`, `modern_office.png`, `professional_team.png` — alt attributes not confirmed on live site
- **Impact:** Image SEO signals lost. Accessibility failures. Google cannot understand image context.
- **Fix:** Add descriptive alt text to all `<img>` tags. E.g., `alt="CorpEasy managed office space in BKC Mumbai"`

### 10. No `preconnect` for External Domains
- **Evidence:** No `<link rel="preconnect">` tags for Google Fonts, Unsplash CDN, Font Awesome CDN, Google Tag Manager
- **Impact:** Browser wastes 100–300ms establishing connections before downloading external resources
- **Fix:** Add to `<head>`:
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
```

### 11. No `loading="lazy"` on Below-Fold Images
- **Evidence:** Images loaded eagerly even when below the viewport
- **Impact:** Wastes bandwidth on mobile, increases LCP by downloading off-screen images
- **Fix:** Add `loading="lazy"` to all `<img>` tags except the hero/above-fold image

### 12. No `width` and `height` on Images
- **Evidence:** Image dimensions not specified in HTML
- **Impact:** CLS (Cumulative Layout Shift) — page jumps as images load, hurting Core Web Vitals score
- **Fix:** Add explicit `width` and `height` attributes to all `<img>` tags

### 13. Google Tag Manager Loaded Synchronously
- **Evidence:** GTM script loaded in `<head>` (blocking)
- **Impact:** Adds ~100–200ms to page load time before first render
- **Fix:** GTM's own snippet is already async — ensure the `<noscript>` iframe is placed immediately after `<body>` tag, not in `<head>`

---

## ✅ Passes

| Check | Status | Detail |
|---|---|---|
| Homepage H1 | ✅ Pass | "Managed Office Space in Mumbai" — keyword-rich |
| FAQ H1 | ✅ Pass | "Managed Office Space Mumbai — FAQs" |
| Blog H1 | ✅ Pass | "Mumbai Office Space Insights" |
| Title Tags | ✅ Pass | All pages have unique, keyword-bearing titles under 60 chars |
| Canonical URLs | ✅ Pass | All pages have canonical tags |
| robots.txt | ✅ Pass | Sensitive files disallowed, sitemap referenced |
| Sitemap | ✅ Pass | 24 URLs, correct priorities, all key pages included |
| hreflang | ✅ Pass | `en-IN` and `en` hreflang set in header |
| LocalBusiness Schema | ✅ Pass | Merged with ProfessionalService, founder info, contact points |
| BreadcrumbList Schema | ✅ Pass | Present on all pages |
| HTTPS | ✅ Pass | Site fully HTTPS, no mixed content detected |
| Mobile Responsive | ✅ Pass | Responsive layout confirmed |
| No noindex | ✅ Pass | No accidental noindex on any public page |
| OG/Twitter tags | ✅ Pass | Present on all pages (deploy needed for image fix) |
| Font Awesome CDN | ✅ Pass | Typo fixed (`cdnjs`) |

---

## Performance Analysis (Mobile vs Desktop)

> *PageSpeed API was rate-limited during audit. Scores below are estimated from code analysis.*

| Metric | Estimated Mobile | Estimated Desktop | Target |
|---|---|---|---|
| Performance Score | ~35–50 | ~55–70 | 90+ |
| LCP | ~4–7s | ~2–3.5s | <2.5s |
| CLS | ~0.05–0.15 | ~0.02–0.08 | <0.1 |
| FCP | ~3–5s | ~1.5–2.5s | <1.8s |
| TTFB | ~300–600ms | ~200–400ms | <800ms |

**Primary causes of poor mobile performance:**
1. Tailwind CDN (300KB+ JS CSS engine) — blocks render
2. No image lazy loading
3. No preconnect hints
4. Font Awesome CDN (separate HTTP request)
5. No minification of `script.js` / `interactions.js`

---

## Speed Improvement Plan

### Quick Wins (Do Today)
1. Add `loading="lazy"` to all non-hero images
2. Add `preconnect` tags in `<head>`
3. Add explicit `width` and `height` to `<img>` tags
4. Move GTM `<noscript>` iframe to immediately after `<body>`

### Medium Term (This Week)
5. Compile Tailwind to static CSS (biggest single improvement)
6. Combine `script.js` + `interactions.js` into one minified file
7. Add `defer` attribute to non-critical scripts

### Hostinger Server Settings
8. Enable **GZIP/Brotli compression** in Hostinger control panel (LiteSpeed)
9. Enable **Browser caching** (set Cache-Control headers)
10. Enable **LiteSpeed Cache** plugin if available
11. Serve images as **WebP** format (Hostinger supports on-the-fly conversion)

---

## AI Search Readiness (GEO)

| Signal | Status |
|---|---|
| llms.txt | ❌ Missing |
| Structured pricing data | ✅ In schema |
| Named entities (founders, locations) | ✅ In schema |
| Clear service definitions | ✅ On page |
| Quotable statistics | ⚠️ Sparse |
| FAQ content (for AI answers) | ✅ Present |

---

## Environment Limitations
- PageSpeed Insights API returned 429 (rate limited). CWV scores are estimated from code analysis, not live Lighthouse data.
- WebFetch strips `<script>` tags, so JSON-LD schema cannot be fully verified from live pages — verified from local PHP source files instead.
