<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveStoragePlace extends Model
{    
    use HasFactory;
                
    protected $fillable = [
        'archive_storage_location_id',
        'name'
    ];

    /**
     * * Relationship from Archive Storage Place to Storage Location*
     */
    public function archive_storage_location(): BelongsTo
    {
        return $this->belongsTo(ArchiveStorageLocation::class);
    }


    /**
     * * Relationship from Archive Storage Place to ShelfRow*
     */
    public function archive_shelfRows(): HasMany
    {
        return $this->hasMany(ArchiveShelfRow::class);
    }


    /**
     * * Relationship from Archive Storage Place to Folder*
     */
    public function archive_folders(): HasMany
    {
        return $this->hasMany(ArchiveFolder::class);
    }


     /**
     * * Relationship from Archive Storage Place to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}


