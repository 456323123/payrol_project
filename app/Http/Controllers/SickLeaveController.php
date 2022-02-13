<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SickLeave;
use Illuminate\Http\Request;
use App\Models\VacationLeave;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SickLeaveController extends Controller
{
    public function sick_leave()
    {
        return view('Employee.sick_leave');
    }

    public function insert_sick_leave(Request $request)
    {
        // get leave data start
        $title = $request->title;
        $leave_date = $request->leave_date;
        $description = $request->description;
        // get leave data end

        // get user join date start
        $user_id = Auth::user()->id;
        $emp_join_date_get = User::where('user_role', 'user')->where('id', $user_id)->first();
        $emp_join_date = $emp_join_date_get->join_date;
        //dd($emp_join_date);
        $allow_emp_sick_leave_annual = $emp_join_date_get->annual_sick_leave;
        // get user join date end

        //sick leave data get emp start
        $c_year = date('Y');
        $emp_sick_leave_get = SickLeave::where('user_id', $user_id)->where('c_year', $c_year)->orderby('id', 'DESC')->first();
        //sick leave data get emp end

        //sick leave count emp start
        $emp_sick_leave_count = SickLeave::where('user_id', $user_id)->where('c_year', $c_year)->count();
        //sick leave count emp end
        //dd($emp_sick_leave_count);


        //dd($allow_emp_sick_leave_annual,$emp_sick_leave_count);

        //calculate joining emp date to sick leave date start
        $to = Carbon::createFromFormat('Y-m-d', $emp_join_date);
        $from = Carbon::createFromFormat('Y-m-d', $leave_date);
        $diff_in_days = $to->diffInDays($from);
        //calculate joining emp date to sick leave date end
        $c_date = date('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $leave_date);
        $date2 = Carbon::createFromFormat('Y-m-d', $c_date);

        $result = $date1->gte($date2);


        ///check curren and after date
        if ($date1->gte($date2)) {
            //condition one  apply Employee can only submit sick day after 110 days worked
            //start
            if ($diff_in_days > 110) {
                ////check emp first leave exist or not start
                if ($emp_sick_leave_get != null) {
                    $emp_leave_date = $emp_sick_leave_get->leave_date;
                    //calculate first sick date emp to sick leave date start
                    $to_sick = Carbon::createFromFormat('Y-m-d', $emp_leave_date);
                    $from_sick = Carbon::createFromFormat('Y-m-d', $leave_date);
                    $diff_in_days_sick = $to_sick->diffInDays($from_sick);
                    //calculate first sick date emp to sick leave date end

                    //annual leave allow and check pennding leave
                    if ($emp_sick_leave_count <= $allow_emp_sick_leave_annual && $emp_sick_leave_count >= 1) {
                        ////condition two Employee accumulate 1 sick day every 22 days worked start
                        if ($diff_in_days_sick > 22) {
                            //insert first after 22 days sick leave
                            $insert_sick_leave = new SickLeave();
                            $insert_sick_leave->user_id = $user_id;
                            $insert_sick_leave->title = $title;
                            $insert_sick_leave->leave_date = $leave_date;
                            $insert_sick_leave->description = $description;
                            $insert_sick_leave->c_year = $c_year;
                            $insert_sick_leave->status = 0;
                            $insert_sick_leave->save();
                            return redirect()->back()->with('success', 'Your Sick leave apply Successfully!');
                        } else {
                            return redirect()->back()->with('error', 'You can apply sick leave after ' . 22 - $diff_in_days_sick . ' days !');
                            //return redirect()->back()->with('error', 'You can apply sick leave after 22 days !');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Your Allow Leave Completed do not more sick leave apply!');
                    }
                    ////condition two Employee accumulate 1 sick day every 22 days worked end

                } else {
                    //insert first before 22 days sick leave
                    $insert_sick_leave = new SickLeave();
                    $insert_sick_leave->user_id = $user_id;
                    $insert_sick_leave->title = $title;
                    $insert_sick_leave->leave_date = $leave_date;
                    $insert_sick_leave->description = $description;
                    $insert_sick_leave->c_year = $c_year;
                    $insert_sick_leave->status = 0;
                    $insert_sick_leave->save();
                    return redirect()->back()->with('success', 'Your Sick leave apply Successfully!');
                }
                ////check emp first leave exist or not start
            } else {
                ////new emp message return

                return redirect()->back()->with('error', 'You are New Emp to joining date: ' . $emp_join_date . '! remaining days apply sick leave : ' . '110' - $diff_in_days . ' days !');
                // return redirect()->back()->with('error', 'You are New Emp to joining date:' );
            }
        } else {
            return redirect()->back()->with('error', 'Please select after current date to apply sick leave!');
        }
        //end
        ////VIEW PAGE RETURN
        return view('Employee.sick_leave');
    }


    ///////////////////////Vacation  function////////////////////////////////

    public function vacation_leave()
    {
        return view('Employee.vacation_leave');
    }

    public function insert_vacation_leave(Request $request)
    {
        // get leave data start
        $title = $request->title;
        $leave_date_start = $request->leave_date_start;
        $leave_date_end = $request->leave_date_end;
        $description = $request->description;
        // get leave data end
        //dd($request->input());

        ///vacation holiday days start
        $to_vacation_start = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_start);
        $from_vacation_end = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_end);
        $diff_in_days_vacation_diff = $to_vacation_start->diffInDays($from_vacation_end);
        //if one day include
        $diff_in_days_vacation = $diff_in_days_vacation_diff + 1;
        //dd($diff_in_days_vacation);
        ///vacation holiday days end


        // get user join date start
        $user_id = Auth::user()->id;
        $emp_join_date_get = User::where('user_role', 'user')->where('id', $user_id)->first();
        $emp_join_date = $emp_join_date_get->join_date;
        $annual_vacation_leave = $emp_join_date_get->annual_vacation_leave;

        // get user join date end

        //Vacation leave data get emp start
        $c_year = date('Y');
        $emp_vacation_leave_get = VacationLeave::where('user_id', $user_id)->where('c_year', $c_year)->orderby('id', 'DESC')->first();
        //Vacation leave data get emp end

        //Vacation leave count emp start
        $emp_vacation_leave_count = VacationLeave::where('user_id', $user_id)->where('c_year', $c_year)->sum('allow_leave');
        //Vacation leave count emp end


        //dd($emp_vacation_leave_count);

        //calculate joining emp date to sick leave date start
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_join_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_start);
        $diff_in_days = $to->diffInDays($from);
        //calculate joining emp date to sick leave date end

        $c_date = date('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $leave_date_start);
        $date2 = Carbon::createFromFormat('Y-m-d', $c_date);

        $result = $date1->gte($date2);
        //         if($emp_vacation_leave_count < $annual_vacation_leave && $diff_in_days_vacation < $annual_vacation_leave)
        //         {
        // dd(1);
        //         }else{
        //             dd( $annual_vacation_leave,$diff_in_days_vacation);
        //         }

        ///check curren and after date
        if ($date1->gte($date2)) {
            //annual leave allow and check pennding leave
            if ($emp_vacation_leave_count < $annual_vacation_leave && $diff_in_days_vacation <= $annual_vacation_leave) {
                //condition one  apply Employee can only submit sick day after 110 days worked
                //start
                if ($diff_in_days > 220) {

                    ////check emp first leave exist or not start

                    if ($emp_vacation_leave_get != null) {
                        $emp_leave_date = $emp_vacation_leave_get->leave_date_start;

                        //calculate first sick date emp to sick leave date start
                        $to_sick = \Carbon\Carbon::createFromFormat('Y-m-d', $emp_leave_date);
                        $from_sick = \Carbon\Carbon::createFromFormat('Y-m-d', $leave_date_end);
                        $diff_in_days_vacation = $to_sick->diffInDays($from_sick);
                        //calculate first sick date emp to sick leave date end

                        ////condition two Employee accumulate 1 sick day every 22 days worked start
                        if ($diff_in_days_vacation > 22) {
                            //insert first after 22 days sick leave
                            $insert_vacation_leave = new VacationLeave();
                            $insert_vacation_leave->user_id = $user_id;
                            $insert_vacation_leave->title = $title;
                            $insert_vacation_leave->leave_date_start = $leave_date_start;
                            $insert_vacation_leave->leave_date_end = $leave_date_end;
                            $insert_vacation_leave->description = $description;
                            $insert_vacation_leave->c_year = $c_year;
                            $insert_vacation_leave->allow_leave = $diff_in_days_vacation;
                            $insert_vacation_leave->status = 0;
                            $insert_vacation_leave->save();
                            return redirect()->back()->with('success', 'Your Vacation leave apply Successfully!');
                        } else {
                            return redirect()->back()->with('error', 'Your can apply Vacation leave after ' . $diff_in_days_vacation . ' days !');
                            // return redirect()->back()->with('error', 'Your can apply Vacation leave after some days !');
                        }

                        ////condition two Employee accumulate 1 sick day every 22 days worked end

                    } else {

                        //insert first before 22 days sick leave
                        $insert_vacation_leave = new VacationLeave();
                        $insert_vacation_leave->user_id = $user_id;
                        $insert_vacation_leave->title = $title;
                        $insert_vacation_leave->leave_date_start = $leave_date_start;
                        $insert_vacation_leave->leave_date_end = $leave_date_end;
                        $insert_vacation_leave->description = $description;
                        $insert_vacation_leave->c_year = $c_year;
                        $insert_vacation_leave->allow_leave = $diff_in_days_vacation;
                        $insert_vacation_leave->status = 0;
                        $insert_vacation_leave->save();
                        return redirect()->back()->with('success', 'Your Vacation leave apply Successfully!');
                    }
                    ////check emp first leave exist or not start
                } else {
                    ////new emp message return


                    return redirect()->back()->with('error', 'Your New Emp to joined ' . $diff_in_days . ' days !');
                }
            } else {
                return redirect()->back()->with('error', 'You are selected vacation days ' . $diff_in_days_vacation . ' ! but remaining leave -' . $annual_vacation_leave . ' days');
            }
        } else {
            return redirect()->back()->with('error', 'Please select after current date to apply sick Vacation Leave!');
        }
        //end
        ////VIEW PAGE RETURN
        return view('Employee.vacation_leave');
    }
}
