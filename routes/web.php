<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SickLeaveController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
// Route::get('/profile', function () {
//     return 'hi';
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {

    // Route::prefix('admin')->namespace('App\\Http\\Controllers\\Admin')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('employees', 'AdminController@employees')->name('admin.employees');
    Route::get('department', 'AdminController@department')->name('admin.department');
    Route::get('employee/create', 'AdminController@employeeCreate')->name('admin.employees.create');
    Route::get('employee/{id}/view', 'AdminController@employeeView')->name('admin.employees.view');
    Route::get('employee/{id}/edit', 'AdminController@employeeEdit')->name('admin.employees.edit');
    Route::get('employee/{id}/delete', 'AdminController@employeeDestroy')->name('admin.employees.delete');
    // Route::get('employee/{id}/show', 'AdminController@employeeShow')->name('admin.employees.show');
    Route::post('employee/{id}/update', 'AdminController@employeeUpdate')->name('admin.employeeUpdate');
    Route::post('employees', 'AdminController@employeeStore')->name('admin.employeeStore');
    Route::get('attendance_history', 'AdminController@attendance_history')->name('admin.attendance_history');
     Route::get('attendance/search', 'AdminController@attendance_search')->name('admin.attendance_search');
        Route::post('admin/add/attendance', 'AdminController@admin_attendance')->name('admin.add.admin_attendance');

    Route::get('attent_status_disapprove/{id}', 'AdminController@attent_status_disapprove')->name('admin.attent_status_disapprove');
    Route::get('attent_status_approve/{id}', 'AdminController@attent_status_approve')->name('admin.attent_status_approve');

    Route::post('add_department', 'AdminController@add_department')->name('admin.add_department');
    Route::get('depart_status_deactive/{id}', 'AdminController@depart_status_deactive')->name('admin.depart_status_deactive');
    Route::get('depart_status_active/{id}', 'AdminController@depart_status_active')->name('admin.depart_status_active');
    Route::get('delete_department/{id}', 'AdminController@delete_department')->name('admin.delete_department');
    Route::post('edit_department/{id}', 'AdminController@edit_department')->name('admin.edit_department');
    ///Profile Section /////////////
    // Route::post('profile', 'AdminController@profile')->name('profile');
    Route::get('update_profile', 'AdminController@update_profile')->name('admin.update_profile');


    Route::any('/add_threshold', 'AdminController@add_threshold');
    Route::post('/add/deduction', 'AdminController@create_deduction')->name('add.deduction');


    Route::get('/updateThreshold', 'AdminController@updateThreshold')->name('update.threshold');



    Route::get('/threshold', [AdminController::class, 'threshold']);
    Route::post('/add_threshold', [AdminController::class, 'add_threshold']);
    Route::get('/add_deduction', [AdminController::class, 'add_deduction']);
    Route::get('/edit_threshold/{id}', [AdminController::class, 'edit_threshold']);
    Route::get('/edit_deduction/{id}', [AdminController::class, 'edit_deduction']);

    Route::post('/update_threshold/{id}', [AdminController::class, 'update_threshold']);
    Route::post('/update_deduction/{id}', [AdminController::class, 'update_deduction']);

    Route::get('/delete_threshold/{id}', [AdminController::class, 'delete_threshold']);
    Route::get('/deduction', 'AdminController@deduction')->name('deduction');
    Route::get('processedPayroll', 'AdminController@processedPayroll')->name('processedPayroll');


    Route::get('/sick-leave', 'LeaveController@sick_leave');
    Route::post('/insert_sick_leave', 'LeaveController@insert_sick_leave');
    Route::get('/sick_status_deactive/{id}', 'LeaveController@sick_status_deactive');
    Route::get('/sick_status_active/{id}', 'LeaveController@sick_status_active');
    Route::get('/delete_sick/{id}', 'LeaveController@delete_sick');
    ///////sick leave end
    ///////vacation leave start
    Route::get('/vacation-leave', 'LeaveController@vacation_leave');
    Route::post('/insert_vacation_leave', 'LeaveController@insert_vacation_leave');
    Route::get('/vacation_status_deactive/{id}', 'LeaveController@vacation_status_deactive');
    Route::get('/vacation_status_active/{id}', 'LeaveController@vacation_status_active');
    Route::get('/delete_vacation/{id}', 'LeaveController@delete_vacation');
    ///////vacation leave end

    Route::get('/threshold', [AdminController::class, 'threshold']);
    Route::post('/add_threshold', [AdminController::class, 'add_threshold']);
    Route::get('/edit_threshold/{id}', [AdminController::class, 'edit_threshold']);
    Route::post('/update_threshold/{id}', [AdminController::class, 'update_threshold']);
    Route::get('/delete_threshold/{id}', [AdminController::class, 'delete_threshold']);
    Route::get('deduction', 'AdminController@deduction')->name('deduction');
    Route::post('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');

    Route::get('permission', 'AdminController@AddAdmin')->name('add.admin.permission');
        Route::any('permission/{id}', [AdminController::class, 'Adminpermissionupdate'])->name('permission.update');

        Route::any('permission/access/{id}', [AdminController::class, 'perMision'])->name('permission.access');
    Route::post('/admin/create/user', [AdminController::class, 'AdmincreateUser'])->name('admin.create.user');


});
    Route::post('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');

