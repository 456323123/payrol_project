<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Mail\TestMail;
use App\Models\Proceed;
use App\Models\Deduction;
use App\Models\Threshold;
use App\Models\Accumulate;

use App\Models\Attendence;
use App\Models\Department;
use App\Models\Permission;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        return view('Admin.dashboard');
    }
    public function Adminlogout()
    {
             Auth::logout();

        return redirect('/login');
    }


public function AdmincreateUser(Request $request)
{
    // dd($emp);
    $data=$request->all();


        $user = User::create(
            [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'user_role' => $request->user_role,
                    'user_password'=>$request->password,
                    'password'=>Hash::make($request->password),
                ]
        );
       
        unset($data['_token']);
        unset($data['photo']);
        unset($data['first_name']);
        unset($data['last_name']);
        unset($data['gender']);
        unset($data['user_role']);
        unset($data['email']);
        unset($data['password']);

        foreach ($data as $key => $value) {
            if (isset($value['view']) ? $value['view'] : '') {
                $view=$value['view'];
            } else {
                $view=0;
            }

            if (isset($value['edit']) ? $value['edit'] : '') {
                $edit=$value['edit'];
            } else {
                $edit=0;
            }

            if (isset($value['full']) ? $value['full'] : '') {
                $full=$value['full'];
            } else {
                $full=0;
            }
            $permission=Permission::where('user_id', $user->id)->insert(['user_id'=>$user->id,'module'=>$key,
'view_access'=>$view,'edit_access'=>$edit,'full_access'=>$full]);
        }
return redirect()->back()->with('success','Successfull Add user Permission');

    
}

    public function UpdateRoles(Request $request,$id){
$update_role=Role::find($id);
$update_role->name=$request->role_name_update;
$update_role->save();
return redirect()->back()->with('message','Successfull Update user Role');

}
public function starttime(Request $request)
    {
        //   $java=$request->time_get;
        $user_id = $request->user_id;
        $c_date = date('Y-m-d');
        // $c_time='08:14:00 AM';

        $c_time = date('h:i:s A');
        //dd($c_date, $c_time);
        $start_time = date('h:i:s A', strtotime($c_time));
        $user = User::select('id', 'add_attendance')->where('id', $user_id)->first();
        $user->add_attendance = 1;
        $user->save();

        $check_atten_one_time = Attendence::where('user_id', $user_id)->where('date', $c_date)->first();
        if (!isset($check_atten_one_time)) {
            $atten = new Attendence();
            $atten->user_id = $user_id;
            $atten->start_time = $start_time;
            $atten->date = $c_date;
            $atten->work_time = '00:00:00';
            $atten->overtime = '00:00:00';
            $atten->status = 0;
            $atten->save();

            return redirect()->back()->with('message', 'Your attendance  successfully!');
        } else {
            return redirect()->back()->with('error', 'Your attendance Already Done!');
        }
    }

    public function user_attendance_history()
    {
        $user_id = Auth::user()->id;
        $atten_emp['emp_atten'] = Attendence::where('user_id', $user_id)->orderBy('date', 'DESC')->get();
        return view('Admin.userattendancedata', $atten_emp);
    }

    public function endtime(Request $request)
    {
        // $request->validate([
        //     'start_time' => 'required',
        //     'end_time' => 'required'

        // ]);
        // $user_id=Auth::user()->id;
        $user_id = $request->user_id;
        $atten_id = $request->atten_id;
        //    $startTime = Carbon::parse('01:34:23');
        //     $endTime = Carbon::parse('10:14:00');

        //     $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S')." Minutes";
        //     dd($totalDuration);
        $In_time_update = Attendence::find($atten_id);
        $todayDate = Carbon::now()->format('d-m-Y');
        // $c_time='05:4:10 PM';
        $c_date = date('Y-m-d');
        $c_time = date('h:i:s A');
        $end_timee = date('h:i:s A', strtotime($c_time));

        $startTime = Carbon::parse($In_time_update->start_time);
        $endTime = Carbon::parse($c_time);

        $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S');
        $d = explode(':', $totalDuration);
        $simplework = ($d[0] * 3600) + ($d[1] * 60) + $d[2];

        // dd($simplework);
        // $sd=explode(':',$totalDuration);
        // $h=$sd[0];
        // $m=$sd[1];
        // $s=$sd[2];

        $end_time = date('h:i:s A', strtotime($c_time));

        $total_time_seconds = Carbon::parse($In_time_update->start_time)->diffInSeconds($end_time);

        //$hours =gmdate("H:i", $total_time_seconds);
        //dd($hours);
        $total_seconds = $total_time_seconds - 28800;
        $add_overtime_after_approve = $total_time_seconds - $total_seconds;
        $after = gmdate("H:i:s", $add_overtime_after_approve);
        //dd($after,$total_time_seconds,$add_overtime_after_approve);

        $overtime = gmdate("H:i:s", $total_seconds);
        // dd($total_hours,$total_minutes,$total_seconds);
        $check_atten_one_time = Attendence::where('user_id', $user_id)->where('date', $c_date)->first();
        if (isset($check_atten_one_time)) {
            if ($total_time_seconds >= 28800) {
                $In_time_update->user_id = $user_id;
                $In_time_update->end_time = $end_time;
                $In_time_update->date = $c_date;
                $In_time_update->work_time = $after;
                $In_time_update->overtime = $overtime;
                $In_time_update->total_hours = $total_time_seconds;
                $In_time_update->work_and_overtime = $add_overtime_after_approve;
                $In_time_update->status = 0;
                $In_time_update->save();
            } else {
                $In_time_update->user_id = $user_id;
                $In_time_update->end_time = $end_time;
                $In_time_update->date = $c_date;
                $In_time_update->work_time = $totalDuration;
                $In_time_update->overtime = '00:00:00';
                $In_time_update->total_hours = $total_time_seconds;
                $In_time_update->work_and_overtime = $simplework;
                $In_time_update->status = 0;
                $In_time_update->save();
            }
            return redirect()->back()->with('message', 'Your attendance successfully!');
        } else {
            return redirect()->back()->with('error', 'Your attendance Already Done!');
        }

        // dd( $total_time_hours,$end_time);
    }

