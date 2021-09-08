/* Dashbaord admin - Login */
Route::group(['middleware' => 'api', 'prefix' => 'admin'], function ($router) {
Route::get('/', 'DashboardController@login');
});