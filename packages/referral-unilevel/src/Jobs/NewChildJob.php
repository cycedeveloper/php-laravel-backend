<?php
namespace Sayedsoft\ReferralUnilevel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;
use Sayedsoft\ReferralUnilevel\Helpers\NewChild;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

class NewChildJob implements ShouldQueue 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {   
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newUser  = $this->user->user;
        
        NewChild::new($newUser);
    }
}