public function clock()
    {
        $user_id = Auth::user()->id;
        $c_date = date('Y-m-d');
        $user_atten['start_time'] = Attendence::where('user_id', $user_id)->where('date', $c_date)->first();


        return view('Admin.clock', $user_atten);
    }
    public function Adminpermissionupdate(Request $request,$id)
{
// dd($emp);



                     $data=$request->all();
    $employee = User::find($id);
if(auth::user()->user_role=='super admin' || auth::user()->user_role=='admin'){
if (1==$id && auth::user()->user_role=='admin') {
                return redirect()->back()->with('error', 'Your Are not allow the super admin Permision ');

}
        $user=User::select('id', 'password','user_password', 'first_name', 'last_name', 'email', 'photo', 'user_role', 'dob', )->where('id', $id)->first();
        $adminroles=Permission::where('user_id', $id)->get()->toarray();
        if ($request->isMethod('post')) {
            if ($request->photo != '') {
                $path = public_path().'/uploads/employees/';
                //code for remove old file
                if ($employee->photo != ''  && $employee->photo != null) {
                    $file_old = $path.$employee->photo;
                    unlink($file_old);
                }
                //upload new file
                $file = $request->photo;
                $filename = $file->getClientOriginalName();
                $file->move($path, $filename);
                //for update in table
                $employee->update(['photo' => $filename]);
            }
            $employee->update([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'user_role' => $request->user_role,
        ]);
        if($employee->user_password==$request->user_password)
{   $employee->password=$employee->password;
    $employee->user_password=$employee->user_password;
    $employee->save();
}
else{
    $employee->password=Hash::make($request->password);
    $employee->user_password=$request->password;
    $employee->save();
}
            unset($data['_token']);
            unset($data['photo']);

            unset($data['first_name']);
            unset($data['last_name']);
            unset($data['gender']);
            unset($data['user_role']);
            unset($data['email']);
            unset($data['password']);


            Permission::where('user_id', $id)->delete();
            foreach ($data as $key => $value) {
                if (isset($value['view']) ? $value['view'] : '') {
                    $view=$value['view'];
                } else {
                    $view=0;
                }

                if (isset($value['edit']) ? $value['edit'] : '') {
                    $edit=$value['edit'];
                } else {
                    $edit=0;
                }

                if (isset($value['full']) ? $value['full'] : '') {
                    $full=$value['full'];
                } else {
                    $full=0;
                }
                $permission=Permission::where('user_id', $id)->insert(['user_id'=>$id,'module'=>$key,
'view_access'=>$view,'edit_access'=>$edit,'full_access'=>$full]);
            }

            return redirect()->back()->with('message', 'Successful Updated User Permission');
        }
              $simple=Role::where('name','!=','super admin')->get();
              $superadmin=Role::get();

            return view('Admin.admin_permistion', compact('adminroles', 'user','simple','superadmin'));
    } 
    
    else {
                return redirect()->back()->with('error', 'This Feature are Restricted!');
        
    }
}


    public function AddAdmin(){
                    // $users=User::where('user_role','super_admin')->first();

if(auth::user()->user_role=='super admin' || auth::user()->user_role=='admin'){
            $users=User::get();

                        return view('Admin.addadmin', compact('users'));

        } else {
        
            return redirect()->back()->with('error', 'This Feature are Restricted!');
        }
    }

   public function AddRoles()
   {
      $roles=Role::get();
        if (request()->isMethod('post')) {
                        $Add_role=new Role();
            $Add_role->name=request()->role_name;
            $Add_role->save();
         return redirect()->back()->with('message', 'Role are Add Succesfully!');

            
        }
     return view('Admin.addroles',get_defined_vars());

   }
    public function department()
    {
        $department['view_department'] = Department::get();
         $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'department'])->count();
         if ($permision==0) {
             return redirect('/admin/dashboard')->with('error', 'This Feature is restricted For You !');
         }
         else{
             $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'department'])->first()->toarray();
             // dd($Employepermision); die;
         }
        return view('Admin.department', $department)->with(compact('Employepermision'));
    }
    public function updateThreshold(Request $request)
    {
        $htreshold = Threshold::get()->toArray();
        $count = Accumulate::get()->count();
        $currentThreshold = $htreshold[0]['amount'];
        if ($count == 0) {
            $startDate = '2021-12-21';
            $min = 13;
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $min . ' days'));
            $addVal = new Accumulate();
            $addVal->payroll_no = $count += 1;
            $addVal->start_date = $startDate;
            $addVal->end_date = $endDate;
            $addVal->accumalative_payrol_value = $currentThreshold;
            $addVal->save();
        } else {
            $data = Accumulate::get()->last()->toArray();
            $startDate = $data['end_date'];
            $datedata = $data['end_date'];
            $lastThreshold = $data['accumalative_payrol_value'];
            $current = Date('Y-m-d');
            // dd($current, $datedata);
            $total_time_seconds = Carbon::parse($current)->diffInDays($datedata);
            $min = 1;
            $startDate = date('Y-m-d', strtotime($startDate . ' + ' . $min . ' days'));
            $date = 14;
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $date . ' days'));

            //dd($total_time_seconds);
            //dd($total_time_seconds);
            if ($total_time_seconds == 14) {
                $addVal = new Accumulate();
                $addVal->payroll_no = $count += 1;
                $addVal->start_date = $startDate;
                $addVal->end_date = $endDate;
                $addVal->accumalative_payrol_value = $currentThreshold + $lastThreshold;
                $addVal->save();
            }
        }

        return redirect()->back();
    }
    public function  add_department(Request $request)
    {
        $add_Department = new Department();
        $add_Department->department = $request->department_name;
        $add_Department->status = 0;
        $add_Department->save();

        return redirect()->back()->with('message', 'Department successfully Addedd!');
    }
    public function  edit_department(Request $request, $id)
    {
        $edit_department = Department::find($id);
        $edit_department->department = $request->department_name;
        $edit_department->save();

        return redirect()->back()->with('message', 'Department successfully Updated!');
    }
    public function depart_status_deactive($id)
    {
        
        $depart_status_deactive = Department::find($id);
        $depart_status_deactive->status = 0;
        $depart_status_deactive->save();
        return redirect()->back()->with('message', 'Department successfully Deactive!');
    }
    public function depart_status_active($id)
    {
        $depart_status_active = Department::find($id);
        $depart_status_active->status = 1;
        $depart_status_active->save();
        return redirect()->back()->with('message', 'Department successfully Active!');
    }
    public function  delete_department(Request $request, $id)
    {
        $delete_department = Department::find($id);
        $delete_department->delete();

        return redirect()->back()->with('error', 'Department successfully Deleted!');
    }


    public function attendance_history()
    {
        $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'attendance'])->count();
         if ($permision==0) {
             return redirect('/admin/dashboard')->with('error', 'This Feature is restricted For You !');
         }
         else{
             $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'attendance'])->first()->toarray();
             // dd($Employepermision); die;
         }
        $atten_emp['emp_atten'] = DB::table('attendences')
            ->leftjoin('users', 'users.id', '=', 'attendences.user_id')
            ->select('users.first_name', 'attendences.*')->orderBy('date', 'DESC')->get();
        //  dd($atten_emp);
        //dd($atten_emp['emp_atten']);
        return view('Admin.attendance_history', $atten_emp)->with(compact('Employepermision'));
    }
    public function attent_status_disapprove($id)
    {
        $attent_status_disapprove = Attendence::find($id);
        $d = explode(':', $attent_status_disapprove->work_time);
        $simplework = ($d[0] * 3600) + ($d[1] * 60) + $d[2];

        $attent_status_disapprove->status = 0;
        $attent_status_disapprove->work_and_overtime = $simplework;
        $attent_status_disapprove->update();
        return redirect()->back()->with('message', 'Attendance successfully Disapproved!');
    }
    public function processedPayroll()
    {
        $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'payrol'])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
         else{
                      $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'payrol'])->first()->toarray();
