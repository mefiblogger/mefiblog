<?php
/**
 * Fills slug field in posts with empty slug.
 */

// slug helper
require_once(dirname(__FILE__) . "/../src/Mefi/BlogBundle/Helper/SlugHelper.php");

// PDO connect
$pdo = new PDO('mysql:host=localhost;dbname=mefiblog;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// get all posts without slug
$stmt = $pdo->query("SELECT id, title FROM post WHERE slug = '';");

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo 'Fixing slugs in ' . count($posts) . ' entries...' . PHP_EOL . PHP_EOL;

foreach ($posts as $post) {
    $id = $post['id'];
    $slug = \Mefi\BlogBundle\Helper\SlugHelper::slugify($post['title']);

    echo str_pad($id, 6, ' ') . ' => ' . str_pad($slug, 70, ' ');

    if (isset($argv[1]) && '--force' == $argv[1]) {
        $rows = $pdo->exec("UPDATE post SET slug='$slug' WHERE id = $id LIMIT 1;") ;

        if (1 == $rows) {
            echo ' [fixed] ';
        } else {
            die ($pdo->errorInfo());
        }
    }

    echo PHP_EOL;
}