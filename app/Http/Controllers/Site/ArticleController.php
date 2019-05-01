<?php

namespace App\Http\Controllers\Site;

use App\Article;

class ArticleController extends SiteController
{

    public function index(Article $article)
    {
        $this->view = 'site.article';
        $this->data['article'] = $article;

        return $this->render();
    }
}
