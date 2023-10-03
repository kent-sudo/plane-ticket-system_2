<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and will be assigned to the "web" middleware group.
| Make something great!
|
*/

// Routes accessible to guests
Route::middleware(['middleware' => 'guest:users'])->group(function () {

   Auth::routes(['logout' => false]);

});

Route::middleware(['middleware' => 'auth:users'])->group(function (){
    Route::post('/logout',['as' =>'logout','uses'=>'App\Http\Controllers\Auth\LoginController@logout']);
});

Route::middleware(['middleware' => 'auth:users'])->namespace('App\Http\Controllers\User')->group(function (){

    Route::redirect('/', 'home');
    
    //首頁
    Route::get('/home', ['as'=>'ticketRequirement.index','uses' => 'TicketRequirementController@index']);
    Route::prefix('home')->group(function(){
        Route::post('transfer/{ticket_id}', ['as'=>'ticketRequirement.transfer','uses' => 'TicketRequirementController@transfer']);
    });


    //票倉頁面
    Route::get('/inventory', ['as'=>'inventory.index','uses' => 'InventoryController@index']);
    Route::prefix('inventory')->group(function(){
        Route::post('transfer/{ticket_id}', ['as'=>'inventory.transfer','uses' => 'InventoryController@transfer']);
    });


    //個人頁面
    Route::get('/users', ['as'=>'userDetails.index','uses' => 'UserDetailsController@index']);
    Route::prefix('users')->group(function(){
        Route::post('bankIn', ['as'=>'userDetails.bankIn','uses' => 'UserDetailsController@bankIn']);
        Route::post('withDraw',['as'=>'userDetails.withDraw','uses' => 'UserDetailsController@withDraw']);
        Route::post('sendMessage',['as'=>'userDetails.sendMessage','uses' => 'UserDetailsController@sendMessage']);
        Route::post('sendFollowUpMessage/{message_id}',['as'=>'userDetails.sendFollowUpMessage','uses' => 'UserDetailsController@sendFollowUpMessage']);
    });
});


// Fallback route
Route::fallback(function () {
    return redirect('/');
});
