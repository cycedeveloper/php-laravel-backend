<?php
namespace Sayedsoft\Dex;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Sayedsoft\DexAuthReferral\Controller\API\AuthAPIController;
use Sayedsoft\DexAuthReferral\Controller\Auth\ConfirmPasswordController;
use Sayedsoft\DexAuthReferral\Controller\Auth\ForgotPasswordController;
use Sayedsoft\DexAuthReferral\Controller\Auth\LoginController;
use Sayedsoft\DexAuthReferral\Controller\Auth\RegisterController;
use Sayedsoft\DexAuthReferral\Controller\Auth\ResetPasswordController;
use Sayedsoft\DexAuthReferral\Controller\Auth\VerificationController;
use Sayedsoft\DexAuthReferral\Controller\UserProfileController;
use Sayedsoft\DexAuthReferral\Controller\AuthenticationController;

class DexRoutes {

    public static function setApi() {
         Route::middleware(['auth:sanctum'])->group(function(){
               Route::post('deposit', [DexController::class, 'deposit']);
         });
    }


    public static function Set () {
    Route::group(['middleware' => ['web']], function () {
        Auth::routes([
            'login'    => true,
            'logout'   => true,
            'register' => true,
            'reset'    => true,   // for resetting passwords
            'confirm'  => true,  // for additional password confirmations
            'verify'   => true,  // for email verification
        ]);




        //routes here

        // Login Routes...
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);

        // Logout Routes...
        Route::post('logout', [LoginController::class, 'logout'])->name('logout.app');

        Route::get('logout', [LoginController::class, 'logout'])->name('logout.app.get');


        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register']);


        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


        Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
        Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
        
        // Email Verification Routes...
        Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', [AuthAPIController::class, 'verifyMail'])->name('verification.verify');
       // Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    });






}


}