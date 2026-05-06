<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'id_number',
        'address',
        'is_deleted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
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
    }

    /**
     * Get all bookings for this guest.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the guest's active bookings.
     */
    public function activeBookings(): HasMany
    {
        return $this->hasMany(Booking::class)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('check_out', '>=', now());
    }

    /**
     * Get the guest's past bookings.
     */
    public function pastBookings(): HasMany
    {
        return $this->hasMany(Booking::class)
            ->where('check_out', '<', now());
    }
}
