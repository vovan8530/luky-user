<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lucky extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lucky_number',
        'winning_number',
        'user_id',
    ];

    /**
     * @var string
     */
    protected $table = 'lucky';

    /**
     * @return BelongsTo
     */
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
