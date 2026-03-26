-- ============================================================
-- Blog Posts INSERT Statements for blog_posts table
-- Database: MySQL (Hostinger / phpMyAdmin compatible)
-- Table: blog_posts
-- Columns: id, title, slug, category, read_time, image_url,
--          excerpt, content, author, published_at, status
-- ============================================================

-- Add slug column if it does not already exist
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS slug VARCHAR(255) DEFAULT NULL AFTER title;
ALTER TABLE blog_posts ADD INDEX IF NOT EXISTS idx_slug (slug);

