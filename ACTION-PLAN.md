# CorpEasy SEO Action Plan
**Generated:** 2026-03-27 | **Priority Order: Impact × Effort**

---

## 🔴 P1 — Do Today (Critical)

| # | Task | File(s) | Est. Time | Impact |
|---|---|---|---|---|
| 1 | Deploy `_deploy/` to Hostinger | Hostinger FTP | 15 min | All local changes go live |
| 2 | Remove FAQPage schema from all commercial pages | index.php, faq.php, managed-office-space-mumbai.php | 20 min | Schema compliance |
| 3 | Add `loading="lazy"` + `width`/`height` to images | All PHP files | 30 min | CLS fix, mobile speed |
| 4 | Add `preconnect` hints in header.php | templates/header.php | 10 min | -200ms load time |
| 5 | Create `llms.txt` | /llms.txt (new file) | 15 min | AI search visibility |

---

## ⚠️ P2 — This Week

| # | Task | File(s) | Est. Time | Impact |
|---|---|---|---|---|
| 6 | Compile Tailwind to static CSS | New: style.min.css | 2–3 hrs | Biggest speed gain (+30–50 pts mobile) |
| 7 | Add BlogPosting schema to blog posts | blog-post.php | 45 min | Article rich results |
| 8 | Fix `beyond-four-walls` blog post (add to DB or swap featured) | DB / blog.php | 30 min | No broken links |
| 9 | Add Privacy Policy page | privacy-policy.php (new) | 1 hr | E-E-A-T + compliance |
| 10 | Verify and fix all image alt texts | All PHP files | 30 min | Image SEO |

---

## ℹ️ P3 — This Month

| # | Task | Detail | Impact |
|---|---|---|---|
| 11 | Enable Hostinger GZIP + Browser Cache | Hostinger control panel | Server-side speed |
| 12 | Convert images to WebP | Replace PNG/JPG with .webp | -30–60% image size |
| 13 | Minify + combine script.js + interactions.js | One `scripts.min.js` | Fewer HTTP requests |
| 14 | Submit updated sitemap to Google Search Console | search.google.com/search-console | Faster indexing |
| 15 | Request re-indexing for H1-changed pages | GSC → URL Inspection | Ranking refresh |
| 16 | Add `defer` to non-critical JS | templates/header.php | Non-blocking JS |

---

## Specific Code Fixes

### Fix 1: Remove FAQPage schema (index.php)
Delete the entire `$page_schema` block containing `"@type": "FAQPage"` in index.php.
Replace with nothing or a simple Service schema.

### Fix 2: Add preconnect to header.php
Add before closing `</head>`:
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<link rel="dns-prefetch" href="https://images.unsplash.com">
```

### Fix 3: Add lazy loading to images
Change all below-fold `<img>` tags from:
```html
<img src="..." alt="...">
```
To:
```html
<img src="..." alt="..." loading="lazy" width="1200" height="630">
```

### Fix 4: Create llms.txt
```
# CorpEasy — AI Search Context
> CorpEasy helps businesses find, set up, and manage office spaces in Mumbai.

## Services
- Managed Office Space: We source, set up, and manage commercial office spaces across Mumbai. Pricing from ₹10,000/seat/month (Goregaon) to ₹35,000/seat/month (BKC).
- Commercial Property Listing: We connect landlords with vetted business tenants in Mumbai.
- Facility Management: Day-to-day office operations including housekeeping, security, vendor management for companies with existing office space.

## Locations
BKC, Lower Parel, Worli, Goregaon East, Andheri East, Powai, Thane, Navi Mumbai

## Contact
Phone: +91 98330 89993 | +91 70211 34176
Email: info@corpeasy.in
Website: https://www.corpeasy.in

## Key Pages
- Managed Office Space Mumbai: https://www.corpeasy.in/managed-office-space-mumbai
- Office Space for Rent: https://www.corpeasy.in/office-space-for-rent-mumbai
- Facility Management: https://www.corpeasy.in/facility-management-mumbai
- FAQ: https://www.corpeasy.in/faq
- Blog: https://www.corpeasy.in/blog
```

### Fix 5: Compile Tailwind (run on your machine)
```bash
npm install -D tailwindcss
npx tailwindcss -i ./src/input.css -o ./style.min.css --minify
```
Then in header.php, replace:
```html
<script src="https://cdn.tailwindcss.com"></script>
```
With:
```html
<link rel="stylesheet" href="/style.min.css">
```
