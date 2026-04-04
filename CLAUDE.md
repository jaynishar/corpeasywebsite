# CorpEasy — Project Context

## What is CorpEasy
Managed office space provider in Mumbai. Works **requirement-first** (no inventory). Client tells team size, location preference, budget → CorpEasy finds the space, negotiates lease, sets up workspace, and manages it. One point of contact. Clear per-seat cost.

## Key People
- **Dev Doshi** — Co-Founder (+91 9833089993, devdoshi@corpeasy.in)
- **Jay Nishar** — Co-Founder

## Tech Stack
- **PHP** (plain, no framework)
- **MySQL** (db_config.php)
- **Tailwind CSS** (style.css, tailwind.min.css)
- **Vanilla JS** (interactions.js, script.js)
- **Simple admin panel** (admin_simple.php)

## Key Pages
| File | Purpose |
|------|---------|
| index.php | Homepage with pricing table, testimonials, insights section |
| blog.php | Blog listing page |
| blog-post.php | Single blog post viewer (DB + fallback) |
| faq.php | FAQ page with FAQPage schema |
| contact.php | Contact form |
| about.php | About page |
| managed-office-vs-coworking.php | Comparison page (SEO) |
| what-is-a-managed-office.php | Pillar guide (SEO) |
| office-space-cost-mumbai-2026.php | Data-driven article (SEO, backlink bait) |
| blog/mumbai-workspace-guide.php | Full SEO article |
| blog/bkc-vs-goregaon.php | Full SEO article |
| blog/managed-office-explainer.php | Full SEO article |
| blog/gst-office-rental.php | Full SEO article |
| managed-office-bkc.php | Location page |
| managed-office-goregaon.php | Location page |
| managed-office-lower-parel.php | Location page |
| managed-office-andheri.php | Location page |
| managed-office-space-mumbai.php | Main service page |
| facility-management-mumbai.php | Facility management service |
| list-commercial-property-mumbai.php | Property owner listing |
| office-for-rent-bkc.php | BKC rent page |
| office-for-rent-lower-parel.php | Lower Parel rent page |
| office-space-for-rent-mumbai.php | General rent page |

## SEO Strategy
- Target keywords: "managed office space Mumbai", "office space cost Mumbai", "what is managed office", "BKC vs Goregaon office"
- Internal linking across all pages (blog → service pages → comparison → contact)
- Schema markup: FAQPage, Article, LocalBusiness, Organization
- Blog articles with full SEO content and cross-linking
- **Current ranking:** Page 1 for branded searches, Page 2-3 for "managed office space Mumbai", nowhere for non-branded "office space for rent Mumbai"

## Backlink Strategy (In Progress)
- **Model:** Service provider directories (NOT property listings — no inventory)
- **Priority:** Google Business Profile, LinkedIn, IndiaMART, Justdial, Sulekha
- **Content:** Medium articles, LinkedIn articles, Quora answers, SlideShare
- **PR:** YourStory pitch, PRLog, OpenPR
- **Target:** 60-100 referring domains in 3 months

## Important URLs
- Live site: https://www.corpeasy.in
- GitHub: https://github.com/jaynishar/corpeasywebsite
- WhatsApp: +91 9833089993

## Conventions
- All pages use `templates/header.php` and `templates/footer.php`
- SEO: each page has `$page_title`, `$page_description`, `$page_keywords`, `$page_canonical`, `$page_schema`
- Styling: Tailwind CSS + custom glass-card components
- Images: use `.webp` format, `-sm` variants for logos
- Blog articles are standalone PHP files in `blog/` directory
- Internal linking: every article links to 3 related articles + CTA to contact

## Pending / TODO
- [ ] Set up Google Business Profile and get 10+ reviews
- [ ] Submit to 30+ free business directories (service provider listings)
- [ ] Publish press release on PRLog, OpenPR
- [ ] Pitch founder story to YourStory
- [ ] Add 5 more location pages (Powai, Navi Mumbai, Thane, Worli, Chandivali)
- [ ] Create and upload cost breakdown PDF to SlideShare

## Memory System — MANDATORY RULES
- **MEMORY.md** contains persistent session memory — completed tasks, decisions, lessons learned, and session logs
- **ALWAYS read MEMORY.md at session start** to know what was done previously
- **ALWAYS update MEMORY.md at session end** — this is NOT optional, NOT a suggestion
- This file is also loaded via opencode.json `instructions` field for automatic context loading

### Auto-Memory Update Protocol (Execute Before Ending ANY Session)
1. Read current MEMORY.md
2. Append today's date and session summary under "## Session Log"
3. Update "## Completed Tasks" — mark any newly finished items as [x]
4. Update "## Pending / TODO" — add new pending items, remove completed ones
5. Update "## Key Decisions & Patterns" — add any new decisions made
6. Update "## Lessons Learned" — add any new insights
7. Update "Project State (Last Updated: YYYY-MM-DD)" with today's date
8. Write the updated MEMORY.md file

### Trigger Conditions (Update MEMORY.md when ANY of these happen)
- Any file was created, modified, or deleted
- Any decision was made about architecture, design, or approach
- Any new task was completed
- Any error was encountered and resolved
- User asks to save progress
- Session is about to end (always do this)

### Format for Session Log Entries
```
### YYYY-MM-DD — Brief Session Title
- What was done (specific, not vague)
- Files created/modified
- Decisions made and why
- Issues encountered and how they were resolved
- Next steps identified
```
