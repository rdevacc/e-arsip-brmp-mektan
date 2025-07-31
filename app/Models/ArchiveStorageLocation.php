<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveStorageLocation extends Model
{
    use HasFactory;
                
    protected $fillable = [
        'name'
    ];


    /**
     * * Relationship from Archive Storage Location to Storage Places*
     */
    public function archive_storage_places(): HasMany
    {
        return $this->hasMany(ArchiveStoragePlace::class);
    }

     /**
     * * Relationship from Archive Storage Location to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}