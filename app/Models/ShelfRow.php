<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShelfRow extends Model
{
    use HasFactory;
                 
    protected $fillable = [
        'shelf_id',
        'name'
    ];

    /**
     * * Relationship from ShelfRow to Shelf*
     */
    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    /**
     * * Relationship from ShelfRow to Box*
     */
    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class);
    }  

    /**
    * * Relationship from ShelfRow to Archive *
    */
   public function archives(): HasMany
   {
       return $this->hasMany(Archive::class);
   }
}
