<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveRetention extends Model
{
    use HasFactory;
       
    protected $fillable = [
        'range'
    ];

    /**
     * * Relationship from Archive Public Access Level to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
