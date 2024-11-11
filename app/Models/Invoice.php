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
        'note', // other fields
    ];

    public function services()
    {
        return $this->hasMany(InvoiceService::class);
    }
}
