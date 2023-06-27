<?php 
namespace Sayedsoft\DexwithdrawalFiat\Traits;

use Sayedsoft\DexwithdrawalFiat\Models\withdrawalFiatTokenSettings;

trait withdrawalFiatTokenSettingsTrait {

    public function getwithdrawalFiatTokenSettingsAttribute() {
         if ($this->token == null) { return null; }
         return withdrawalFiatTokenSettings::whereTokenId($this->token_id)->first();
    }
}