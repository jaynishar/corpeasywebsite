# CorpEasy SEO Action Plan
Date: 2026-04-14
Priority-ordered remaining issues that require server access, third-party tools, or ongoing content work.

---

## P0 — Critical (Do This Week)

### 1. Run Google Rich Results Test
**URL:** https://search.google.com/test/rich-results
**What:** Validate that Article schema (with newly added `image`) is now eligible for rich results. Test these URLs:
- https://www.corpeasy.in/insights/mumbai-workspace-guide
- https://www.corpeasy.in/insights/bkc-vs-goregaon
- https://www.corpeasy.in/what-is-a-managed-office
**Expected:** Green checkmarks for Article rich results now that `image` is present.

### 2. Submit Updated Sitemap to Google Search Console
**Action:** Go to GSC → Sitemaps → Submit `https://www.corpeasy.in/sitemap.xml`
**Why:** All lastmod dates updated; Google needs to be notified to re-crawl.

### 3. Verify AggregateRating Accuracy
**Issue:** `header.php` LocalBusiness schema shows `ratingCount: 12` and `ratingValue: 5.0`. This must match real verified reviews.
**Action:** Update to reflect actual Google Business Profile review count. Inaccurate ratings risk a manual penalty.

### 4. Add Server-Level Security Headers
**What to add in `.htaccess` or nginx config:**
```
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), microphone=(), camera=()
```
**Why:** Security headers are a minor ranking signal and protect against clickjacking.

---

## P1 — High Priority (Do This Month)

### 5. Implement HSTS (HTTP Strict Transport Security)
**What:** Add `Strict-Transport-Security: max-age=31536000; includeSubDomains; preload` header server-side.
**Why:** Required for HSTS preload list; improves site trust signals.

### 6. Set Up Google Business Profile
**Action:**
- Register at https://business.google.com
- Category: "Office Space Rental Agency" or "Business Park"
- Add photos, hours (Mon-Sat 9AM-7PM), description
- Get 10+ genuine reviews from clients
**Why:** GBP is the #1 local SEO signal. CorpEasy currently has no verified GBP listing.

### 7. Add Named Author to Blog Posts
**Issue:** All blog articles use "CorpEasy Team" as author (organisation-level). Google's E-E-A-T guidelines favour named, verifiable authors.
**Fix:** Update blog posts to use a named person (e.g., "Dev Doshi" or "Jay Nishar") as the author in both the visible byline and the Article schema `author` field.
**Files to update:** `mumbai-workspace-guide.php`, `bkc-vs-goregaon.php`, `managed-office-explainer.php`, `gst-office-rental.php`, `what-is-a-managed-office.php`, `managed-office-vs-coworking.php`, `office-space-cost-mumbai-2026.php`

### 8. Shorten Titles Over 60 Characters
**Issue:** Several titles are 64-70 chars and will be truncated in SERPs. While they contain valuable keyword+price combos, shorter versions preserve the full message.
**Titles to review:**
- `facility-management-mumbai.php` (64 chars) — consider "Facility Management Mumbai | ₹800/Seat | CorpEasy"
- `list-commercial-property-mumbai.php` (67 chars) — consider "List Office Space Mumbai | Find Tenants | CorpEasy"
- `managed-office-lower-parel.php` (67 chars) — consider "Managed Office Lower Parel | ₹14,000/Seat | CorpEasy"
- `managed-office-bkc.php` (66 chars) — consider "Managed Office BKC Mumbai | ₹18,000/Seat | CorpEasy"

### 9. Compress/Locally Host Critical Images
**Issue:** All content images use Unsplash external URLs. External CDN dependency creates a potential single point of failure for image loading.
**Action:** Download the Unsplash hero images used on each page, convert to WebP, optimise to <80KB, and host locally at `/images/`.

### 10. Add `width`/`height` Attributes to All Unsplash `<img>` Tags
**Issue:** Unsplash `<img>` tags in location pages and blog posts are missing explicit `width` and `height` attributes, causing CLS (Cumulative Layout Shift).
**Action:** Add `width="1200" height="550"` (or appropriate dimensions) to all hero `<img>` elements in these files:
- All `managed-office-*.php` location pages
- All blog post files
- `office-space-cost-mumbai-2026.php`, `managed-office-vs-coworking.php`, etc.

---

## P2 — Medium Priority (Next 2-3 Months)

