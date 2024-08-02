<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        "division_id",
        "title",
        "status",
    ];
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
