<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelf extends Model
{
    use HasFactory;
                
    protected $fillable = [
        'cabinet_id',
        'name'
    ];

    /**
     * * Relationship from Shelf to Cabinet*
     */
    public function cabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class);
    }

    /**
     * * Relationship from Shelf to ShelfRow*
     */
    public function shelfRows(): HasMany
    {
        return $this->hasMany(ShelfRow::class);
    }

     /**
     * * Relationship from Shelf to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
