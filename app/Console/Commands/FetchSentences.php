<?php

namespace App\Console\Commands;

use App\Models\Sentence;
use App\Vendors\Http;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class FetchSentences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:sentence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch sentence every day from ShanBay';

    const Url = 'https://web.shanbay.com/op/quotes/today';

    const Pattern = '/<p class="content">(.+)<\/p><p class="translation">(.+)<\/p><div class="author"><p>(.+)<\/p>/';

    /**
     * Execute the console command.
     *
     * @throws GuzzleException
     */
    public function handle()
    {
        try {
            $html = Http::get(url:self::Url, decode: false);
            preg_match(self::Pattern, $html, $matches);
            list($originString, $content, $translation, $author) = $matches;
            //获取最后一条数据
            $lastSentence = Sentence::query()->orderByDesc('id')->first();
            if (is_null($lastSentence) || $lastSentence->content !== $content) {
                //不一样则插入
                Sentence::query()->create(compact('author', 'translation', 'content'));
            }
        } catch (\Exception $exception) {
            $this->info($exception->getMessage());
        }
    }
}
