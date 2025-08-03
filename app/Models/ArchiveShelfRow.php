<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveShelfRow extends Model
{
    use HasFactory;
                 
    protected $fillable = [
        'archive_storage_place_id',
        'name'
    ];

    /**
     * * Relationship from ShelfRow to Archive Storage Place *
     */
    public function archive_storage_place(): BelongsTo
    {
        return $this->belongsTo(ArchiveStoragePlace::class);
    }

    /**
     * * Relationship from ShelfRow to Box *
     */
    public function archive_boxes(): HasMany
    {
        return $this->hasMany(ArchiveBox::class);
    }  

    /**
    * * Relationship from ShelfRow to Archive *
    */
   public function archives(): HasMany
   {
       return $this->hasMany(Archive::class);
   }
}
