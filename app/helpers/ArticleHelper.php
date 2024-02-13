<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('isArticleSaved')) {
    function isArticleSaved($articleId) {
        $savedArticles = Cache::get('saved_articles');
        foreach ($savedArticles as $savedArticle) {
            if ($savedArticle['article_id'] == $articleId) {
                return true;
            }
        }
        return false;
    }
}
