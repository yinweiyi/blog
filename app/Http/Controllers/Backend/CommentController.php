<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @param CommentService $commentService
     * @return JsonResponse
     */
    public function list(Request $request, CommentService $commentService): JsonResponse
    {
        $builder = $request->get('type') === 'articles' ?
            Article::query()->where('id', $request->id) :
            Setting::query()->where('id', $request->id);

        $model = $builder->first();
        if (is_null($model)) {
            return $this->error('评论不存在');
        }
        $lengthAwarePaginator = $commentService->treeFromArticle($model);

        return $this->success([
            'title' => $model->title,
            'total' => $lengthAwarePaginator->total(),
            'list'  => $lengthAwarePaginator->items()
        ]);
    }

    /**
     * 保存
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reply(Request $request): JsonResponse
    {
        $data = $request->only('parent_id', 'comment');

        $comment = Comment::query()->where('id', $data['parent_id'])->first();

        if (is_null($comment)) {
            return $this->error('要回复的评论不存在');
        }

        $attributes = [
            'parent_id'        => $data['parent_id'] ?? 0,
            'content'          => $data['comment'],
            'avatar'           => '/images/admin.jpg',
            'nickname'         => $request->user()->name,
            'email'            => 'lb@baigei.com',
            'commentable_id'   => $comment->commentable_id,
            'commentable_type' => $comment->commentable_type,
            'ip'               => request()->ip(),
            'is_read'          => 1,
            'is_admin_reply'   => 1,
            'top_id'           => $comment->top_id ?: $comment->id,
        ];

        Comment::query()->create($attributes);
        return $this->success();
    }

}