// dd($Employepermision); die;

         }
        
        $processPayroll = Proceed::get();
        return view('Admin.processedPayroll', get_defined_vars());
    }
    public function attent_status_approve($id)
    {
        $attent_status_disapprove = Attendence::find($id);
        $d = explode(':', $attent_status_disapprove->work_time);
        $simplework = ($d[0] * 3600) + ($d[1] * 60) + $d[2];

        $o = explode(':', $attent_status_disapprove->overtime);
        $simpleover = ($o[0] * 3600) + ($o[1] * 60) + $o[2];
        $attent_status_disapprove->status = 1;
        $attent_status_disapprove->work_and_overtime = $simplework + $simpleover;
        $attent_status_disapprove->update();
        return redirect()->back()->with('success', 'Attendance successfully Approved!');
    }
    public function employees()
    {

        $employees = User::where('user_role', 'Employee')->get();
         //admin restriction
         $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'employes'])->count();
         if ($permision==0) {
             return redirect('/admin/dashboard')->with('error', 'This Feature is restricted For You !');
         }
         else{
                      $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'employes'])->first()->toarray();
// dd($Employepermision); die;

         }
                 return view('Admin.employee.index', compact('employees','Employepermision'));

    }

    public function employeeCreate()
    {
        return view('Admin.employee.create');
    }

    public function employeeStore(Request $request)
    {
        // dd($request->all());

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return back()->with('error', 'This user email already exists.');
        } else {
            $user = User::create(
                [
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'password' => Hash::make($request->password),
                    'residence_address' => $request->residence_address,
                    'employment_status' => $request->employment_status,
                    'hire_date' => $request->hire_date,
                    'employee_id' => $request->employee_id,
                    'regular_hours' => $request->regular_hours,
                    'hourly_rate' => $request->hourly_rate,
                    'ot_rate' => $request->ot_rate,
                    'department' => $request->department,
                    'statutory_deductions' => $request->statutory_deductions,
                    'attn_inc_rate' => $request->attn_inc_rate,
                    'phone_number' => $request->phone_number,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_number' => $request->emergency_contact_number,
                    'education' => $request->education,
                    'experience' => $request->experience,
                    'id_type' => $request->id_type,
                    'id_number' => $request->id_number,
                    'bank' => $request->bank,
                    'account_number' => $request->account_number,
                    'branch' => $request->branch,
                    'bank_photo' => 'kkk',
                    'trn' => $request->trn,
                    'nis' => $request->nis,
                    'user_role' => $request->user_role,
                ]
            );
            if (request()->hasfile('photo')) {
                $image = request()->file('photo');
                $filename = time() . '.' . $image->getClientOriginalName();
                $movedFile = $image->move('uploads/employees', $filename);
                $user->photo = $filename;
                $user->save();
            } else {
                $user->save();
            }
            $details = [
                'title' => 'Email and Password',
                'body' => 'Hi...' . $request->first_name . 'Your Email address : ' . $request->email . '' . 'and Your password : ->  ' . $request->password
            ];

            Mail::to($request->email)->send(new TestMail($details));

            // $user = User::where('email', '_mainaccount@briway.uk')->first();

            // \Mail::to($user->email)->send(new TestMail($details));
            // $admin = [
            //     'title' => 'user  Email and Password',
            //     'body' =>'Hi...'.$request->first_name.'Your Email address : '.$request->email.''.'and Your password : ->  '. $request->password
            // ];


            return redirect()->route('admin.employees')->with('message', 'Employee data saved successfully.');
        }
    }


    public function employeeEdit($id)
    {
        $permision =Permission::where('user_id',auth::user()->id)->where('module','employes')->first()->toarray();
         if ($permision['full_access']==1 || $permision['edit_access']==1 ) {
        
        $emp = User::find($id);

        return view('Admin.employee.edit', compact('emp')); 
            }
         else{
    // dd( $permision);
             return redirect('/admin/dashboard')->with('error', 'This Feature is restricted For You !');
                    // dd($Employepermision); die;
         }
    }


    public function employeeView($id)
    {
        $emp = User::find($id);

        return view('Admin.employee.view', compact('emp'));
    }

    public function employeeUpdate(Request $request, $id)
    {
        $emp = User::find($id);

        $emp->update([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'residence_address' => $request->residence_address,
            'employment_status' => $request->employment_status,
            'hire_date' => $request->hire_date,
            'employee_id' => $request->employee_id,
            'regular_hours' => $request->regular_hours,
            'hourly_rate' => $request->hourly_rate,
            'ot_rate' => $request->ot_rate,
            'department' => $request->department,
            'statutory_deductions' => $request->statutory_deductions,
            'attn_inc_rate' => $request->attn_inc_rate,
            'phone_number' => $request->phone_number,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_number' => $request->emergency_contact_number,
            'education' => $request->education,
            'experience' => $request->experience,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'bank' => $request->bank,
            'account_number' => $request->account_number,
            'branch' => $request->branch,
            'bank_photo' => 'null',
            'trn' => $request->trn,
            'nis' => $request->nis,
            'user_role' => $request->user_role,
        ]);
        if (request()->hasfile('photo')) {
            $image = request()->file('photo');
            $filename = time() . '.' . $image->getClientOriginalName();
            $movedFile = $image->move('uploads/employees', $filename);
            $emp->photo = $filename;
            $emp->save();
        } else {
            $emp->save();
        }
        return redirect()->route('admin.employees')->with('message', 'Employee updated succeddfuly.');
    }



    public function employeeShow($id)
    {
        $emp = User::find($id);
        return view('Admin.employee.show', compact('emp'));
    }
    public function update_profile(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if (isset($request->photo)) {
            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName();

            $user->update([
                'photo' => $imageName,
            ]);
            $path = $image->move(public_path('uploads/employees'), $imageName);
        }



        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

        ]);

        if (isset($request->c_password)) {
            $request->validate([
                'new_password' => 'required|min:8',
                'confirm_password' => 'required_with:password|same:new_password|min:8'

            ]);
            if (Hash::check($request->c_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                $msg = "Your profile has been updated";
                $request->session()->flash('message', $msg);
                return redirect('/profile');
            } else {
                $msg = "Your Password does't match";
                $request->session()->flash('error', $msg);
                return redirect('/profile');
            }
        } else {
            $msg = "Your profile has been updated";
            $request->session()->flash('message', $msg);
            return redirect('/profile');
        }
    }
    public function threshold(Request $request)
    {
         $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'thresold'])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
         else{
             $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'thresold'])->first()->toarray();
             // dd($Employepermision); die;
         }
        $threshold['threshold'] = Threshold::all();
        return view('Admin/threshold', $threshold)->with(compact('Employepermision'));
    }
    public function add_deduction(Request $request)
    {

        $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'deduction', 'full_access'=>1])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
         
        return view('admin/add_deduction');
    }
    public function add_threshold(Request $request)
    {
        
         $permision =Permission::where('user_id',auth::user()->id)->where('module','thresold')->first()->toarray();
         if ($permision['full_access']==1 ) {
           if($request->ismethod('post')){
       
        $request->validate([
            'year' => 'required',
            'cycle' => 'required',
            'amount' => 'required',
            'days' => 'required',
            'paid_by' => 'required'

        ]);

        //Threshold data save start
        $threshold = new Threshold();
        $threshold->year = $request->year;
        $threshold->cycle = $request->cycle;
        $threshold->amount = $request->amount;
        $threshold->days = $request->days;
        $threshold->paid_by = $request->paid_by;
        $threshold->save();
                     return redirect('admin/threshold')->with('message', 'Thresold Added Successfully!');

        }
         
        }

        else{
    // dd( $permision);
             return back()->with('error', 'This Feature is restricted For You !');
                    // dd($Employepermision); die;
         }
        return view('admin.add_threshold');
            
        
    }
    public function edit_threshold(Request $request, $id)
    {
        $edit_threshold['edit_threshold'] = Threshold::find($id);

        $permision =Permission::where('user_id',auth::user()->id)->where('module','thresold')->first()->toarray();
         if ($permision['full_access']==1 || $permision['edit_access']==1 ) {
        
        $emp = User::find($id);

        return view('Admin/edit_threshold', $edit_threshold);
            }
         else{
    // dd( $permision);
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
                    // dd($Employepermision); die;
         }
    }
    public function edit_deduction(Request $request, $id)
    {
        $edit_deduction['edit_deduction'] = Deduction::find($id);
         $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'deduction','edit_access'=>1])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
        return view('Admin/edit_deduction', $edit_deduction);
    }
    public function update_deduction(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'nis_fix_value' => 'required',
        //     'percentage_value' => 'required',
        //     'type_deduction' => 'required'
        // ]);
        
        $deduction = Deduction::find($id);
        $deduction->name = $request->name;
        $deduction->nis_fix_value = $request->percentage;
        $deduction->nis = $request->Nis;
        $deduction->percentage_value = $request->type_value;
        $deduction->type_deduction = $request->type;
        $deduction->save();
        session()->flash('message', 'Deduction/Contribution successfully Updated!');
        return redirect('admin/deduction');
    }

    public function update_threshold(Request $request, $id)
    {
        $request->validate([
            'year' => 'required',
            'cycle' => 'required',
            'amount' => 'required',
            'days' => 'required',
            'paid_by' => 'required'

        ]);
        //Threshold data save start
        $threshold = Threshold::find($id);
        $threshold->year = $request->year;
        $threshold->cycle = $request->cycle;
        $threshold->amount = $request->amount;
        $threshold->days = $request->days;
        $threshold->paid_by = $request->paid_by;
        $threshold->save();
        session()->flash('message', 'Threshold successfully Updated!');
        return redirect('admin/threshold');
    }
    public function delete_threshold(Request $request, $id)
    {
        $threshold = Threshold::find($id);
        $threshold->delete();
        session()->flash('error', 'Threshold successfully Deleted!');
        return redirect('admin/threshold');
    }



    public function deduction()
    {
        $get_deduction = Deduction::all();
            $permision =Permission::where(['user_id'=>auth::user()->id,'module'=>'deduction'])->count();
         if ($permision==0) {
             return redirect()->back()->with('error', 'This Feature is restricted For You !');
         }
         else{
             $Employepermision =Permission::where(['user_id'=>auth::user()->id,'module'=>'deduction'])->first()->toarray();
             // dd($Employepermision); die;
         }
        return view('Admin.deduction', get_defined_vars());
    }



    public function create_deduction(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'percentage_value' => 'required',
        //     'nis_fix_value' => 'required',
        //     'type_deduction' => 'required'

        //     ]);
        //Threshold data save start
        $deduction = Deduction::create([
            'name' => $request->name,
            'percentage_value' => $request->type_value,
            'nis_fix_value' => $request->percentage,
            'nis' => $request->Nis,
            'type_deduction' => $request->type

        ]);

        return redirect()->back()->with('message', 'payrol Deduction successfully Add');
    }   
    public function admin_attendance(Request $request)
    {
        // dd($request->start_time, $request->end_time,$request->date);
        //    $todayDate = Carbon::now()->format('d-m-Y');
        // // $c_time='05:4:10 PM';
        // $c_date = date('Y-m-d');
        // $c_time = date('h:i:s A');

        $start_time = date('h:i:s A', strtotime($request->start_time));
        $end_time = date('h:i:s A', strtotime($request->end_time));


        $startTime = Carbon::parse($start_time);
        $endTime = Carbon::parse($end_time);

        $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S');
        // dd($totalDuration);
    $d = explode(':', $totalDuration);
        $simplework = ($d[0] * 3600) + ($d[1] * 60) + $d[2];
        $total_time_seconds = Carbon::parse($request->start_time)->diffInSeconds($endTime);


        $total_seconds = $total_time_seconds - 28800;
        $add_overtime_after_approve = $total_time_seconds - $total_seconds;
        $after = gmdate("H:i:s", $add_overtime_after_approve);
           $overtime = gmdate("H:i:s", $total_seconds);
 $In_time_update = new Attendence();

    $check_atten_one_time = Attendence::where('user_id', $request->user)->where('date',$request->date)->first();
        if ($check_atten_one_time==null) {
            if ($total_time_seconds >= 28800) {
                $In_time_update->user_id = $request->user;
                 $In_time_update->start_time = $start_time;
                $In_time_update->end_time = $end_time;
                $In_time_update->date = $request->date;
                $In_time_update->work_time = $after;
                $In_time_update->overtime = $overtime;
                $In_time_update->total_hours = $total_time_seconds;
                $In_time_update->work_and_overtime = $add_overtime_after_approve;
                $In_time_update->status = 0;
                $In_time_update->save();
            } else {
                $In_time_update->user_id = $request->user;     
                 $In_time_update->start_time = $start_time;
                $In_time_update->end_time = $end_time;
                $In_time_update->date = $request->date;
                $In_time_update->work_time = $totalDuration;
                $In_time_update->overtime = '00:00:00';
                $In_time_update->total_hours = $total_time_seconds;
                $In_time_update->work_and_overtime = $simplework;
                $In_time_update->status = 0;
                $In_time_update->save();
            }
            return redirect()->back()->with('message', 'Your attendance successfully!');
        } else {
            return redirect()->back()->with('error', 'Your attendance Already Done!');
        }




    }

    public function attendance_search(Request $request)

    {

if ($request->start_date && $request->end_date && $request->department) {
    $atten_emp['emp_atten'] = DB::table('attendences')->where('date', '>=', $request->start_date)
    ->where('date', '<=', $request->end_date)->when('user', function ($query) use ($request) {
            return $query->where('department',$request->department);
           })
            ->leftjoin('users', 'users.id', '=', 'attendences.user_id')
            ->select('users.first_name', 'attendences.*')->orderBy('date', 'DESC')->get();
    //  dd($atten_emp);
    //dd($atten_emp['emp_atten']);
    return view('Admin.attendance_history', $atten_emp);

}



if ($request->start_date && $request->end_date ) {
    $atten_emp['emp_atten'] = DB::table('attendences')->where('date', '>=', $request->start_date)->where('date', '<=', $request->end_date)
            ->leftjoin('users', 'users.id', '=', 'attendences.user_id')
            ->select('users.first_name', 'attendences.*')->orderBy('date', 'DESC')->get();
    //  dd($atten_emp);
    //dd($atten_emp['emp_atten']);
    return view('Admin.attendance_history', $atten_emp);
}



    }


}