### 11. Build 60+ Referring Domains
**Target sources:**
- Submit to IndiaMART, Justdial, Sulekha, Sulekha Business, TradeIndia as "service provider" (not property listing)
- Create profiles on: Clutch.co, UrbanPro, Bark.com
- LinkedIn company page articles (2-3 per month)
- Medium articles syndicated from blog content
- Quora answers on "office space Mumbai" questions (link back to relevant pages)
- SlideShare: Upload "Office Space Cost Mumbai 2026" as a presentation
- PRLog/OpenPR: Press release for company launch

### 12. Core Web Vitals Optimisation
**Run PageSpeed Insights on:** https://pagespeed.web.dev/
**Expected pain points based on code review:**
- LCP: Ensure hero images have `fetchpriority="high"` — already done for pages with `$page_lcp_image`
- INP: Review `interactions.min.js` for long tasks. Run Chrome DevTools > Performance tab
- CLS: Fix missing `width`/`height` on Unsplash images (see item 10)

### 13. Add Keyword-Rich Internal Linking to Blog Posts
**Issue:** Blog posts link back to `/blog` and include 1-2 CTAs but may not consistently link to 3 related articles.
**Action:** Audit each blog post for internal link count. Each post should have:
- 2-3 links to related blog articles
- 1 link to the primary service page (`/managed-office-space-mumbai`)
- 1 link to the relevant location page
- 1 link to `/contact`

### 14. Create Location-Specific OG Images
**Issue:** All location pages share the same generic Unsplash office image as their OG image. Social shares will look identical.
**Action:** Create unique 1200x630px OG images for each location (BKC, Goregaon, Lower Parel, Andheri) showing the area's skyline or key landmarks.

### 15. Add Content to `office-space-for-rent-mumbai.php`
**Issue:** This file appears to have minimal content (the `$page_schema` is set but the page body after `include 'templates/header.php'` appears empty).
**Action:** Add hero section, service description, location cards, and contact form matching the pattern of other service pages.

### 16. Request Indexing for New/Updated Pages in GSC
**After deploying changes, request indexing for:**
- All pages whose schemas were updated (8 blog/pillar pages)
- faq.php (schema replaced)
- All location pages (title updates)

---

## P3 — Ongoing (3+ Months)

### 17. Content Calendar — 2 Blog Posts Per Month
**Target topics based on keyword gap:**
- "Coworking space vs private office Mumbai" (comparison intent)
- "Office space near Mumbai airport" (location intent)
- "How to register a company address in Mumbai" (intent gap)
- "Lease agreement checklist India" (legal/compliance intent)
- "Fit-out costs for office space Mumbai 2026"

### 18. Pitch Founder Story to YourStory
**What:** Submit CorpEasy startup story at https://yourstory.com/submit
**Why:** High-DA backlink + brand awareness in startup ecosystem

### 19. LinkedIn Articles
**Publish on:** Dev Doshi's and Jay Nishar's LinkedIn profiles
**Topics:** Office space cost data, managed office explainers, Mumbai commercial real estate trends
**Why:** Personal LinkedIn articles with company links build E-E-A-T

### 20. Monitor Search Console for Structured Data Errors
**Action:** Check GSC → Enhancements monthly for:
- Article rich result errors
- LocalBusiness errors
- AggregateRating warnings
- Any manual actions

---

## Summary by Owner

| Action | Owner | Timeline |
|---|---|---|
| Rich Results Test | Jay/Dev | This week |
| Submit sitemap to GSC | Jay | This week |
| Verify AggregateRating count | Dev/Jay | This week |
| Add security headers | Hosting/Dev | This week |
| Google Business Profile setup | Dev | This month |
| Named author on blog posts | Jay | This month |
| Title length optimisation | Jay | This month |
| Local image hosting | Jay | This month |
| Add width/height to img tags | Jay | This month |
| Directory submissions (30+) | Dev | Next 2 months |
| CWV optimisation | Jay | Next 2 months |
| Internal linking audit | Jay | Next 2 months |
| Location OG images | Jay | Next 2 months |
| Fix office-space-for-rent-mumbai.php content | Jay | Next 2 months |
| YourStory pitch | Dev | Next 3 months |
| Monthly blog posts | Dev/Jay | Ongoing |
| LinkedIn articles | Dev/Jay | Ongoing |
