<?php

namespace App\Services;

use App\Models\Article;
use App\Notifications\ArticlePublished;
use App\Models\User;
class ArticleService
{
    public function create($author, $title, $body, $categories)
    {
        //create article
        $articleModel = Article::create([
            'title' => $title,
            'body' => $body,
        ]);

        //attach author
        $articleModel->author()->attach($author);

        //attach categories
        $articleModel->categories()->attach($categories);

        //notify followers
        $author->followers()->each(function ($follower) use ($articleModel) {
            $follower->notify(new ArticlePublished($articleModel));
        });

        //return article
        return $articleModel;
    }
}
