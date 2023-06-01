<?php

namespace Sayedsoft\StakeToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\StakeToken\Notifications\StakeCreatedNotify;

class StakeCreatedNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $after_commit = true;

    
    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $stake;

    public function __construct($stake)
    {
        //
        $this->stake = $stake;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if (!config('dex.mailnotify')) { return; }
        $this->stake->user->notify((new StakeCreatedNotify($this->stake))->afterCommit());
    }
}
