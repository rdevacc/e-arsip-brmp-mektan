<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveShelf extends Model
{
    use HasFactory;
                
    protected $fillable = [
        'archive_cabinet_id',
        'name'
    ];

    /**
     * * Relationship from Shelf to Cabinet*
     */
    public function archive_cabinet(): BelongsTo
    {
        return $this->belongsTo(ArchiveCabinet::class);
    }

    /**
     * * Relationship from Shelf to ShelfRow*
     */
    public function archive_shelfRows(): HasMany
    {
        return $this->hasMany(ArchiveShelfRow::class);
    }

     /**
     * * Relationship from Shelf to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
