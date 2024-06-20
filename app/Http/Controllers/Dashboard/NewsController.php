<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Repositories\Sql\NewsRepository;
use App\Services\Admin\NewsService;


class NewsController extends Controller
{
    protected $newsRepo , $newsService ;

    public function __construct(NewsRepository $newsRepo , NewsService $newsService)
    {
        $this->middleware('permission:news-read')->only(['index']);
        $this->middleware('permission:news-create')->only(['create', 'store']);
        $this->middleware('permission:news-update')->only(['edit', 'update']);
        $this->middleware('permission:news-delete')->only(['destroy']);
        $this->newsRepo    = $newsRepo ;
        $this->newsService = $newsService ;

    }


    public function get_news()
    {
       return $this->newsService->get_news();
    }

    public function index()
    {

         return view('dashboard.backend.news.index');
    }


    public function create()
    {
         return view('dashboard.backend.news.create');
    }


    public function store(NewsRequest $request)
    {

        $data = $request->except('img' , 'admin_id');
        $this->newsService->add_news($request , $data);
        return redirect(route('admin.news.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $new = $this->newsRepo->findOne($id);
        return view('dashboard.backend.news.edit' , compact('new'));

    }


    public function update(NewsRequest $request, $id)
    {
         $new = $this->newsRepo->findOne($id);
         $data = $request->except('img' , 'admin_id');
         $this->newsService->update_news($request , $data , $new);

        return redirect(route('admin.news.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $new = $this->newsRepo->findOne($id);
        $this->newsService->delete($new);


        return redirect(route('admin.news.index'))->with('success', __('models.deleted_successfully'));

    }
}
