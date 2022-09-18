<?php


Route::get('/', 'TestsController@index')->name('test.home');

Route::get('toolkit/{slug}', 'HomeController@getLanding')->name('get.test.landing');

Route::get('toolkit/profile/{id}', 'ProfileController@index')->name('profile.index');
Route::post('toolkit/insert', 'ProfileController@insert');

Route::group(['middleware' => ['web']], function () {

    Route::get('toolkit/report/{result_id}', 'ResultsController@report')->name('report.get');

    Route::post('toolkit/c-report/', 'ResultsController@Creport')->name('Creport.post');
    Route::get('toolkit/c-report/{category_id}', 'ResultsController@getCreport')->name('Creport.get');


});

Route::get('get-state-list', 'HomeController@getStates')->name('get.state');

// User

Route::group(['as' => 'client.', 'middleware' => ['web']], function () {
    Route::get('u/check', 'Auth\LoginController@getuCheck')->name('getu.check');
    Route::post('u/check', 'Auth\LoginController@postuCheck')->name('postu.check');

    Route::get('u/register', 'Auth\RegisterController@getuRegister')->name('getu.register');
    Route::post('u/register', 'Auth\RegisterController@postuRegister')->name('postu.register');

    Route::get('toolkit/{slug}/start', 'TestsController@getTest')->name('get.test.start');

    Route::get('toolkit/{slug}/{profile}/start', 'TestsController@test_profile')->name('test.profile.start');
    Route::get('toolkit/{profile}/register', 'ProfileController@profile_register')->name('test.profile.register');
    Route::post('toolkit/register', 'ProfileController@profile_register_store')->name('test.profile.register.store');

    Route::post('toolkit', 'TestsController@store')->name('test.store');

    Route::post('toolkit/profile/{id}', 'ProfileController@store')->name('profile.store');

    Route::get('toolkit/result/{result_id}', 'ResultsController@show')->name('results.show');

});
Route::group(['as' => 'client.', 'middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@redirect');
    Route::get('dashboard', 'HomeController@index')->name('home');
    Route::get('change-password', 'ChangePasswordController@create')->name('password.create');
    Route::post('change-password', 'ChangePasswordController@update')->name('password.update');

});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth.admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::get('category/{id}/questions', 'CategoriesController@categoryQuestions')->name('category.questions');
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');
    Route::get('category/{id}/reports', 'CategoriesController@categoryReports')->name('category.reports');

    // Questions
    Route::get('question/{id}/options', 'QuestionsController@questionOptions')->name('question.options');
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionsController');

    // Options
    Route::delete('options/destroy', 'OptionsController@massDestroy')->name('options.massDestroy');
    Route::resource('options', 'OptionsController');

    // Results
    Route::delete('results/destroy', 'ResultsController@massDestroy')->name('results.massDestroy');
    Route::resource('results', 'ResultsController');

    //Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportsController');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
