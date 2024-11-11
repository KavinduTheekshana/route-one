<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'date',
        'customer_id',
        'user_id',
        'subtotal',
        'tax',
        'total_fee',
        'note',
        'tax_rate' // other fields
    ];

    public function services()
    {
        return $this->hasMany(InvoiceService::class);
    }

    public function customer()
    {
        return $this->belongsTo(Application::class, 'customer_id', 'user_id');
    }
}
