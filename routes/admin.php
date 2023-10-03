<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| 專為後台開設的 route 文件
|
*/


    Route::middleware(['middleware' => 'guest:admins'])->group(function () {
        Route::redirect('/', '/admin/login');
        // 登录页面
        Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
        // 登录处理
        Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
    });



    Route::middleware(['middleware' => 'auth:admins'])->group(function (){
        Route::post('/logout',['as' =>'admin.logout','uses'=>'App\Http\Controllers\Auth\LoginController@logout']);
    });

    Route::middleware(['middleware' => 'auth:admins'])->namespace('App\Http\Controllers\Admin')->group(function (){

        Route::redirect('/', '/admin/user_information_list');

        Route::get('users_search',[\App\Http\Controllers\Admin\ShowUserController::class,'search'])
            ->name('admin.search');
        Route::get('user_information',[\App\Http\Controllers\Admin\ShowUserController::class,'index'])
            ->name('admin.user_information');

        //Route::put('/admin/ticket_warehouse',['as'=>'ticket-warehouse.index','uses'=>'CreateFlightsController@store']);
        Route::get('ticket_management',[\App\Http\Controllers\Admin\CreateFlightsController::class,'index'])
            ->name(('admin.ticket_management'));
        Route::post('ticket_management/store',[\App\Http\Controllers\Admin\CreateFlightsController::class,'store'])
            ->name(('admin.ticket_management.store'));

        Route::post('ticket_management/new_ticket',[\App\Http\Controllers\Admin\CreateFlightsController::class,'newTicket'])
            ->name(('admin.ticket_management.newTicket'));

        Route::get('ticket_warehouse',[\App\Http\Controllers\Admin\WarehouseController::class,'index'])
        ->name('admin.ticket_warehouse');
        Route::get('user_modify/{id}/edit','ShowUserController@edit')->name('user.edit');
        Route::put('user_modify/{id}/edit2','ShowUserController@edit2')->name('user.edit2');
        Route::get('user_modify_tickets/{id}/edit','CreateFlightsController@edit')->name('ticket.edit');
        Route::put('user_modify_tickets/{id}/update','CreateFlightsController@update')->name('ticket.update');
        Route::get('user_modify_money/{id}/edit{user_id}','MoneyController@edit')->name('wallet.edit');
        Route::put('user_modify_money/{id}/update{user_id}','MoneyController@update')->name('wallet.update');
        Route::get('ticket_warehouse_edit/{id}/edit','CreateFlightsController@TWedit')->name('ticket_warehouse.edit');
        Route::put('ticket_warehouse_edit/{id}/update','CreateFlightsController@TWupdate')
            ->name('ticket_warehouse.update');
        Route::get('ticket_search',[\App\Http\Controllers\Admin\WarehouseController::class,'search'])
            ->name('ticket.search');
        Route::get('transfer_ticket',[\App\Http\Controllers\Admin\TicketManagementController::class,'index'])
            ->name('admin.transfer_ticket');
        Route::get('transfer_search',[\App\Http\Controllers\Admin\TicketManagementController::class,'search'])
            ->name('transfer_search');
        Route::put('transfer_ticket/transfer/{id}',[\App\Http\Controllers\Admin\TicketManagementController::class,'transfer'])
            ->name('transfer_transfer');
        Route::put('transfer_ticket/transfer_many/{id}',[\App\Http\Controllers\Admin\TicketManagementController::class,'transfer_many'])
            ->name('transfer_many_transfer');


        Route::delete('ticket/delete/{id}',[\App\Http\Controllers\Admin\SoftDelete::class,'destroy'])
            ->name('ticket_delete');
        Route::delete('user/delete/{id}',[\App\Http\Controllers\Admin\SoftDelete::class,'destroyUser'])
            ->name('user_delete');
        Route::get('money_management',[\App\Http\Controllers\Admin\MoneyManagementController::class,'index'])
            ->name('admin.money_management');
        Route::get('transfer_processing/{id}/edit',[\App\Http\Controllers\Admin\MoneyManagementController::class,'edit'])
            ->name('money.edit');
        Route::put('transfer_processing_edit/{id}/update',[\App\Http\Controllers\Admin\MoneyManagementController::class,'update'])
            ->name('transfer_processing.update');
        Route::get('user_information_list',[\App\Http\Controllers\Admin\ShowUserController::class,'index2'])
            ->name('admin.user_information_list');
        Route::get('users_search',[\App\Http\Controllers\Admin\ShowUserController::class,'search_list'])
            ->name('admin.search_list');

        Route::get('money_management/search',[\App\Http\Controllers\Admin\MoneyManagementController::class,'search'])
            ->name('admin.money_management.search');

        Route::get('money_management/status_test',[\App\Http\Controllers\Admin\MoneyManagementController::class,'status_test'])
            ->name('admin.money_management.status_test');

        Route::get('ticket_warehouse/transfer_search_2',[\App\Http\Controllers\Admin\TicketManagementController::class,'indexCheck'])
            ->name('transfer_search_2');

        Route::get('money_management/search_date',[\App\Http\Controllers\Admin\MoneyManagementController::class,'search_date'])
            ->name('admin.money_management.search_date');

        Route::get('marquee',[\App\Http\Controllers\Admin\MarqueeController::class,'index'])
            ->name('admin.marquee');
        Route::get('marquee/{id}',[\App\Http\Controllers\Admin\MarqueeController::class,'edit'])
            ->name('admin.marquee.edit');
        Route::put('marquee/{id}/update',[\App\Http\Controllers\Admin\MarqueeController::class,'updata'])
            ->name('admin.marquee.update');
        Route::delete('marquee/delete/{id}',[\App\Http\Controllers\Admin\SoftDelete::class,'destroyMarquee'])
            ->name('marquee_delete');
        Route::post('marquee/add',[\App\Http\Controllers\Admin\MarqueeController::class,'store'])
            ->name('marquee_add');

        Route::get('marquee',[\App\Http\Controllers\Admin\MarqueeController::class,'index'])
            ->name('admin.marquee');
        Route::get('marquee/{id}',[\App\Http\Controllers\Admin\MarqueeController::class,'edit'])
            ->name('admin.marquee.edit');
        Route::put('marquee/{id}/update',[\App\Http\Controllers\Admin\MarqueeController::class,'updata'])
            ->name('admin.marquee.update');
        Route::delete('marquee/delete/{id}',[\App\Http\Controllers\Admin\SoftDelete::class,'destroyMarquee'])
            ->name('marquee_delete');
        Route::post('marquee/add',[\App\Http\Controllers\Admin\MarqueeController::class,'store'])
            ->name('marquee_add');

        //票務需求頁面
        Route::get('/ticket_request', ['as'=>'admin.ticket_request','uses' => 'TicketRequestController@index']);
        Route::prefix('ticket_request')->group(function(){
            Route::get('edit/{id}', ['as'=>'admin.ticket_request.edit','uses' => 'TicketRequestController@edit']);
            Route::post('create', ['as'=>'admin.ticket_request.create','uses' => 'TicketRequestController@create']);
            Route::put('edit/{id}', ['as'=>'admin.ticket_request.update','uses' => 'TicketRequestController@update']);
            Route::delete('delete/{id}', ['as'=>'admin.ticket_request.delete','uses' => 'TicketRequestController@delete']);
        });

        //轉讓請求頁面
        Route::get('/ticket_transfer_request',[\App\Http\Controllers\Admin\TicketTransferRequestController::class,'index'])
            ->name('admin.ticket_transfer_request');
        Route::prefix('ticket_transfer_request')->group(function(){
            Route::get('edit/{id}',[\App\Http\Controllers\Admin\TicketTransferRequestController::class,'edit'])
                ->name('admin.ticket_transfer_request_edit');
            Route::get('status',[\App\Http\Controllers\Admin\TicketTransferRequestController::class,'status'])
                ->name('admin.ticket_transfer_request_status');
            Route::get('money_management/search',[\App\Http\Controllers\Admin\TicketTransferRequestController::class,'search'])
                ->name('admin.ticket_transfer_request_search');
            Route::get('money_management/search_date',[\App\Http\Controllers\Admin\TicketTransferRequestController::class,'search_date'])
                ->name('admin.money_management.search_date');

            Route::put('edit/{id}', ['as'=>'admin.ticket_transfer_request.update','uses' => 'TicketTransferRequestController@update']);
        });


        Route::delete('ticket_warehouse/delete/{id}',[\App\Http\Controllers\Admin\SoftDelete::class,'destroyFlight'])
            ->name('flight_delete');

        /*
        Route::get('user_information', function () {
            return view('admin.user_information');
        })->name('admin.user_information');

        Route::get('ticket_management', function () {
            return view('admin.ticket_management');
        })->name('admin.ticket_management');
        */



        //站内信頁面
        Route::get('/email_service', ['as'=>'admin.email_service','uses' => 'EmailServiceController@index']);
        Route::prefix('email_service')->group(function(){
            Route::post('followMessage/{ticket_id}', ['as'=>'admin.email_service.followMessage','uses' => 'EmailServiceController@followMessage']);
        });

        Route::get('user_modify', function () {
            return view('admin.user_modify');
        })->name('admin.user_modify');

        Route::get('user_modify_money', function () {
            return view('admin.user_modify_money');
        })->name('admin.user_modify_money');

        Route::get('user_modify_tickets', function () {
            return view('admin.user_modify_tickets');
        })->name('admin.user_modify_tickets');

    });


    Route::fallback(function () {

        return redirect('admin/');
    });




