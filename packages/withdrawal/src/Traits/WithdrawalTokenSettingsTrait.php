<?php 
namespace Sayedsoft\DexWithdrawal\Traits;

use Sayedsoft\DexWithdrawal\Models\WithdrawalTokenSettings;

trait WithdrawalTokenSettingsTrait {

    public function getWithdrawalTokenSettingsAttribute() {
         if ($this->token == null) { return null; }
         return WithdrawalTokenSettings::whereTokenId($this->token_id)->first();
    }
}