<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ContactExport;
use App\Http\Controllers\Controller;
use App\Repositories\Sql\ContactUsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    protected $contactRepo ;

    public function __construct(ContactUsRepository $contactRepo)
    {
        $this->middleware('permission:contact_us-read')->only(['index']);
        $this->middleware('permission:contact_us-create')->only(['create', 'store']);
        $this->middleware('permission:contact_us-update')->only(['edit', 'update']);
        $this->middleware('permission:contact_us-delete')->only(['destroy']);
        $this->contactRepo = $contactRepo ;

    }


    public function get_contacts()
    {
        $contacts = $this->contactRepo->query();
        return DataTables($contacts)
        ->editColumn('sender' , function($contact){
            if($contact->type == 'saller'){
               return $contact->saller->name ;
            }elseif($contact->type == 'user'){
                return $contact->user->name ;
            }else{
                return $contact->name;
            }
        })

        ->editColumn('created_at' , function($contact){
            return date('D, d M Y - h:ia', strtotime($contact->created_at));
        })
        ->addColumn('msg' , 'dashboard.backend.contacts.seemore')
        ->rawColumns(['msg'])

        ->make(true);

    }

    public function index()
    {
        return view('dashboard.backend.contacts.index');
    }




    public function destroy($id)
    {
         $contact = $this->contactRepo->findOne($id);

        if ($contact->img) {
            Storage::delete($contact->img);
        }

        $contact->delete();

        return \response()->json([
            'message' => __('models.deleted_successfully')
        ]);
    }

    public function export()
    {
        return Excel::download(new ContactExport, 'contacts.xlsx');
    }
}
