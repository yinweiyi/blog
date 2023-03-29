<?php


namespace App\Http\ViewComposers;

use App\Models\Config;
use Illuminate\View\View;

class ConfigsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('configs', Config::query()->first());
    }
}
