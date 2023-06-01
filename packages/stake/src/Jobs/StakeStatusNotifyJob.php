<?php

namespace Sayedsoft\StakeToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\StakeToken\Notifications\StakeStatusNotify;

class StakeStatusNotifyJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $after_commit = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $stake;
    protected $status;

    public function __construct($stake, $status)
    {
        //
        $this->stake = $stake;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if (!config('dex.mailnotify')) {
            return;
        }
        $this->stake->user->notify((new StakeStatusNotify($this->stake, $this->status))->afterCommit());
    }
}
