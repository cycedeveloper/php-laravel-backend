<?php
namespace Sayedsoft\ExchangeToken;

use Illuminate\Support\Facades\Route;
use Sayedsoft\ExchangeToken\Controller\ExchangeController;

class DexExchangeTokenRoutes {
    
    public static function SetApi () {
        Route::middleware(['auth:sanctum'])->group(function(){
            
            Route::prefix('exchange')->name('exchange.')->group(function(){

                Route::post('/order-validate', [ExchangeController::class, 'validate'])->name('validate');

                Route::post('/order-save', [ExchangeController::class, 'save'])->name('save');

                Route::post('/order-history', [ExchangeController::class, 'orderHistory'])->name('order-history');
                

            });
        });
    }

    

}

