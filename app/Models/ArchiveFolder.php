<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveFolder extends Model
{
    use HasFactory;
                           
    protected $fillable = [
        'archive_box_id',
        'name'
    ];

    /**
     * * Relationship from Folder to Box*
     */
    public function archive_box(): BelongsTo
    {
        return $this->belongsTo(ArchiveBox::class);
    }
        
     /**
     * * Relationship from Folder to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
