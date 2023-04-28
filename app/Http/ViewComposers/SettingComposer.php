<?php


namespace App\Http\ViewComposers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
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
        $setting = Cache::remember('setting', 3600, function () {
             return Setting::query()->where('key', 'site')->first();
        });

        $view->with('site', $setting->value);
    }
}
