<?php
namespace Sayedsoft\Dex\Accounting\Models;



use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;


class AccountingTotal extends Model
{
    use TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_accounting_totals';
    
    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'amount',
        'type',
        'total_for'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->amount =  0;
        });
    }
    

    public function scopeTotalOf($query,$user_id,$token_id,$total_for) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id)->where('total_for',$total_for);
    }

    public function scopeTotalFor($query,$user_id,$token_id,$total_for) {
        return $query->where('total_for',$total_for);
    }
     
    public function scopeTotalIncomes($query,$user_id,$token_id) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id)->where('type','IN')->groupBy('user_id')->selectRaw('sum(amount) as total');
    }

    public function scopeTotalOutgoings($query,$user_id,$token_id) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id)->where('type','OUT')->groupBy('user_id')->selectRaw('sum(amount) as total');
    }

    public function scopeTotalDepts($query,$user_id,$token_id) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id)->where('type','DEPT')->groupBy('user_id')->selectRaw('sum(amount) as total');
    }

    public function setTotal ($amount) {
        $this->amount = $amount;
        $this->save();
    }

    
}