//notices
Route::get('admin/notices', [NoticeController::class, 'Notices'])->middleware('admin');
Route::get('admin/notice/{id}', [NoticeController::class, 'NoticesDelete'])->middleware('admin');
Route::post('admin/add/notices', [NoticeController::class, 'AddNotices'])->middleware('admin');
Route::post('admin/edit/notices', [NoticeController::class, 'EditNotices'])->middleware('admin');

Route::get('admin/bonus', [PayrollController::class, 'Addbonus'])->name('bonus');
Route::post('store/Bonus', [PayrollController::class, 'storeBonus'])->name('storeboubus');
Route::get('admin/viewbonus', [PayrollController::class, 'ViewBonus'])->name('viewbonus');
Route::get('admin/edit_bonus/{id}/{start}/{end}', [PayrollController::class, 'EditBonus'])->name('editbonus');
Route::get('admin/update_bonus', [PayrollController::class, 'UpdateBonus'])->name('updatebonus');


Route::get('admin/payroll', [PayrollController::class, 'payroll']);
Route::post('admin/search', [PayrollController::class, 'search']);
Route::get('atten_get', [PayrollController::class, 'atten_get']);
Route::get('admin/proceed', [PayrollController::class, 'payrol_proceed']);
Route::get('admin/payroll_start', [PayrollController::class, 'PayrollStartFunc']);
Route::get('admin/add_start_date', [PayrollController::class, 'AddStartDate']);
Route::get('admin/edit_payroll_start/{id}', [PayrollController::class, 'EditStartDate']);
Route::post('admin/update_payroll_start/{id}', [PayrollController::class, 'UpdateStartDate']);
Route::post('/filter_attendance', [PayrollController::class, 'filter_attendance']);
Route::POST('/filter_attendance', 'PayrollController@filter_attendance')->name('filter-attendance');


Route::post('update_profile', [AdminController::class, 'update_profile']);

Route::view('/profile', 'Employee/profile');

Route::prefix('employee')->middleware('employee')->namespace('App\\Http\\Controllers\\Employee')->group(function () {

    Route::get('update_profile', 'AdminController@update_profile')->name('update_profile');
    Route::get('dashboard', 'EmployeeController@dashboard')->name('employee.dashboard');
    Route::post('start-time', 'EmployeeController@starttime')->name('employee.starttime');
    Route::post('end-time', 'EmployeeController@endtime')->name('employee.endtime');
    Route::get('attendance_history', 'EmployeeController@attendance_history')->name('employee.attendance_history');
    Route::get('user_processed_payroll', 'EmployeeController@user_processed_payroll')->name('employee.user_processed_payroll');
    Route::get('user_processed_payroll', 'EmployeeController@user_processed_payroll')->name('employee.user_processed_payroll');

    Route::get('notices', 'EmployeeController@Noticesshow')->name('employee.notices');


});



Route::get('employee/sick-leave', [SickLeaveController::class, 'sick_leave']);
Route::get('employee/vacation-leave', [SickLeaveController::class, 'vacation_leave']);
Route::post('employee/insert_sick_leave', [SickLeaveController::class, 'insert_sick_leave']);
Route::post('employee/insert_vacation_leave', [SickLeaveController::class, 'insert_vacation_leave']);


Route::get('Testmail', 'App\Http\Controllers\TestController@Testmail');
