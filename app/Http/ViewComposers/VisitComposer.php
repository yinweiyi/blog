<?php


namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Vendors\Redis\VisitStatistics;
use Illuminate\View\View;

class VisitComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $visit = new VisitStatistics();
        $view->with('visitCount', $visit->get('total'));
    }
}
