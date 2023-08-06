<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    protected ArticleService $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categories' => ['required', 'array'],
        ]);

        $user = auth()->user();

        if (!$user->can('create', Article::class)) {
            return redirect()->back()->withErrors(['You are not authorized to create an article']);
        }

        $article = $this->articleService->create($user, $request->title, $request->body, $request->categories);

        //redirect to article page
        return redirect()->route('article.show', $article->id);
    }
}
