<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Sayedsoft\Dex\Accounting\Traits\UserAccountingTotalsTrait;
use Sayedsoft\Dex\Accounting\Traits\UserBalancesTrait;
use Sayedsoft\Dex\Base\Traits\UserModelWalletTrait;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserReferral;

class User extends Authenticatable implements MustVerifyEmail
{
    use 
    HasApiTokens,
    UserReferral, 
    HasFactory, 
    UserBalancesTrait,
    UserAccountingTotalsTrait, 
    UserModelWalletTrait,
    Notifiable;

    protected $dateFormat = 'Y-m-d';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = [
       'full_name',
       'hasVerifiedEmail' ,
      
    ];
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password_helper_key'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => "datetime:Y-m-d",
    ];

    /**
     * Get the user's full name.
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getHasVerifiedEmailAttribute () {
        return $this->hasVerifiedEmail();
    }

}
