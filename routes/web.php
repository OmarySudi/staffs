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
    $router->post('delete','StaffController@deleteStaff')->name('staffs.delete');
    $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    $router->post('add-cv','StaffController@addCurriculum')->name('staffs.add-cv');
    $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    $router->post('add-job-details','StaffController@addJobDetails')->name('staffs.add-job-details');
    $router->post('add-areas','StaffController@addAreasOfResearch')->name('staffs.add-areas');
    $router->post('add-accounts','StaffController@addAccounts')->name('staffs.add-accounts');
    $router->post('add-skills','StaffController@addSkills')->name('staffs.add-skills');
    $router->get('/get-total-pages','StaffController@getTotalPages');
    $router->get('/get-page','StaffController@getPage');
    $router->get('/staffs','StaffController@getStaffs');
    $router->get('/{id}','StaffController@getStaff')->name('staffs.staff-info');
    $router->get('/info/{id}','StaffController@getStaffInfo');
    $router->get('/','StaffController@getAllStaffs');
    $router->post('/account-type','StaffController@addAccountType')->name('staffs.add-account-type');
    
    $router->get('/search/department','StaffController@searchByFacult')->name('staffs.staff-search');
    $router->get('/search/name','StaffController@searchByName');
    $router->get('/search/department-staffs/{id}','StaffController@searchByDepartment');
    
});

Route::group(['prefix'=>'staff-categories'],function($router){
   
    $router->get('/','StaffCategoryController@index');
    $router->get('/{id}','StaffCategoryController@getCategory');
    $router->post('create','StaffCategoryController@create')->name('categories.add');
    $router->post('update','StaffCategoryController@update')->name('categories.update');
    $router->post('delete','StaffCategoryController@delete')->name('categories.delete');
    
});

Route::group(['prefix'=>'departments'],function($router){
   
    $router->get('/','DepartmentController@index');
    $router->post('/','DepartmentController@create')->name('departments.add');
    $router->post('update','DepartmentController@update')->name('departments.update');
    $router->post('delete','DepartmentController@delete')->name('departments.delete');
    $router->get('get-total-pages','DepartmentController@getTotalPages');
    $router->get('get-page','DepartmentController@getPage');
    $router->get('/{id}','DepartmentController@getDepartment');
   
    
});

Route::group(['prefix'=>'users'],function($router){
   
    $router->post('verify','UserController@verifyUser')->name('users.verify');
    $router->post('deny','UserController@denyVerification')->name('users.deny');
    $router->get('get-total-pages','UserController@getTotalPages');
    $router->get('get-page','UserController@getPage');
    $router->get('search','UserController@searchByName');
    $router->get('/{id}','UserController@getUser');
    
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

Route::group(['prefix'=>'areas'],function($router){

    $router->post('update','AreaOfResearchController@updateArea')->name('area.update');
    $router->post('delete','AreaOfResearchController@deleteArea')->name('area.delete');
    $router->get('{id}','AreaOfResearchController@getArea');

});


Route::group(['prefix'=>'skills'],function($router){

    $router->post('update','SkillController@updateSkill')->name('skill.update');
    $router->post('delete','SkillController@deleteSkill')->name('skill.delete');
    $router->get('{id}','SkillController@getSkill');

});


Route::group(['prefix'=>'publication'],function($router){
    $router->post('create','PublicationController@create')->name('publication.create');
    $router->get('publication/{email}','PublicationController@getStaffPublication')->name('publication.publications');
    $router->post('update-journal','PublicationController@updateJournalPublication')->name('publication.update-journal');
    $router->post('update-book','PublicationController@updateBookPublication')->name('publication.update-book');
    $router->post('update-comference','PublicationController@updateComferencePublication')->name('publication.update-comference');
    $router->post('delete','PublicationController@deletePublication')->name('publication.deletePublication');
    $router->get('{id}','PublicationController@getPublication');
    
    // $router->post('add-biography','StaffController@addBiography')->name('staffs.add-biography');
    // $router->post('add-education-history','StaffController@addEducationHistory')->name('staffs.add-education-history');
    
});


Route::group(['prefix'=>'project'],function($router){

    $router->post('create','ProjectController@create')->name('project.create');
    $router->get('projects/{email}','ProjectController@getStaffProjects')->name('project.projects');
    $router->post('update','ProjectController@updateProject')->name('project.update');
    $router->post('delete','ProjectController@deleteProject')->name('project.deleteProject');
    $router->get('{id}','ProjectController@getProject');  
});

Route::group(['prefix'=>'courses'],function($router){
  
    $router->get('get-courses/{id}','CourseController@getCourses');
    
    $router->post('update','CourseController@updateCourse')->name('course.update');
    $router->post('delete','CourseController@deleteCourse')->name('course.delete');
    $router->get('{id}','CourseController@getCourse');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
