<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontEndController@index')->name('frontend');
Route::get('/get-total-pages', 'FrontEndController@getTotalPages');
Route::get('/get-page', 'FrontEndController@getPage');

Route::group(['prefix'=>'staffs'],function($router){
    $router->post('create','StaffController@create')->name('staffs.create');
    $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    $router->post('add-cv','StaffController@addCurriculum')->name('staffs.add-cv');
    $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    $router->post('add-job-details','StaffController@addJobDetails')->name('staffs.add-job-details');
    $router->get('/{id}','StaffController@getStaff')->name('staffs.staff-info');
    
    $router->get('/search/department','StaffController@searchByFacult')->name('staffs.staff-search');
    
});

Route::group(['prefix'=>'staff-categories'],function($router){
   
    $router->get('/','StaffCategoryController@index');
    
});

Route::group(['prefix'=>'publication-types'],function($router){
   
    $router->get('/','PublicationTypeController@index');
    
});

Route::group(['prefix'=>'education'],function($router){
    $router->post('create','EducationHistoryController@create')->name('education.create');
    $router->post('update','EducationHistoryController@updateHistory')->name('education.update');
    $router->post('delete','EducationHistoryController@deleteHistory')->name('education.deleteHistory');

    $router->get('histories/{email}','EducationHistoryController@getStaffEducationHistory')->name('staff.histories');
    $router->get('{id}','EducationHistoryController@getEducationHistory');
   
    
    // $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    // $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    
});

Route::group(['prefix'=>'employment'],function($router){
    $router->post('create','EmploymentHistoryController@create')->name('employment.create');
    $router->get('histories/{email}','EmploymentHistoryController@getStaffEmploymentHistory')->name('employment.histories');
    $router->post('update','EmploymentHistoryController@updateHistory')->name('employment.update');
    $router->post('delete','EmploymentHistoryController@deleteHistory')->name('employment.deleteHistory');
    $router->get('{id}','EmploymentHistoryController@getEmploymentHistory');
    
    // $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    // $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    
});

Route::group(['prefix'=>'courses'],function($router){
  
    $router->get('get-courses/{id}','CourseController@getCourses');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
