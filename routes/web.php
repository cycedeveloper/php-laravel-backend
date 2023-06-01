<?php

use App\Http\Controllers\AssetsController;
use IEXBase\TronAPI\Support\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Sayedsoft\DexAuthReferral\Helpers\DexAuthRoutes;
use Sayedsoft\DexWithdrawal\Helpers\DexWithdrawalRoutes;

//DexAuthRoutes::Set();


Route::get('/', function () {
        echo 'api';
});


Route::get('/test', function () {

        $user = new App\Models\User();
        $user->password = Hash::make('password');
        $user->email = 'root@admin.com';
        $user->name = 'Root';
        $user->save();

        print_r($user);

        $admin = new App\Models\Admin();
        $admin->password = Hash::make('password');
        $admin->email = 'root@admin.com';
        $admin->name = 'Root';
        $admin->save();

        print_r($admin);
});

/*
Route::middleware(['auth','verified'])->group(function(){

    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('assets')->name('assets.')->group(function(){

        Route::get('/', [AssetsController::class, 'index'])->name('manage');
        
        Route::get('/list', [ReferralTreeController::class, 'list'])->name('list');
    });

    
    
});

*/





//DexAuthRoutes::set();
//DexReferralTreeRoutes::set();