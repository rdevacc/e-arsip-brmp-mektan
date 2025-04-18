<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveStatus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'type_id'
    ];

    /**
     * * Relationship from Archive Status to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
    
    /**
     * * Relationship from Archive Status to Archive*
     */
    public function archive_type(): BelongsTo
    {
        return $this->belongsTo(ArchiveType::class);
    }
}
