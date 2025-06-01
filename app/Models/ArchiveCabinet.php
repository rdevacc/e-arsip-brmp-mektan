<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveCabinet extends Model
{
    use HasFactory;
                   
    protected $fillable = [
        'archive_building_id',
        'name'
    ];

    /**
     * * Relationship from Cabinet to Building *
     */
    public function archive_building(): BelongsTo
    {
        return $this->belongsTo(ArchiveBuilding::class);
    }

    /**
     * * Relationship from Cabinet to Shelf *
     */
    public function archive_shelves(): HasMany
    {
        return $this->hasMany(ArchiveShelf::class);
    }
        
     /**
     * * Relationship from Cabinet to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
