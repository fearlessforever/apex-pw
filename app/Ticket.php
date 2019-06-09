<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\TicketPresenter;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use PresentableTrait;

    protected $presenter = TicketPresenter::class;

    const STATUS_PENDING = 1;
    const STATUS_WAITING_USER = 2;
    const STATUS_WAITING_STAFF = 3;
    const STATUS_RESOLVED = 4;

    protected $fillable = [
        'category_id',
        'subject',
        'message',
        'closed_at'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['category', 'user'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->ip_address = request()->ip();
        });
    }

    /**
     * A ticket belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Ticket belongs to an user.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }

    /**
     * Get ticket replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }

    /**
     * Add a reply to the ticket.
     *
     * @param array $reply
     *
     * @return Model
     */
    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        return $reply;
    }

    /**
     * Check if ticket is closed – mark as solved.
     *
     * @return boolean
     */
    public function isClosed()
    {
        return !is_null($this->closed_at);
    }
}
