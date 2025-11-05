<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulkMailLog extends Model
{
    protected $fillable = [
        'batch_id',
        'recipient_name',
        'recipient_email',
        'subject',
        'body',
        'status',
        'error_message',
        'sent_by'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
