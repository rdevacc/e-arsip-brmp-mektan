<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveDevelopmentLevel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

    /**
     * * Relationship from Archive Development Level to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
