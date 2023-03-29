<?php
/**
 * Created by Idea.
 * User: wayee
 * Date: 2020/11/21
 * Time: 21:52
 */

namespace App\Http\ViewComposers;


use App\Models\Sentence;
use Illuminate\View\View;

class SentenceComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $sentence = Sentence::query()->orderByDesc('id')->select(['author', 'content', 'translation', 'created_at'])->first();
        $view->with('sentence', $sentence);
    }
}
