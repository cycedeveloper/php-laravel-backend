<?php
namespace Sayedsoft\DexwithdrawalFiat\Helpers;

use Illuminate\Support\Facades\Route;
use Sayedsoft\DexwithdrawalFiat\Controller\withdrawalFiatController;

class DexwithdrawalFiatRoutes { 
    
    public static function SetApi () {

        Route::middleware(['auth:sanctum'])->group(function(){
            
            Route::prefix('withdrawalFiat')->name('withdrawalFiat.')->group(function(){
                Route::get('new/{token?}', [withdrawalFiatController::class, 'newRequest'])->name('new');
                
                Route::post('/confirm', [withdrawalFiatController::class, 'confirm'])->name('confirm');
                
                Route::get('/history', [withdrawalFiatController::class, 'history'])->name('history');
                Route::get('/userWallets', [withdrawalFiatController::class, 'getUserWallets'])->name('history');
             
            });

            Route::post('withdraw', [withdrawalFiatController::class, 'store'])->name('store');
            Route::post('new-wallet', [withdrawalFiatController::class, 'storeNewWallet'])->name('storeNewWallet');
            Route::post('userwithdrawalFiats', [withdrawalFiatController::class, 'getUserWallets'])->name('userwithdrawalFiats');
        });

            // Profile Routes
            

    }
}