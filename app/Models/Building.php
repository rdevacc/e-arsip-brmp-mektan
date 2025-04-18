<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;
         
    protected $fillable = [
        'name'
    ];

    /**
     * * Relationship from Building to Cabinet*
     */
    public function cabinets(): HasMany
    {
        return $this->hasMany(Cabinet::class);
    }

    /**
     * * Relationship from Building to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
