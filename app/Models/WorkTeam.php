<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkTeam extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'work_group_id',
        'name'
    ];

     /**
     * * Relationship from Work Team to Work Group *
     */
    public function work_group(): BelongsTo
    {
        return $this->belongsTo(WorkGroup::class);
    }

     /**
     * * Relationship from Work Team to Work Team Classification *
     */
    public function work_team_classifications(): HasMany
    {
        return $this->hasMany(WorkTeamClassification::class);
    }
    
     /**
     * * Relationship from Work Team to Archive *
     */
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
