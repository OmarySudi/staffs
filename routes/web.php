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

Route::group(['prefix'=>'staffs'],function($router){
    $router->post('create','StaffController@create')->name('staffs.create');
    $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    $router->post('add-cv','StaffController@addCurriculum')->name('staffs.add-cv');
    $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
