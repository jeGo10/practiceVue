<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
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
        'archived_at'
    ];
}
