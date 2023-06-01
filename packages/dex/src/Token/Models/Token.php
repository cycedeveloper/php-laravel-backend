<?php
namespace Sayedsoft\Dex\Token\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\TronChain;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWallet;
use Sayedsoft\DexWithdrawal\Models\WithdrawalTokenSettings;

class Token extends Model
{
    use HasFactory;

    protected $table = 'dex_tokens';

    protected $fillable = [
        'id',
        'token_code',
        'token_name',
        'contract_address',
        'contract_address_test',
        'disabled',
        'blockchain',
        'is_default',
        'payable',
        'withdrawable',
        'disabled'
    ];

    protected $hidden = [
        'pricing',
        'contract_address_test',
        'created_at',
        'updated_at'
    ];

    public function scopePayble($query) {
        return $query->where('payable',true);
    }

    public function createWallet() {
        return TronChain::createWallet();
    }

    public function withdrawalTokenSettings() {
        return $this->hasOne(WithdrawalTokenSettings::class,'id')->with('feeFace');
    }

    protected static function booted()
    {
        static::addGlobalScope('disabled', function (Builder $builder) {
            $builder->where('disabled','=',false);
        });
    }
}
