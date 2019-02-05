<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Facades\App\Services\Payments\PaymentFactory;

class PaymentGateway extends Model
{
    /**
     * Boot.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    /**
     * Get enabled payment gateways.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeByEnabled($query)
    {
        return $query->whereEnabled(true);
    }

    /**
     * Get payment gateway by slug.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug Payment Gateway's slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeBySlug($query, $name)
    {
        return $query->whereName(str_slug($name));
    }

    /**
     *  Handle Payment Gateway's transaction.
     */
    public function payment()
    {
        return PaymentFactory::process($this->name);
    }
}
