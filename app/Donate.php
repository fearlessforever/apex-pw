<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\DonatePresenter;

class Donate extends Model
{
    use PresentableTrait;

    protected $presenter = DonatePresenter::class;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'package_id', 'gateway_id', 'transaction_reference'
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'data' => 'array',
    ];

     /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['gateway', 'package'];

    /**
     * Get donate by transaction reference.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $reference Transaction Reference
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeByReference($query, $reference)
    {
        return $query->whereTransactionReference($reference);
    }

    /**
     * Donate belongs to an user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }

    /**
     * Get cash package.
     */
    public function package()
    {
        return $this->belongsTo(CashPackage::class, 'package_id');
    }

    /**
     * Get payment gateway.
     */
    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'gateway_id');
    }

    /**
     * Check if the donate cash was delivered to the user.
     */
    public function wasDelivered()
    {
        return !is_null($this->delivered_at);
    }
}
