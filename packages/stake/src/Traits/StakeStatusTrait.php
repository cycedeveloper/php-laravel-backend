<?php

namespace Sayedsoft\StakeToken\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Sayedsoft\ReferralIncome\Income\CreateReferralIncome;
use Sayedsoft\StakeToken\Helpers\SaveReferralIncome;
use Sayedsoft\StakeToken\Jobs\StakeStatusNotifyJob;

trait StakeStatusTrait
{
    public $statusus = ['pending','confirmed','ended','denied'];


    public function initializeStakeStatusTrait()
    {
        $this->appends[] = 'status_title';
        $this->appends[] = 'status_class';
    }

    public function getStatusTitleAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'Wait confirmation';
                break;
            case 'confirmed':
                return 'Confirmed';
                break;
            case 'denied':
                return 'Denied';
                break;
            case 'ended':
                return 'Ended';
                break;
            default:
                # code...
                break;
        }
    }

    public function getStatusClassAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'secondary';
                break;
            case 'confirmed':
                return 'success';
                break;
            case 'denied':
                return 'danger';
                break;
            case 'ended':
                return 'success';
                break;
        }
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeEnded($query)
    {
        return $query->where('status', 'ended');
    }

    public function scopeDenied($query)
    {
        return $query->where('status', 'denied');
    }


    private function updateStatus($status)
    {
        if (!in_array($status, $this->statusus)) {
            return  $this->returnError('Status is not found');
        }

        try {
            DB::beginTransaction();
            $this->status = $status;
            $this->save();
            $this->stakeDetails->save();

            StakeStatusNotifyJob::dispatch($this, $status);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
        }
    }

    public function end()
    {
        if ($this->status == 'end') {
            return;
        }

        if ($this->status != 'confirmed') {
            return  $this->returnError('Stake status must be setted as confirmed');
        }

        //Started_at
        $this->end_date = Carbon::now();

        $this->updateStatus('ended');
    }

    public function confirm()
    {
        if ($this->status != 'pending') {
            return  $this->returnError('Stake status must be setted as wait');
        }

        //Started_at
        $this->start_date = Carbon::now();

        $this->updateStatus('confirmed');

        SaveReferralIncome::save($this);
    }

    public function deny()
    {
        if ($this->status != 'pending') {
            return  $this->returnError('Stake status must be setted as denied');
        }

        //Started_at
        $this->end_date = Carbon::now();

        $this->updateStatus('denied');
    }

    private function returnError($m)
    {
        throw(new Exception($m));
    }
}
