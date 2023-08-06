<?php

namespace App\Livewire\Article;

use App\Services\ArticleService;
use Livewire\Component;

class Create extends Component
{

    public $title;

    public $body;

    public $categories;

    public function create()
    {
        $articleService = new ArticleService();

        $user = auth()->user();

        if (!$user->can('create', Article::class)) {
            //show error message
            return;
        }

        $article = $articleService->create($user, $this->title, $this->body, $this->categories);

        //redirect to article page
        return redirect()->route('article.show', $article->id);
    }
    public function render()
    {
        return view('livewire.article.create');
    }
}
