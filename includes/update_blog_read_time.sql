-- Add read_time column to existing blog_posts table
ALTER TABLE blog_posts ADD COLUMN read_time VARCHAR(20) DEFAULT '5 Min Read' AFTER category;
