<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CosDraft extends Model
{
    protected $fillable = [
        'application_id',
        'sponsor_license_number',
        'sponsor_name',
        'certificate_number',
        'status',
        'current_certificate_status_date',
        'date_assign',
        'expire_date',
        'sponsor_note',
        'family_name',
        'given_name',
        'Other_names',
        'nationality',
        'place_of_birth',
        'country_of_birth',
        'dob',
        'gender',
        'country_of_residence',
        'passport',
        'issue_date',
        'expiry_date',
        'place_of_issue',
        'address',
        'city',
        'postcode',
        'country',
        'county',
        'start_date',
        'end_date',
        'hours_of_work',
        'job_title',
        'job_type',
        'description',
        'salary',
        'paye_reference',
        'barcode',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
