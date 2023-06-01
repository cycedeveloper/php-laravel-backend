<?php
namespace Sayedsoft\DexWithdrawal\Helpers;

use Illuminate\Support\Facades\Route;
use Sayedsoft\DexWithdrawal\Controller\WithdrawalController;

class DexWithdrawalRoutes { 
    
    public static function SetApi () {

        Route::middleware(['auth:sanctum'])->group(function(){
            
            Route::prefix('withdrawal')->name('withdrawal.')->group(function(){
                Route::get('new/{token?}', [WithdrawalController::class, 'newRequest'])->name('new');
                
                Route::post('/confirm', [WithdrawalController::class, 'confirm'])->name('confirm');
                
                Route::get('/history', [WithdrawalController::class, 'history'])->name('history');
                Route::get('/userWallets', [WithdrawalController::class, 'getUserWallets'])->name('history');
             
            });

            Route::post('withdraw', [WithdrawalController::class, 'store'])->name('store');
            Route::post('new-wallet', [WithdrawalController::class, 'storeNewWallet'])->name('storeNewWallet');
            Route::post('userWithdrawals', [WithdrawalController::class, 'getUserWallets'])->name('userWithdrawals');
        });

            // Profile Routes
            

    }
}