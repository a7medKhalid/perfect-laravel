<?php

namespace App\Http\Controllers\Api;

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

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categories' => ['required', 'array'],
        ]);

        $user = auth()->user();

        if (!$user->can('create', Article::class)) {
            return response()->json(['message' => 'You are not authorized to create an article'], 403);
        }

        $article = $this->articleService->create($user, $request->title, $request->body, $request->categories);

        return response()->json($article);
    }
}
