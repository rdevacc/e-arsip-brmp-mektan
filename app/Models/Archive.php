<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_unit_id',
        'work_group_id',
        'work_team_id',
        'work_team_classification_id',
        'archive_retention_id',
        'archive_type_id',
        'archive_development_level_id',
        'archive_media_id',
        'archive_condition_id',
        'archive_final_depreciation_action_id',
        'archive_security_classification_id',
        'archive_access_level_id',
        'archive_public_access_level_id',
        'archive_status_id',
        'archive_quantity_unit_id',
        'archive_letter_origin_number',
        'archive_description',
        'archive_lifespan',
        'archive_number',
        'archive_input_date',
        'building_id',
        'cabinet_id',
        'shelf_id',
        'shelf_row_id',
        'box_id',
        'folder_id',
    ];

    /**
     * * Relationship from Archive to User*
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * * Relationship from Archive to Work Unit*
     */
    public function work_unit(): BelongsTo
    {
        return $this->belongsTo(WorkUnit::class);
    }

    /**
     * * Relationship from Archive to Work Group*
     */
    public function work_group(): BelongsTo
    {
        return $this->belongsTo(WorkGroup::class);
    }

    /**
     * * Relationship from Archive to Work Team*
     */
    public function work_team(): BelongsTo
    {
        return $this->belongsTo(WorkTeam::class);
    }

    /**
     * * Relationship from Archive to Work Team Classification*
     */
    public function work_team_classification(): BelongsTo
    {
        return $this->belongsTo(WorkTeamClassification::class);
    }

    /**
     * * Relationship from Archive to Archive Retention*
     */
    public function retention(): BelongsTo
    {
        return $this->belongsTo(ArchiveRetention::class);
    }

    /**
     * * Relationship from Archive to Archive Type*
     */
    public function archive_type(): BelongsTo
    {
        return $this->belongsTo(ArchiveType::class);
    }

    /**
     * * Relationship from Archive to Archive Development Level*
     */
    public function archive_development_level(): BelongsTo
    {
        return $this->belongsTo(ArchiveDevelopmentLevel::class);
    }

    /**
     * * Relationship from Archive to Archive Media*
     */
    public function archive_media(): BelongsTo
    {
        return $this->belongsTo(ArchiveMedia::class);
    }

    /**
     * * Relationship from Archive to Archive Condition*
     */
    public function archive_condition(): BelongsTo
    {
        return $this->belongsTo(ArchiveCondition::class);
    }

    /**
     * * Relationship from Archive to Archive Final Depreciation Action*
     */
    public function archive_final_depreciation_action(): BelongsTo
    {
        return $this->belongsTo(ArchiveFinalDepreciationAction::class);
    }

    /**
     * * Relationship from Archive to Archive Security Class*
     */
    public function archive_security_classification(): BelongsTo
    {
        return $this->belongsTo(ArchiveSecurityClassification::class);
    }

    /**
     * * Relationship from Archive to Archive Access Level*
     */
    public function archive_access_level(): BelongsTo
    {
        return $this->belongsTo(ArchiveAccessLevel::class);
    }

    /**
     * * Relationship from Archive to Archive Public Access Level*
     */
    public function archive_public_access_level(): BelongsTo
    {
        return $this->belongsTo(ArchivePublicAccessLevel::class);
    }

    /**
     * * Relationship from Archive to Archive Status*
     */
    public function archive_status(): BelongsTo
    {
        return $this->belongsTo(ArchiveStatus::class);
    }

    /**
     * * Relationship from Archive to Archive Status*
     */
    public function archive_quantity_unit(): BelongsTo
    {
        return $this->belongsTo(ArchiveQuantityUnit::class);
    }

    /**
     * * Relationship from Archive to Building*
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * * Relationship from Archive to Cabinet*
     */
    public function cabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class);
    }

    /**
     * * Relationship from Archive to Shelf*
     */
    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    /**
     * * Relationship from Archive to Shelf Row*
     */
    public function shelf_row(): BelongsTo
    {
        return $this->belongsTo(ShelfRow::class);
    }

    /**
     * * Relationship from Archive to Box*
     */
    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    /**
     * * Relationship from Archive to Folder*
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
