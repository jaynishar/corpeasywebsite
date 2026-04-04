# CorpEasy — Session Memory

> Auto-updated memory file. Each session should append completed tasks, decisions, and context here.
> This file is loaded at the start of every opencode session so nothing is lost between sessions.

---

## Project State (Last Updated: 2026-04-04)

### What is CorpEasy
Managed office space provider in Mumbai. Works **requirement-first** (no inventory). Client tells team size, location preference, budget → CorpEasy finds the space, negotiates lease, sets up workspace, and manages it. One point of contact. Clear per-seat cost.

### Key People
- **Dev Doshi** — Co-Founder (+91 9833089993, devdoshi@corpeasy.in)
- **Jay Nishar** — Co-Founder

### Tech Stack
- **PHP** (plain, no framework)
- **MySQL** (db_config.php)
- **Tailwind CSS** (style.css, tailwind.min.css)
- **Vanilla JS** (interactions.js, script.js)
- **Simple admin panel** (admin_simple.php)

### Live URLs
- Site: https://www.corpeasy.in
- GitHub: https://github.com/jaynishar/corpeasywebsite
- WhatsApp: +91 9833089993

---

## Completed Tasks

### SEO & Content
- [x] Created 4 blog articles: mumbai-workspace-guide, bkc-vs-goregaon, managed-office-explainer, gst-office-rental
- [x] Created 7 location pages: BKC, Goregaon, Lower Parel, Andheri, Powai, Navi Mumbai, Thane
- [x] Created main service page: managed-office-space-mumbai.php
- [x] Created comparison page: managed-office-vs-coworking.php
- [x] Created pillar guide: what-is-a-managed-office.php
- [x] Created data-driven article: office-space-cost-mumbai-2026.php
- [x] Created facility management page: facility-management-mumbai.php
- [x] Created property owner listing page: list-commercial-property-mumbai.php
- [x] Created rent pages: BKC, Lower Parel, general Mumbai
- [x] All pages have proper SEO variables ($page_title, $page_description, $page_keywords, $page_canonical, $page_schema)
- [x] Schema markup implemented: FAQPage, Article, LocalBusiness, Organization
- [x] Internal linking across all pages (blog → service → comparison → contact)
- [x] sitemap.xml created and updated with all pages
- [x] robots.txt configured with AI crawler rules
- [x] Optimized press release with both founder details and company portrait

### SEO Performance
- Page 1 for branded searches
- Page 2-3 for "managed office space Mumbai"
- Nowhere for non-branded "office space for rent Mumbai"

### Backlink Strategy (Planned)
- Model: Service provider directories (NOT property listings — no inventory)
- Priority: Google Business Profile, LinkedIn, IndiaMART, Justdial, Sulekha
- Content: Medium articles, LinkedIn articles, Quora answers, SlideShare
- PR: YourStory pitch, PRLog, OpenPR
- Target: 60-100 referring domains in 3 months

### Site Infrastructure
- [x] templates/header.php and templates/footer.php used across all pages
- [x] Tailwind CSS + glass-card components
- [x] .webp images with -sm variants for logos
- [x] Blog articles as standalone PHP files in blog/ directory
- [x] FAQ page with FAQPage schema
- [x] Contact form
- [x] About page

---

## Pending / TODO
- [ ] Set up Google Business Profile and get 10+ reviews
- [ ] Submit to 30+ free business directories (service provider listings)
- [ ] Publish press release on PRLog, OpenPR
- [ ] Pitch founder story to YourStory
- [ ] Add 2 more location pages (Worli, Chandivali)
- [ ] Create and upload cost breakdown PDF to SlideShare
- [ ] Expand faq.php with 20+ People Also Ask questions
- [ ] Add FAQ sections to service pages without them
- [ ] Create 2 new blog articles targeting PAA queries
- [ ] Strengthen internal linking across all pages
- [ ] Add fresh 2026 data to existing blog articles

---

## Session Log

### 2026-04-04 — Memory System Setup
- Created MEMORY.md for persistent session memory
- Updated CLAUDE.md to reference memory system
- Configured opencode.json to load MEMORY.md as instructions
- Removed invalid hooks.json (opencode doesn't support hooks in that format)

### 2026-04-04 — Press Release Optimization
- Optimized press release with both founder details (Dev Doshi + Jay Nishar)
- Added quotes from both founders
- Added "About CorpEasy" company portrait section
- Tightened structure, removed redundant URLs
- Added standard ### end marker
- Saved to press-release.txt

### 2026-04-04 — SEO Infrastructure & Location Pages
- Updated sitemap.xml with 3 new location pages (Powai, Navi Mumbai, Thane)
- Created managed-office-powai.php — full SEO page targeting IIT Bombay/Hiranandani angle
- Created managed-office-navi-mumbai.php — full SEO page targeting affordability/BPO angle
- Created managed-office-thane.php — full SEO page targeting Lodha Supremus/Ashar IT Park angle
- All 3 pages have proper SEO variables, schema markup, FAQ sections, internal linking

---

## Key Decisions & Patterns
- All new pages follow the same SEO template pattern
- Internal linking is mandatory — every article links to 3 related pages + CTA
- Images must be .webp format
- No framework PHP — keep it simple and fast
- Glass-card UI design system is the standard
- Blog articles are standalone PHP files (not DB-driven for SEO articles)
- Location pages should target specific buildings/landmarks for long-tail SEO
- Each location page needs: pricing, market context, target audience, FAQ, cross-links

---

## Lessons Learned
- Opencode doesn't support "hooks" in opencode.json — use AGENTS.md/MEMORY.md for persistence instead
- The context-agent skill scripts don't exist at the expected path — memory must be file-based
- CLAUDE.md is loaded automatically by opencode (Claude Code compatibility)
- MEMORY.md should be referenced via opencode.json "instructions" field
- robots.txt already has comprehensive AI crawler rules — don't overwrite
- sitemap.xml already exists with good structure — just update dates and add new pages
