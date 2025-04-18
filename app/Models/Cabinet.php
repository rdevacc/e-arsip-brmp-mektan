<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabinet extends Model
{
    use HasFactory;
                   
    protected $fillable = [
        'building_id',
        'name'
    ];

    /**
     * * Relationship from Cabinet to Shelf*
     */
    public function shelves(): HasMany
    {
        return $this->hasMany(Shelf::class);
    }
        
     /**
     * * Relationship from Cabinet to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
