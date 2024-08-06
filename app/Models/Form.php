<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'doc_ref_code',
        'doc_title',
        'division',
        'project',
        'owner',
        'status',
        'doc_type',
        'request_type',
        'request_reason',
        'request_date',
        'revision_num',
        'effectivity_date',
        'file',
        'type',
        'user_id',  // Assuming the form is linked to a user
    ];

    // If the form belongs to a user, define the relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
