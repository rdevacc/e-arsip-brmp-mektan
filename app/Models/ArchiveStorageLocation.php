<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveStorageLocation extends Model
{
    use HasFactory;
                
    protected $fillable = [
        'archive_building_id',
        'name'
    ];


    /**
     * * Relationship from Archive Storage Location to Building*
     */
    public function archive_building(): BelongsTo
    {
        return $this->belongsTo(ArchiveShelfRow::class);
    }


    /**
     * * Relationship from Archive Storage Location to ShelfRow*
     */
    public function archive_shelfRows(): HasMany
    {
        return $this->hasMany(ArchiveShelfRow::class);
    }


    /**
     * * Relationship from Archive Storage Location to Folder*
     */
    public function archive_folders(): HasMany
    {
        return $this->hasMany(ArchiveFolder::class);
    }


     /**
     * * Relationship from Archive Storage Location to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}