<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;
                           
    protected $fillable = [
        'box_id',
        'name'
    ];

    /**
     * * Relationship from Folder to Box*
     */
    public function box(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }
        
     /**
     * * Relationship from Folder to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
