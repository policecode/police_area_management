<?php

namespace App\Console\Commands;

use App\Enums\TotalChapter;
use App\Models\Author;
use App\Models\Category;
use App\Models\Chaper;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(route('index'), Carbon::now(), '1.0', 'daily');

        $categories = Category::orderBy('id', 'desc')->get();
        foreach ($categories as $category) {
            $sitemap->add(route('client.tag', ['tag_slug' => $category->slug]), Carbon::now(), '0.8', 'daily');
        }

        $authors = Author::orderBy('id', 'desc')->get();
        foreach ($authors as $author) {
            $sitemap->add(route('client.author', ['author_slug' => $author->slug]), Carbon::now(), '0.8', 'daily');
        }

        $totalChapters = TotalChapter::asArray();
        foreach ($totalChapters as $item) {
            $sitemap->add(route('client.total-chapter', ['slug_total' => $item['key']]), Carbon::now(), '0.8', 'daily');
        }

        $stories = Story::orderBy('updated_at', 'desc')->get();
        foreach ($stories as $item) {
            $sitemap->add(route('client.story', ['story_slug' => $item->slug]), Carbon::now(), '0.7', 'daily');
            $chaperList = Chaper::getByStory($item->id)->orderBy('position', 'DESC')->get();
            foreach ($chaperList as $key => $chapter) {
                $sitemap->add(route('client.chaper', ['story_slug' => $item->slug, 'chaper_slug' => $chapter->slug]), Carbon::now(), '0.6', 'daily');
            }
        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
    }
}
