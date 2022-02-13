<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use App\Models\Bonuse;
use App\Models\Notice;
use App\Models\Proceed;
use App\Models\Deduction;
use App\Models\Threshold;
use App\Models\Accumulate;
use App\Models\Attendence;
use App\Models\Department;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Models\PayrollStart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NoticeController extends Controller
{
    public function Notices()
    {
                    $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'notices'])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
         else{
             $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'bonus'])->first()->toarray();
             // dd($Employepermision); die;
         }
        $notice = Notice::get();
        return view('Admin.notice',get_defined_vars());
    }

   public function NoticesDelete(Request $request,$id)
    {
        $notice = Notice::find($id);
        $notice->delete();
        return redirect()->back()->with('message','Delete Successfully NoticeBoard');
    }


    public function AddNotices(Request $request)
    {
        // dd($request->title,$request->from_date,$request->to_date,$request->description);
$id=Auth::user()->id;
// dd($id);
         $addVal = new Notice;
            $addVal->user_id = $id;
            $addVal->title = $request->title;
            $addVal->start_date = $request->from_date;
            $addVal->end_date=$request->to_date;
            $addVal->description = implode(',', $request->content);

            $addVal->save();

        return redirect()->back()->with('message','Add Successfully NoticeBoard');
    }

    

    public function EditNotices(Request $request)
    {
        // dd($request->title,$request->from_date,$request->to_date,$request->description);
$login=Auth::user()->id;
$id=$request->id;
// dd($id);
        $addVal = Notice::where('id',$id)->first();
            $addVal->user_id = $login;
            $addVal->title = $request->title;
            $addVal->start_date = $request->from_date;
            $addVal->end_date=$request->to_date;
            $addVal->description =implode(',', $request->desciption);

            $addVal->save();

        return redirect()->back()->with('message','Update Successfully NoticeBoard');
    }


}
