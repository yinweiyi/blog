<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * 保存
     *
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $model = Comment::Types[$request->type];

        $article = $model::find($request->id);

        if (is_null($article)) return $this->error('评论的文章不存在');
        $attributes = $request->only(['parent_id', 'content', 'nickname', 'email']);

        if ($attributes['parent_id'] > 0) {
            $parent = Comment::query()->where(['commentable_id' => $article->getKey(), 'commentable_type' => get_class($article)])->find($attributes['parent_id']);
            if (is_null($parent)) return $this->error('要回复的评论不存在');
            $attributes['top_id'] = $parent->top_id ?: $parent->id;
        }

        $attributes['ip'] = $request->ip();
        $comment = $article->comments()->create($attributes);

        return $comment->exists() ? $this->success(['comment_id' => $comment->id], '评论成功') : $this->error('评论失败，请重试');
    }
}
