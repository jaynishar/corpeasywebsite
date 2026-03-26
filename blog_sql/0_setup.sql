-- Create blog_posts table if it does not exist
CREATE TABLE IF NOT EXISTS blog_posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  slug VARCHAR(255) DEFAULT NULL,
  category VARCHAR(100) DEFAULT 'Insights',
  read_time VARCHAR(50) DEFAULT '5 Min Read',
  image_url VARCHAR(500) DEFAULT NULL,
  excerpt TEXT,
  content LONGTEXT,
  author VARCHAR(100) DEFAULT 'CorpEasy Team',
  published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(20) DEFAULT 'published',
  INDEX idx_slug (slug),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add missing columns if table already exists but is incomplete
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS slug VARCHAR(255) DEFAULT NULL AFTER title;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS category VARCHAR(100) DEFAULT 'Insights' AFTER slug;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS read_time VARCHAR(50) DEFAULT '5 Min Read' AFTER category;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS image_url VARCHAR(500) DEFAULT NULL AFTER read_time;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS excerpt TEXT AFTER image_url;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS content LONGTEXT AFTER excerpt;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS author VARCHAR(100) DEFAULT 'CorpEasy Team' AFTER content;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS published_at DATETIME DEFAULT CURRENT_TIMESTAMP AFTER author;
ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS status VARCHAR(20) DEFAULT 'published' AFTER published_at;
