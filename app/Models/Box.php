<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Box extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'shelf_row_id',
        'name'
    ];

    /**
     * * Relationship from Box to ShelfRow*
     */
    public function shelfRow(): BelongsTo
    {
        return $this->belongsTo(ShelfRow::class);
    }
    
    /**
     * * Relationship from Box to Folder*
     */
    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class);
    }
    
     /**
     * * Relationship from Box to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
