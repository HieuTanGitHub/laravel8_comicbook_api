<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use File;
use Carbon\Carbon;
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
        // create new sitemap object
        $sitemap = \App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(\URL::to('/'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');

        
        // get all posts from db
        $danhmuc = DanhmucTruyen::orderBy('id', 'desc')->get();

        // add every post to the sitemap
        foreach ($danhmuc as $danh)
        {
            $sitemap->add(env('APP_URL'). "danh-muc/{$danh->slug_danhmuc}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

         // get all posts from db
        $theloai = Theloai::orderBy('id', 'desc')->get();

        // add every post to the sitemap
        foreach ($theloai as $loai)
        {
            $sitemap->add(env('APP_URL'). "the-loai/{$loai->slug_theloai}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

         // get all posts from db
        $theloai = Theloai::orderBy('id', 'desc')->get();

        // add every post to the sitemap
        foreach ($theloai as $loai)
        {
            $sitemap->add(env('APP_URL'). "the-loai/{$loai->slug_theloai}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

         // get all posts from db
        $truyen = Truyen::orderBy('id', 'desc')->get();
      

        // add every post to the sitemap
        foreach ($truyen as $tr)
        {
            $sitemap->add(env('APP_URL'). "xem-truyen/{$tr->slug_truyen}", Carbon::now('Asia/Ho_Chi_Minh'), '0.64', 'daily');
        }
      

         // get all posts from db
        $chapter = Chapter::with('truyen')->orderBy('id', 'desc')->get();

        // add every post to the sitemap
        foreach ($chapter as $chap)
        {
            $sitemap->add(env('APP_URL'). "xem-chapter/{$chap->truyen->slug_truyen}/{$chap->slug_chapter}", Carbon::now('Asia/Ho_Chi_Minh'), '0.64', 'daily');
        }
       
      

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        File::copy(public_path('sitemap.xml'),base_path('sitemap.xml'));
    }
}
