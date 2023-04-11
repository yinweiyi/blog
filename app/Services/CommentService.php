<?php
/**
 * Created by Idea.
 * User: wayee
 * Date: 2020/11/19
 * Time: 23:13
 */

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CommentService
{

    /**
     *
     * @param Model $model
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function treeFromArticle(Model $model, int $perPage = 5): LengthAwarePaginator
    {
        $fields = ['id', 'parent_id', 'content', 'avatar', 'nickname', 'email', 'commentable_id', 'commentable_type', 'is_admin_reply', 'top_id', 'created_at'];

        $comments = $model->comments()->where(['top_id' => 0, 'is_audited' => 1])
            ->orderByDesc('id')->paginate($perPage, $fields);
        if ($comments->isEmpty()) return $comments;

        $topIds = $comments->pluck('id')->unique();

        $children = Comment::query()->whereIn('top_id', $topIds)->where('is_audited', 1)
            ->select($fields)
            ->get();

        $allComments = $comments->merge($children);

        $unlimitedComments = $this->unlimitedForLayer($allComments->toArray());

        return new LengthAwarePaginator($unlimitedComments, $comments->total(), $perPage, $comments->currentPage(), [
            'path'     => Paginator::resolveCurrentPath(),
            'fragment' => 'comments',
            'pageName' => 'comment-page'
        ]);
    }


    /**
     * 无限级分类
     *
     * @param $comments
     * @param int $id
     * @return array
     */
    public function unlimitedForLayer($comments, int $id = 0): array
    {
        $list = [];
        foreach ($comments as $k => $v) {
            if ($v['parent_id'] == $id) {
                $v['children'] = $this->unlimitedForLayer($comments, $v['id']);
                $list[] = $v;
            }
        }
        return $list;

    }
}
