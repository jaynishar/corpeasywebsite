<?php
// This file exists so Apache doesn't try to list the blog/ directory (which causes 403).
// It simply includes the parent blog.php which is the actual Insights page.
include __DIR__ . '/../blog.php';
