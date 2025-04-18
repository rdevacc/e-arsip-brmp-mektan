<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

     /**
     * * Relationship from Work Unit to Work Group *
     */
    public function work_groups(): HasMany
    {
        return $this->hasMany(WorkGroup::class);
    }

     /**
     * * Relationship from Work Unit to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
