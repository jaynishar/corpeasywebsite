# OpenCode — Project Instructions for CorpEasy (htdocs)

## Project
PHP website for CorpEasy (corpeasy.in) — managed office space provider in Mumbai.
Stack: PHP, Tailwind CSS, MySQL. Hosted on Hostinger. Local dev via XAMPP.

## CRITICAL RULES — READ FIRST

### No Memory Loop
- **NEVER write to MEMORY.md during a session**
- Writing MEMORY.md mid-session triggers a file-modified event → causes infinite loop
- If you need to save context, do it ONLY when the user explicitly says "save memory" or at session end as the very last action

### Edit Files Directly — No Planning Phase
- When asked to change something, **edit the file immediately**
- Do NOT write a plan summary first and wait for confirmation
- Do NOT show a list of commands and ask "shall I run these?"
- Do NOT enter plan mode or show step-by-step summaries before acting
- Just make the change, then report what you did in 1-2 lines

### No Loops
- Complete the task in one pass
- Do not re-read the same file multiple times unless the content has actually changed
- Do not run verification commands in a loop — check once and stop

---

## How to Work Here

### File editing
- Use the Edit tool (or equivalent) to modify PHP files directly
- Primary files: `templates/header.php`, `templates/footer.php`, `index.php`, service pages
- Always read the file first, then make a targeted edit

### CSS / JS
- Main stylesheet: `style.css` → minified copy: `style.min.css`
- Main JS: `interactions.js` → minified copy: `interactions.min.js`
- Header references the `.min` versions with version query strings

### Deployment
- Local: XAMPP at `C:/xampp/htdocs`
- Live: Hostinger (deploy via git push to main branch)
- After changes: commit with `git add`, `git commit`, `git push`

### Database
- MySQL via XAMPP. Config in `db_config.php`
- Blog posts stored in `blog_posts` table

---

## What NOT to Do
- Do not rewrite entire files when a small edit is needed
- Do not add features that weren't asked for
- Do not add comments or docstrings to unchanged code
- Do not suggest website redesigns or structural changes
- Do not update MEMORY.md after every step
