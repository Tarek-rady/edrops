<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    use HelperTrait;
    protected $newsRepo ;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo    = $newsRepo ;
    }

    public function get_news(){

        $news = $this->newsRepo->query();

        return $this->columns($news);
    }

    public function columns($news){
        return DataTables($news)
        ->editColumn('admin' , function($new){
            return $new->admin->name;
        })
        ->editColumn('title' , function($new){
            return $new->title;
        })
        ->editColumn('created_at' , function($new){
            return date('D, d M Y - h:ia', strtotime($new->created_at));
        })
        ->addColumn('action', 'dashboard.backend.news.actions')

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_news(Request $request , $data){
        $this->addImage($request, $data, 'img', 'news');
        $data['admin_id'] = auth('admin')->user()->id ;
        $news =$this->newsRepo->create($data);
    }

    public function update_news(Request $request , $data , $news){
        $this->updateImg($request, $data, 'img', 'news' , $news);
        $data['admin_id'] = auth('admin')->user()->id ;
        $news->update($data);
    }

    public function delete($new){
        if ($new->img) {
            Storage::delete($new->img);
        }

        $new->delete();

    }


}
