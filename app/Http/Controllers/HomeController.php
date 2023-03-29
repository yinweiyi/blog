<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Guestbook;
use App\Models\Tag;
use App\Services\CommentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request): string
    {
        $articles = Article::query()
            ->where('is_show', 1)
            ->with(['tags' => function ($query) {
                $query->select(['id', 'slug', 'name']);
            }])
            ->orderByRaw('is_top desc, id desc')
            ->paginate(7, ['id', 'title','slug', 'author', 'html', 'views', 'created_at']);
        return i_view('home.index', compact('articles'));
    }

    /**
     * @param $slug
     * @return string
     */
    public function category($slug): string
    {
        $articles = Article::query()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'slug', 'name']);
            }])
            ->whereHas('category', function ($query) use ($slug) {
                return $query->where('slug', $slug);
            })
            ->orderByRaw('is_top desc, id desc')
            ->paginate(7, ['id', 'title','slug', 'author', 'html', 'views', 'created_at']);
        return i_view('home.index', compact('articles'));
    }

    /**
     * @param Tag $tag
     * @return string
     */
    public function tag(Tag $tag): string
    {
        $articles = $tag->articles()
            ->with(['tags' => function ($query) {
                $query->select(['id', 'slug', 'name']);
            }])
            ->orderByRaw('is_top desc, id desc')
            ->paginate(7, ['id', 'title','slug', 'author', 'html', 'views', 'created_at']);
        return i_view('home.index', compact('articles'));
    }


    /**
     * 关于
     * @param CommentService $commentService
     * @return string
     */
    public function about(CommentService $commentService): string
    {
        $abouts = About::query()->where('is_enable', 1)->withCount(['comments' => function ($query) {
            $query->where('is_audited', 1);
        }])->orderBy('order')->get();

        $comments = null;
        if ($abouts->count()) {
            $comments = $commentService->treeFromArticle($abouts->first());
        }


        return i_view('home.about', compact('abouts', 'comments'));
    }

    /**
     * @param CommentService $commentService
     * @return string
     */
    public function guestbook(CommentService $commentService): string
    {
        $guestbook = Guestbook::query()->withCount(['comments' => function ($query) {
            $query->where('is_audited', 1);
        }])->first();

        $comments = null;
        if (!is_null($guestbook)) {
            $comments = $commentService->treeFromArticle($guestbook);
        }
        return i_view('home.guestbook', compact('guestbook', 'comments'));
    }
}
