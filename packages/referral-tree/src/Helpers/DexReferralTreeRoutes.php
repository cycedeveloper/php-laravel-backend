<?php
namespace Sayedsoft\ReferralTree\Helpers;

use Illuminate\Support\Facades\Route;
use Sayedsoft\ReferralTree\Controller\ReferralTreeController;

class DexReferralTreeRoutes { 
    
    public static function Set () {
        Route::middleware(['auth','verified'])->group(function(){
            
            Route::prefix('referral')->name('referral.')->group(function(){

                Route::get('/invite', [ReferralTreeController::class, 'invite'])->name('invite');

                Route::get('/tree', [ReferralTreeController::class, 'tree'])->name('tree');
            
                Route::get('/list', [ReferralTreeController::class, 'list'])->name('list');
                
            });
        });
    }

    public static function setApi () {

        Route::middleware(['auth:sanctum'])->group(function(){

           Route::post('referral-childs', [ReferralTreeController::class, 'userChilds'])->name('childs');

            Route::post('userReferral',[ReferralTreeController::class,'userReferral']);
    
            Route::post('userChilds',[ReferralTreeController::class,'userChilds']);

            Route::post('userAllChilds',[ReferralTreeController::class,'userAllChilds']);

        });
    }
}

