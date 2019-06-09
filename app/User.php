<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'truename', 'email', 'passwd',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passwd', 'passwd2', 'remember_token',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['orders'];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->passwd;
    }

    /**
     * Get all user's donations.
     */
    public function donations()
    {
        return $this->hasMany(Donate::class);
    }

    /**
     * Alias to donations.
     *
     * @return void
     */
    public function orders()
    {
        return $this->donations();
    }

    /**
     * Get all tickets for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get user by the given login.
     *
     */
    public static function findByLogin(string $login)
    {
        return self::whereName($login)->first();
    }

    /**
     * Add cubi gold to the given user.
     *
     * @param int $user User ID
     * @param int $amount The amount of cash
     * @param int $zoneid Server zoneid/aid (Must match your gdeliveryd's gamesys.conf settings).
     * @return void
     */
    public static function addcash(int $user, int $amount, int $zoneid = 1)
    {
        $data = [$user, $zoneid, 0, $zoneid, 0, $amount * 100, 1];

        return DB::statement('CALL usecash (?, ?, ? ,?, ?, ?, ?, @error)', $data);
    }
}
