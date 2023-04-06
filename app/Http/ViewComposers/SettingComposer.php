<?php


namespace App\Http\ViewComposers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        //todo cache
        $setting = Setting::query()->where('key', 'site')->first();
        $view->with('site', $setting->value);
    }
}
