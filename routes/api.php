<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\UserWalletsContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sayedsoft\Dex\DexRoutes;
use Sayedsoft\DexAuthReferral\Controller\Auth\LoginController;
use Sayedsoft\DexAuthReferral\Helpers\DexAuthRoutes;
use Sayedsoft\DexWithdrawal\Controller\WithdrawalController;
use Sayedsoft\DexWithdrawal\Helpers\DexWithdrawalRoutes;
use Sayedsoft\ExchangeToken\DexExchangeTokenRoutes;
use Sayedsoft\ReferralTree\Helpers\DexReferralTreeRoutes;
use Sayedsoft\StakeToken\DexStakeRoutes;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/app', [AppController::class, 'all']);

DexRoutes::setApi();
DexAuthRoutes::setApi();
DexReferralTreeRoutes::setApi();
DexExchangeTokenRoutes::SetApi();
DexWithdrawalRoutes::SetApi();
DexStakeRoutes::setApi();