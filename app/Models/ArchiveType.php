<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

    /**
     * * Relationship from Archive Type to Archive*
     */
    public function archive_statuses(): HasMany
    {
        return $this->hasMany(ArchiveStatus::class);
    }

    /**
     * * Relationship from Archive Type to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
