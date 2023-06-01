<?php
namespace Sayedsoft\StakeToken;

use Illuminate\Support\Facades\Route;
use Sayedsoft\StakeToken\Controller\StakeController;

class DexStakeRoutes {
    
    public static function SetApi () {
        Route::middleware(['auth:sanctum'])->group(function(){
            
            Route::prefix('stake')->name('stake.')->group(function(){

                Route::post('/stake-validate', [StakeController::class, 'validate'])->name('validate');

                Route::post('/stake-save', [StakeController::class, 'save'])->name('save');

                Route::post('/stake-history', [StakeController::class, 'stakeHistory'])->name('order-history');
                
                Route::post('/career', [StakeController::class, 'career'])->name('career');

                Route::post('/referral', [StakeController::class, 'referral'])->name('referral');

            });
        });
    }

    

}

