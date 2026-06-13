<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function statusLabel()
    {
        if ($this->status === 'pending') {
            return 'Oczekujące';
        } elseif ($this->status === 'processing') {
            return 'W realizacji';
        } elseif ($this->status === 'shipped') {
            return 'Wysłane';
        } elseif ($this->status === 'delivered') {
            return 'Dostarczone';
        } elseif ($this->status === 'cancelled') {
            return 'Anulowane';
        } else {
            return $this->status;
        }
    }

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_name',
        'shipping_address',
        'shipping_postal_code',
        'shipping_city',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
