<?php
namespace Sayedsoft\DexwithdrawalFiat\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Sayedsoft\DexwithdrawalFiat\Jobs\withdrawalFiatStatusNotifyJob;

trait withdrawalFiatStatusTrait
{   

    public $statusus = ['pending','confirmed','denied'];

    public function initializewithdrawalFiatStatusTrait()
    {
        $this->appends[] = 'status_title';
        $this->appends[] = 'status_class';
    }

    public function scopePending($query) {
        return $query->where('status','pending');
    }

    public function scopeConfirmed($query) {
        return $query->where('status','confirmed');
    }

    public function scopeDenied($query) {
        return $query->where('status','denied');
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
            default:
                # code...
                break;
        }
    }

    
    private function updateStatus ($status) {
        if (!in_array($status,$this->statusus)) {
            return  $this->returnError('Status is not found');
        }
       
        try {
            DB::beginTransaction();
                $this->status = $status; 
                $this->save();          
                
                withdrawalFiatStatusNotifyJob::dispatch($this,$status)->afterCommit()->delay(\Carbon\Carbon::now()->addSeconds(10));
            DB::commit();
       } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
       }
    }

    public function confirm () {
        if ($this->status != 'pending') {
           return  $this->returnError('withdrawalFiat request status must be setted as pending');
        }
        $this->updateStatus('confirmed');
        
    }
    
    public function deny () {
        if ($this->status != 'pending') {
           return  $this->returnError('withdrawalFiat request is not pending!');
        }
        
        $this->updateStatus('denied');
    }


    public function isDeneid() {
        return ($this->status !== 'denied') ? false : true;
    }

    public function isCanceled() {
        return ($this->status !== 'canceled') ? false : true;
    }

    public function isComfirmed() {
        return ($this->status !== 'confirmed') ? false : true;
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
                
            
            default:
                # code...
                break;
        }
    }

    public function returnError ($message) {
        throw new Exception($message, 1);
     }

}
