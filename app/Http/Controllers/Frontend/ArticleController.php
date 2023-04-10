<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\CommentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    /**
     * 文章详情
     *
     * @param CommentService $commentService
     * @param $slug
     * @return Application|Factory|View
     */
    public function show(CommentService $commentService, $slug): Factory|View|Application
    {
        $article = Article::query()->where('is_show', 1)
            ->select(['id', 'slug', 'title', 'author', 'content_type', 'keywords', 'markdown', 'html', 'views', 'category_id', 'created_at'])
            ->with(['category' => function ($query) {
                $query->select(['id', 'slug', 'name']);
            }])->withCount(['comments' => function ($query) {
                $query->where('is_audited', 1);
            }])->where('slug', $slug)->first();

        if (is_null($article)) {
            return redirect(route('home.index'));
        }

        $article->increment('views');

        $next = Article::query()->select(['slug', 'title'])->where('id', '<', $article->id)->orderByDesc('id')->first();
        $last = Article::query()->select(['slug', 'title'])->where('id', '>', $article->id)->orderBy('id')->first();

        $comments = $commentService->treeFromArticle($article);

        return view('article.show', compact('article', 'last', 'next', 'comments'));
    }
}
