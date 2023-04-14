<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PushBaiduCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:baidu_collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push site urls to https://ziyuan.baidu.com/';

    const Url = 'http://data.zz.baidu.com/urls?site=https://www.ewayee.com&token=Z9NOHrweW8GamIfh';


    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $urls = $this->urls();
        Log::channel('baidu_push')->info('pushing urls to baidu:' . $this->urls()->implode(','));
        $api = 'http://data.zz.baidu.com/urls?site=https://www.ewayee.com&token=Z9NOHrweW8GamIfh';
        $ch = curl_init();
        $options = array(
            CURLOPT_URL            => $api,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $urls->implode("\n"),
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        Log::channel('baidu_push')->info('pushed success:' . $result);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function urls()
    {
        $urls = collect(['/', 'about', 'guestbook']);
        //分类
        $categories = Category::query()->pluck('slug')->map(function ($slug) {
            return 'category/' . $slug;
        });
        //标签
        $tags = Tag::query()->pluck('slug')->map(function ($slug) {
            return 'tag/' . $slug;
        });
        //文章
        $articles = Article::query()->pluck('slug')->map(function ($slug) {
            return 'articles/' . $slug;
        });

        return $urls->merge($categories)->merge($tags)->merge($articles)->map('app_url');
    }
}
