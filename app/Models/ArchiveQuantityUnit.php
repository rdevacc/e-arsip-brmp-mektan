<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveQuantityUnit extends Model
{
    use HasFactory;
       
    protected $fillable = [
        'name'
    ];

    /**
     * * Relationship from Archive Quantity Unit to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
