<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkTeamClassification extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'work_team_id',
        'name'
    ];

     /**
     * * Relationship from Work Team Classification to Work Group *
     */
    public function work_team(): BelongsTo
    {
        return $this->belongsTo(WorkTeam::class);
    }
    
     /**
     * * Relationship from Work Team Classification to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
