<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkGroup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'work_unit_id',
        'name'
    ];

     /**
     * * Relationship from Work Group to Work Unit Classification *
     */
    public function work_team(): BelongsTo
    {
        return $this->belongsTo(WorkTeam::class);
    }

     /**
     * * Relationship from Work Group to Work Team *
     */
    public function work_teams(): HasMany
    {
        return $this->hasMany(WorkGroup::class);
    }
    
     /**
     * * Relationship from Work Group to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
