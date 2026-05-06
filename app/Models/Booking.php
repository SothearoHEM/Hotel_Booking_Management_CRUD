<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'guest_id',
        'check_in',
        'check_out',
        'total_cost',
        'status',
        'notes',
        'is_deleted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_cost' => 'decimal:2',
        'is_deleted' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->where('is_deleted', 0);
        });

        static::deleting(function ($model) {
            $model->is_deleted = 1;
            $model->save();

            return false;
        });

        static::creating(function ($booking) {
            if (! $booking->total_cost) {
                $booking->total_cost = self::calculateTotalCost(
                    $booking->room_id,
                    $booking->check_in,
                    $booking->check_out
                );
            }
        });

        static::updating(function ($booking) {
            if ($booking->isDirty(['room_id', 'check_in', 'check_out'])) {
                $booking->total_cost = self::calculateTotalCost(
                    $booking->room_id,
                    $booking->check_in,
                    $booking->check_out
                );
            }
        });
    }

    /**
     * Get the room that this booking belongs to.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the guest that this booking belongs to.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Calculate the number of nights for this booking.
     */
    public function getNumberOfNightsAttribute(): int
    {
        return Carbon::parse($this->check_in)
            ->diffInDays(Carbon::parse($this->check_out));
    }

    /**
     * Calculate the total cost based on room price and nights.
     */
    public static function calculateTotalCost(int $roomId, string $checkIn, string $checkOut): float
    {
        $room = Room::findOrFail($roomId);
        $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));

        return $room->price_per_night * $nights;
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to only include active bookings.
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed'])
            ->where('check_out', '>=', now());
    }
}
