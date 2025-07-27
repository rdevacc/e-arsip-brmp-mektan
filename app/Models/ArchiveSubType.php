<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveSubType extends Model
{
    use HasFactory;

    protected $fillable = [
        'archive_type_id',
        'name',
    ];


    /**
     * * Relationship from Archive Subtype to Archive Type *
     */
    public function archive_type(): BelongsTo
    {
        return $this->belongsTo(ArchiveType::class);
    }

    
    /**
     * * Relationship from Archive Type to Archive Statuses*
     */
    public function archive_statuses(): HasMany
    {
        return $this->hasMany(ArchiveStatus::class);
    }
}
