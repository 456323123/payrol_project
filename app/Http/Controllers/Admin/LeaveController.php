<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SickLeave;
use App\Models\VacationLeave;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendence;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function sick_leave()
    {
        $view_sick_leave['all_emp']=User::where('user_role','user')->select('id','first_name')->get();
        $view_sick_leave['view_sick_leave']= DB::table('sick_leaves')
        ->leftjoin('users','users.id','=','sick_leaves.user_id')
        ->select('users.first_name','sick_leaves.*')->orderBy('id','DESC')->get();

        return view('Admin.sick_leave',$view_sick_leave);
    }


    public function insert_sick_leave(Request $request)
    {
        // get leave data start
        $title=$request->title;
        $leave_date=$request->leave_date;
        $description=$request->description;
        // get leave data end

        // get user join date start
        $user_id=$request->user_id;
        $emp_join_date_get=User::where('user_role','user')->where('id',$user_id)->select('join_date','annual_sick_leave')->first();
        $emp_join_date=$emp_join_date_get->join_date;
        $allow_emp_sick_leave_annual=$emp_join_date_get->annual_sick_leave;
        // get user join date end

       // dd($emp_join_date_get);

        //sick leave data get emp start
        $c_year=date('Y');
        $emp_sick_leave_get=SickLeave::where('user_id',$user_id)->where('c_year',$c_year)->orderby('id','DESC')->first();

        //sick leave data get emp end

        //sick leave count emp start
        $emp_sick_leave_count=SickLeave::where('user_id',$user_id)->where('c_year',$c_year)->count();
        //sick leave count emp end


       //dd($allow_emp_sick_leave_annual,$emp_sick_leave_count);

        //calculate joining emp date to sick leave date start
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_join_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date);
        $diff_in_days = $to->diffInDays($from);
        //calculate joining emp date to sick leave date end

        $c_date=date('Y-m-d');
        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date);
        $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $c_date);

        $result = $date1->gte($date2);


        ///check curren and after date
        if($date1->gte($date2))
        {
        //condition one  apply Employee can only submit sick day after 110 days worked
        //start
        if($diff_in_days > 110)
        {
            ////check emp first leave exist or not start

            if($emp_sick_leave_get != null)
            {
                $emp_leave_date=$emp_sick_leave_get->leave_date;
                     //calculate first sick date emp to sick leave date start
                    $to_sick = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_leave_date);
                    $from_sick = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date);
                    $diff_in_days_sick = $to_sick->diffInDays($from_sick);
                    //calculate first sick date emp to sick leave date end

                 //annual leave allow and check pennding leave
            if($emp_sick_leave_count < $allow_emp_sick_leave_annual && $emp_sick_leave_count <= 0)
            {
                ////condition two Employee accumulate 1 sick day every 22 days worked start
                if($diff_in_days_sick > 22)
                {
                //insert first after 22 days sick leave
                $insert_sick_leave=new SickLeave();
                $insert_sick_leave->user_id=$user_id;
                $insert_sick_leave->title=$title;
                $insert_sick_leave->leave_date=$leave_date;
                $insert_sick_leave->description=$description;
                $insert_sick_leave->c_year=$c_year;
                $insert_sick_leave->status=1;
                $insert_sick_leave->save();
                $update_emp_sick=User::find($user_id);
                if($update_emp_sick->annual_sick_leave <= 10)
                {
                    //dd($update_emp_sick->annual_sick_leave);
                     $update_emp_sick->annual_sick_leave=$update_emp_sick->annual_sick_leave - 1;
                    $update_emp_sick->save();
                }
                return redirect()->back()->with('success', 'Your Sick leave apply Successfully!');

                }else{
                    return redirect()->back()->with('error', 'Your can apply sick leave after '.$diff_in_days_sick.' days !');

                }
            }else{
                return redirect()->back()->with('error', 'Your Allow Leave Completed do not more sick leave apply!');

            }
                ////condition two Employee accumulate 1 sick day every 22 days worked end

            }else{
                //insert first before 22 days sick leave
                $insert_sick_leave=new SickLeave();
                $insert_sick_leave->user_id=$user_id;
                $insert_sick_leave->title=$title;
                $insert_sick_leave->leave_date=$leave_date;
                $insert_sick_leave->description=$description;
                $insert_sick_leave->c_year=$c_year;
                $insert_sick_leave->status=1;
                $insert_sick_leave->save();

                /////////update sick leave start
                $update_emp_sick=User::find($user_id);
                if($update_emp_sick->annual_sick_leave <= 10 && $update_emp_sick->annual_sick_leave <= 0)
                {
                    //dd($update_emp_sick->annual_sick_leave);
                     $update_emp_sick->annual_sick_leave=$update_emp_sick->annual_sick_leave - 1;
                    $update_emp_sick->save();
                }
                ///////////////end
                /////////atten emp sick leave insert start
                $atten_check=Attendence::where('user_id',$user_id)->where('date',$leave_date)->first();
                if($atten_check == null)
                {
                $start_time=date('H:i:s');
                $atten=new Attendence();
                $atten->user_id=$user_id;
                $atten->start_time='00:00:00';
                $atten->date=$leave_date;
                $atten->work_time='08:00:00';
                $atten->overtime='00:00:00';
                $atten->end_time=0;
                $atten->total_hours=0;
                $atten->work_and_overtime=0;
                $atten->status=0;
                $atten->save();
                }
                /////////atten emp sick leave insert end

                return redirect()->back()->with('message', 'Your Sick leave apply Successfully!');

            }
            ////check emp first leave exist or not start
        }else{
            ////new emp message return

            return redirect()->back()->with('error', 'Your New Emp to joined '.$diff_in_days.' days !');

        }
    }else{
        return redirect()->back()->with('error', 'Please select after current date to apply sick leave!');

    }
        //end
        ////VIEW PAGE RETURN
        return view('Admin.sick_leave');
    }

    public function sick_status_deactive($id)
    {
        $sick_status_deactive=SickLeave::find($id);
        $sick_status_deactive->status=0;
        $sick_status_deactive->save();

         ///sick leave update emp start
         $update_emp_sick=User::find($sick_status_deactive->user_id);
         if($update_emp_sick->annual_sick_leave < 10 && $update_emp_sick->annual_sick_leave >= 0)

         {
             //dd($update_emp_sick->annual_sick_leave);
              $update_emp_sick->annual_sick_leave=$update_emp_sick->annual_sick_leave + 1;
             $update_emp_sick->save();
         }

        // dd($emp_get->annual_sick_leave);
         ///sick leave update emp end
        return redirect()->back()->with('error','Sick Leave successfully Deactive! remaning leave -'.$update_emp_sick->annual_sick_leave.'');

    }
    public function sick_status_active($id)
    {
        $sick_status_active=SickLeave::find($id);
        $sick_status_active->status=1;
        $sick_status_active->save();
       // $get_sick_leavet=SickLeave::
        ///sick leave update emp start
        //$emp_get=User::where('id',$sick_status_active->user_id)->select('annual_sick_leave')->first();
        $update_emp_sick=User::find($sick_status_active->user_id);
        if($update_emp_sick->annual_sick_leave <= 10 && $update_emp_sick->annual_sick_leave >= 0)
        {
            //dd($update_emp_sick->annual_sick_leave);
             $update_emp_sick->annual_sick_leave=$update_emp_sick->annual_sick_leave - 1;
            $update_emp_sick->save();
        }
        //dd($emp_get->annual_sick_leave);
        ///sick leave update emp end
        ///attendence inserted start
        $atten_check=Attendence::where('user_id',$sick_status_active->user_id)->where('date',$sick_status_active->leave_date)->first();
        if($atten_check == null)
        {
        $start_time=date('H:i:s');
        $atten=new Attendence();
        $atten->user_id=$sick_status_active->user_id;
        $atten->start_time='00:00:00';
        $atten->date=$sick_status_active->leave_date;
        $atten->work_time='08:00:00';
        $atten->overtime='00:00:00';
        $atten->end_time=0;
        $atten->total_hours=0;
        $atten->work_and_overtime=0;
        $atten->status=0;
        $atten->save();
        }
        ///attendence inserted end
        return redirect()->back()->with('success','Sick Leave successfully Approved! remaning leave -'.$update_emp_sick->annual_sick_leave.'');

    }
    public function  delete_sick($id)
    {
        $delete_sick=SickLeave::find($id);
        $delete_sick->delete();

        return redirect()->back()->with('error','Sick Leave successfully Deleted!');
    }


    ////////////////////////////sick leave function end///////////////////////////
    ////////////////////////////vacation leave function start///////////////////////////
    public function vacation_leave()
    {
        $view_vacation_leave['all_emp']=User::where('user_role','user')->select('id','first_name')->get();
        $view_vacation_leave['view_vacation_leave']= DB::table('vacation_leaves')
        ->leftjoin('users','users.id','=','vacation_leaves.user_id')
        ->select('users.first_name','vacation_leaves.*')->orderBy('id','DESC')->get();

        return view('Admin.vacation_leave',$view_vacation_leave);
    }


    public function insert_vacation_leave(Request $request)
    {
        // get leave data start
        $title=$request->title;
        $leave_date_start=$request->leave_date_start;
        $leave_date_end=$request->leave_date_end;
        $description=$request->description;
        // get leave data end
        //dd($request->input());

        ///vacation holiday days start
        $to_vacation_start = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_start);
        $from_vacation_end = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_end);
        $diff_in_days_vacation_check_diff = $to_vacation_start->diffInDays($from_vacation_end);
        //if one day include
        $diff_in_days_vacation_check=$diff_in_days_vacation_check_diff+1;
        //dd($diff_in_days_vacation_check);
        ///vacation holiday days end


        // get user join date start

        $user_id=$request->user_id;
        $emp_join_date_get=User::where('user_role','user')->where('id',$user_id)->select('join_date','annual_vacation_leave')->first();
        $emp_join_date=$emp_join_date_get->join_date;
        $annual_vacation_leave=$emp_join_date_get->annual_vacation_leave;

        // $user_id=Auth::user()->id;
        // $emp_join_date_get=User::where('user_role','user')->where('id',$user_id)->first();
        // $emp_join_date=$emp_join_date_get->join_date;
        // $allow_emp_sick_leave_annual=$emp_join_date_get->annual_vacation_leave;

        // get user join date end

        //sick leave data get emp start
        $c_year=date('Y');
        $emp_vacation_leave_get=VacationLeave::where('user_id',$user_id)->where('c_year',$c_year)->orderby('id','DESC')->first();
        //sick leave data get emp end

        //sick leave count emp start
        $emp_vacation_leave_count=VacationLeave::where('user_id',$user_id)->where('c_year',$c_year)->sum('allow_leave');
        //sick leave count emp end


        //dd($emp_vacation_leave_count);

        //calculate joining emp date to sick leave date start
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_join_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_end);
        $diff_in_days = $to->diffInDays($from);
        //calculate joining emp date to sick leave date end

        $c_date=date('Y-m-d');
        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_start);
        $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $c_date);

        $result = $date1->gte($date2);


        ///check curren and after date
        if($date1->gte($date2))
        {

            if($emp_vacation_leave_count < $annual_vacation_leave && $diff_in_days_vacation_check <= $annual_vacation_leave)
            {
        //condition one  apply Employee can only submit sick day after 110 days worked
        //start
        if($diff_in_days > 220)
        {
                 //annual leave allow and check pennding leave
                // if($emp_vacation_leave_count < $annual_vacation_leave && $diff_in_days_vacation <= 0)

            ////check emp first leave exist or not start

            if($emp_vacation_leave_get != null)
            {
                $emp_leave_date=$emp_vacation_leave_get->leave_date_start;

                     //calculate first sick date emp to sick leave date start
                    $to_vacation = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_leave_date);
                    $from_vacation = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_end);
                    $diff_in_days_vacation = $to_vacation->diffInDays($from_vacation);
                    //calculate first sick date emp to sick leave date end

               // dd($diff_in_days_vacation_check);
                ////condition two Employee accumulate 1 sick day every 22 days worked start
                if($diff_in_days_vacation > 22)
                {
                //insert first after 22 days sick leave
                $insert_vacation_leave=new VacationLeave();
                $insert_vacation_leave->user_id=$user_id;
                $insert_vacation_leave->title=$title;
                $insert_vacation_leave->leave_date_start=$leave_date_start;
                $insert_vacation_leave->leave_date_end=$leave_date_end;
                $insert_vacation_leave->description=$description;
                $insert_vacation_leave->c_year=$c_year;
                $insert_vacation_leave->allow_leave=$diff_in_days_vacation;
                $insert_vacation_leave->status=1;
                $insert_vacation_leave->save();

                      /////////update sick leave start
                      $update_emp_vacation=User::find($user_id);
                      if($update_emp_vacation->annual_vacation_leave <= 10 && $update_emp_vacation->annual_sick_leave >= 0)
                      {
                          //dd($update_emp_sick->annual_sick_leave);
                           $update_emp_vacation->annual_vacation_leave=$update_emp_vacation->annual_sick_leave - $diff_in_days_vacation;
                          $update_emp_vacation->save();
                      }
                      ///////////////end
                  ///attendence inserted start
        $atten_check=Attendence::where('user_id',$user_id)->where('date',$leave_date_end)->first();
        if($atten_check == null)
        {
        $start_time=date('H:i:s');
        $atten=new Attendence();
        $atten->user_id=$user_id;
        $atten->start_time='00:00:00';
        $atten->date=$leave_date_end;
        $atten->work_time='08:00:00';
        $atten->overtime='00:00:00';
        $atten->end_time=0;
        $atten->total_hours=0;
        $atten->work_and_overtime=0;
        $atten->status=0;
        $atten->save();
        }
        ///attendence inserted end
                return redirect()->back()->with('success', 'Your Vacation leave apply Successfully!');

                }else{
                    return redirect()->back()->with('error', 'Your can apply Vacation leave after '.$diff_in_days_vacation.' days !');

                }

                ////condition two Employee accumulate 1 sick day every 22 days worked end

            }else{

                //insert first before 22 days sick leave
                $insert_vacation_leave=new VacationLeave();
                $insert_vacation_leave->user_id=$user_id;
                $insert_vacation_leave->title=$title;
                $insert_vacation_leave->leave_date_start=$leave_date_start;
                $insert_vacation_leave->leave_date_end=$leave_date_end;
                $insert_vacation_leave->description=$description;
                $insert_vacation_leave->c_year=$c_year;
                $insert_vacation_leave->allow_leave=$diff_in_days_vacation_check;
                $insert_vacation_leave->status=1;
                $insert_vacation_leave->save();
                 /////////update sick leave start
                 $update_emp_vacation=User::find($user_id);
                 if($update_emp_vacation->annual_vacation_leave <= 10 && $update_emp_vacation->annual_vacation_leave >= 0)
                 {
                     //dd($update_emp_sick->annual_sick_leave);
                      $update_emp_vacation->annual_vacation_leave=$update_emp_vacation->annual_vacation_leave - $diff_in_days_vacation_check;
                     $update_emp_vacation->save();
                 }
                 ///////////////end
                         ///attendence inserted start
        $atten_check=Attendence::where('user_id',$user_id)->where('date',$leave_date_end)->first();
        if($atten_check == null)
        {
        $start_time=date('H:i:s');
        $atten=new Attendence();
        $atten->user_id=$user_id;
        $atten->start_time='00:00:00';
        $atten->date=$leave_date_end;
        $atten->work_time='08:00:00';
        $atten->overtime='00:00:00';
        $atten->end_time=0;
        $atten->total_hours=0;
        $atten->work_and_overtime=0;
        $atten->status=0;
        $atten->save();
        }
        ///attendence inserted end
                return redirect()->back()->with('success', 'Your Vacation leave apply Successfully!');

            }
            ////check emp first leave exist or not start
        }else{
            ////new emp message return

            return redirect()->back()->with('error', 'Your New Emp to joined '.$diff_in_days.' days !');

        }

        ////
    }else{
        return redirect()->back()->with('error', 'You are selected vacation days '. $diff_in_days_vacation_check.' ! but remaining leave -'.$annual_vacation_leave. ' days');

    }

    }else{
        return redirect()->back()->with('error', 'Please select after current date to apply sick leave!');

    }
        //end
        ////VIEW PAGE RETURN
        return view('Employee.vacation_leave');
    }

    public function vacation_status_deactive($id)
    {
        $vacation_status_deactive=VacationLeave::find($id);
        $vacation_status_deactive->status=0;
        $vacation_status_deactive->save();

         ///sick leave update emp start
         $update_emp_vacation=User::find($vacation_status_deactive->user_id);
         if($update_emp_vacation->annual_vacation_leave < 10 && $update_emp_vacation->annual_vacation_leave >= 0)
         {
             //dd($update_emp_sick->annual_sick_leave);
              $update_emp_vacation->annual_vacation_leave=$update_emp_vacation->annual_vacation_leave + $vacation_status_deactive->allow_leave;
             $update_emp_vacation->save();
         }
                 ///attendence inserted start
        $atten_check=Attendence::where('user_id',$vacation_status_deactive->user_id)->where('date',$vacation_status_deactive->leave_date_end)->first();
        if($atten_check == null)
        {
        $start_time=date('H:i:s');
        $atten=new Attendence();
        $atten->user_id=$vacation_status_deactive->user_id;
        $atten->start_time='00:00:00';
        $atten->date=$vacation_status_deactive->leave_date_end;
        $atten->work_time='08:00:00';
        $atten->overtime='00:00:00';
        $atten->end_time=0;
        $atten->total_hours=0;
        $atten->work_and_overtime=0;
        $atten->status=0;
        $atten->save();
        }
        ///attendence inserted end
        // dd($emp_get->annual_sick_leave);
         ///sick leave update emp end
        return redirect()->back()->with('error','Sick Leave successfully Deactive! remaning leave :'.$update_emp_vacation->annual_vacation_leave.' Days');

    }
    public function vacation_status_active($id)
    {
        $vacation_status_active=VacationLeave::find($id);
        $vacation_status_active->status=1;
        $vacation_status_active->save();
       // $get_sick_leavet=SickLeave::
        ///sick leave update emp start
        $update_emp_vacation=User::find($vacation_status_active->user_id);

        if($update_emp_vacation->annual_vacation_leave <= 10 && $update_emp_vacation->annual_vacation_leave >= 0)
        {
            //dd( $update_emp_vacation->annual_vacation_leave - $vacation_status_active->allow_leave);

            //dd($update_emp_sick->annual_sick_leave);
             $update_emp_vacation->annual_vacation_leave=$update_emp_vacation->annual_vacation_leave - $vacation_status_active->allow_leave;
            $update_emp_vacation->save();
        }
        //dd($emp_get->annual_sick_leave);
        ///sick leave update emp end
        ///attendence inserted start
        $atten_check=Attendence::where('user_id',$vacation_status_active->user_id)->where('date',$vacation_status_active->leave_date_end)->first();
        if($atten_check == null)
        {
        $start_time=date('H:i:s');
        $atten=new Attendence();
        $atten->user_id=$vacation_status_active->user_id;
        $atten->start_time='00:00:00';
        $atten->date=$vacation_status_active->leave_date_end;
        $atten->work_time='08:00:00';
        $atten->overtime='00:00:00';
        $atten->end_time=0;
        $atten->total_hours=0;
        $atten->work_and_overtime=0;
        $atten->status=0;
        $atten->save();
        }
        ///attendence inserted end
        return redirect()->back()->with('success','Vacation Leave successfully Approved! remaning leave :'.$update_emp_vacation->annual_vacation_leave.' Days');

    }
    public function  delete_vacation($id)
    {
        $delete_vacation=VacationLeave::find($id);
        $delete_vacation->delete();

        return redirect()->back()->with('error','Vacation Leave successfully Deleted!');
    }
    ////////////////////////////vacation leave function end///////////////////////////
}
