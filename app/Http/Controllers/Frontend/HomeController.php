<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Setting;
use App\Models\Tag;
use App\Services\CommentService;
use App\Vendors\File\OSS;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function test(OSS $oss)
    {

    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request): string
    {
        $keyword = $request->query('q');
        $articles = Article::query()
            ->where('is_show', 1)
            ->with(['tags' => function ($query) {
                $query->select(['id', 'slug', 'name']);
            }])
            ->when(!empty($keyword), function (Builder $query) use ($keyword) {
                $query->where('title', 'like', "%${keyword}%");
            })
            ->orderByRaw('is_top desc, `order` desc, id desc')
            ->paginate(7, ['id', 'title', 'slug', 'author', 'html', 'markdown', 'content_type', 'views', 'created_at']);
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
            ->orderByRaw('is_top desc, `order` desc, id desc')
            ->paginate(7, ['id', 'title', 'slug', 'author', 'html', 'markdown', 'content_type', 'views', 'created_at']);
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
            ->orderByRaw('is_top desc, `order` desc, id desc')
            ->paginate(7, ['id', 'title', 'slug', 'author', 'html', 'markdown', 'content_type', 'views', 'created_at']);
        return i_view('home.index', compact('articles'));
    }

    /**
     * @param CommentService $commentService
     * @return string
     */
    public function guestbook(CommentService $commentService): string
    {
        $guestbook = Setting::query()->where('key', 'guestbook')->withCount(['comments' => function ($query) {
            $query->where('is_audited', 1);
        }])->first();

        $comments = null;
        if (!is_null($guestbook)) {
            $comments = $commentService->treeFromArticle($guestbook);
        }

        return i_view('home.guestbook', compact('guestbook', 'comments'));
    }
}
