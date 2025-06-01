<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveBox extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'archive_shelf_row_id',
        'name'
    ];

    /**
     * * Relationship from Box to ShelfRow*
     */
    public function archive_shelf_row(): BelongsTo
    {
        return $this->belongsTo(ArchiveShelfRow::class);
    }
    
    /**
     * * Relationship from Box to Folder*
     */
    public function archive_folders(): HasMany
    {
        return $this->hasMany(ArchiveFolder::class);
    }
    
     /**
     * * Relationship from Box to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
