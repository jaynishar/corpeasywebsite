-- Blog Posts Table for CorpEasy Insights
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    excerpt TEXT,
    content TEXT,
    image_url VARCHAR(500),
    author VARCHAR(100) DEFAULT 'CorpEasy Team',
    category VARCHAR(100) DEFAULT 'Insights',
    read_time VARCHAR(20) DEFAULT '5 Min Read',
    published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_published (published_at)
);
