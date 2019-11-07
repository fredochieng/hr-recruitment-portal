<?php

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

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Job Postings Routes
Route::resource('jobs/postings', 'JobPostingsController');
Route::any('/get_departments', 'JobPostingsController@departmentsSelector');
Route::any('/job/manage/&id={id}', 'JobPostingsController@manageJobPostings');
Route::any('/job/update/&id={id}', 'JobPostingsController@updateJobPosting');
Route::any('jobs/open', 'JobPostingsController@openJobs');
Route::any('jobs/ongoing', 'JobPostingsController@ongoingJobs');
Route::any('jobs/closed', 'JobPostingsController@closedJobs');
Route::any('jobs/deleted', 'JobPostingsController@deletedJobs');

// Interviews Routes
Route::resource('jobs/interviews', 'InterviewsController');
Route::any('/interview/manage/&id={id}', 'InterviewsController@manageInterview');
Route::any('/interview/update/&id={id}', 'InterviewsController@updateInterview');
Route::any('interviews/open', 'InterviewsController@openInterviews');
Route::any('interviews/ongoing', 'InterviewsController@ongoingInterviews');
Route::any('interviews/closed', 'InterviewsController@closedInterviews');
Route::any('interviews/deleted', 'InterviewsController@deletedInterviews');
Route::any('interviews/senior', 'InterviewsController@seniorInterviews');
Route::any('interviews/staff', 'InterviewsController@staffInterviews');
Route::any('/add/panelist/&id={id}', 'InterviewsController@addPanelist');
Route::any('/add/candidates', 'InterviewsController@addCandidates');
Route::any('/interview/start', 'InterviewsController@startSession');
Route::any('/interview/close', 'InterviewsController@closeSession');
Route::any('/session/start', 'InterviewsController@startCandidateSession');
Route::any('/session/end', 'InterviewsController@closeCandidateSession');

// Candidates Routes
Route::resource('candidates', 'CandidateController');
Route::any('/candidate/manage/&id={id}', 'CandidateController@manageCandidate');
Route::any('/candidate/add_ratings', 'CandidateController@addRatings');
Route::any('/candidate/offer_letter', 'CandidateController@offerLetter');
Route::any('/candidate/second_interview', 'CandidateController@secondInterview');

// Exit Interviews Routes
Route::resource('exit_interviews', 'ExitInterviewsController');
Route::any('exit_interview/deleted', 'ExitInterviewsController@deletedExitInterviews');

// Department Routes
Route::resource('departments', 'DepartmentController');
Route::any('/department/manage/&id={id}', 'DepartmentController@manageDepartment');
Route::any('/update_department', 'DepartmentController@updateDepartment');
Route::any('/update_functiona_head', 'DepartmentController@updateFunctionalHead');

// Users Routes
Route::resource('users', 'UsersController');

// Reports Routes
Route::any('reports/jobs', 'ReportsController@jobs');
Route::any('reports/jobs/view', 'ReportsController@jobsReport');
Route::any('report/jobs/excel/generate', 'ReportsController@exportJobsReport');


Route::any('reports/interviews', 'ReportsController@interviews');
Route::any('reports/interviews/view', 'ReportsController@interviewsReport');


Route::any('reports/candidates/added', 'ReportsController@addedCandidates');
Route::any('reports/candidates/added/view', 'ReportsController@addedCandidatesReport');


Route::any('reports/candidates/rated', 'ReportsController@ratedCandidates');
Route::any('reports/candidates/rated/view', 'ReportsController@ratedCandidatesReport');


Route::any('reports/candidates/selected', 'ReportsController@selectedCandidates');
Route::any('reports/candidates/selected/view', 'ReportsController@selectedCandidatesReport');


Route::any('reports/panelists', 'ReportsController@panelists');
Route::any('reports/panelists/view', 'ReportsController@panelistsReport');


Route::any('reports/exit_interviews', 'ReportsController@exit_interviews');
Route::any('reports/exit_interviews/view', 'ReportsController@exitInterviewsReport');