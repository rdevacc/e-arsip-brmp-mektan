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
        'archive_storage_location_id',
        'name'
    ];

    /**
     * * Relationship from ShelfRow to Archive Storage Location *
     */
    public function archive_storage_location(): BelongsTo
    {
        return $this->belongsTo(ArchiveStorageLocation::class);
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
