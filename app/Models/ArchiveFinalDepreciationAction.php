<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveFinalDepreciationAction extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'name'
    ];

    /**
     * * Relationship from Archive Final Depreciation Action to Archive*
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
