<?php
namespace Sayedsoft\DexAuthReferral\Listeners;




use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;
use Sayedsoft\ReferralUnilevel\Jobs\NewChildJob;

class LogVerifiedUser implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    } 

    /**
     * Handle the event.
     *
     * @param  App\Events\LogVerifiedUserEvent  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        //
        NewChildJob::dispatch($event);
    }
}
