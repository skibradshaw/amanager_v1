<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    protected $table = 'bank_deposits';
    protected $fillable = ['user_id','bank_account_id','deposit_date','transaction_id','amount'];
    protected $dates = ['deposit_date'];

    public function payments()
    {
        return $this->hasMany('App\Payment', 'bank_deposits_id');
    }
}
