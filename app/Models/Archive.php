<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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
        'archive_development_level_id',
        'archive_media_id',
        'archive_condition_id',
        'archive_final_depreciation_action_id',
        'archive_security_classification_id',
        'archive_access_level_id',
        'archive_public_access_level_id',
        'archive_type_id',
        'archive_subtype_id',
        'archive_status_id',
        'archive_quantity_unit_id',
        'archive_letter_origin_number',
        'archive_classification_description',
        'archive_description',
        'archive_lifespan',
        'archive_number',
        'archive_input_date',
        'period_id',
        'year_period',
        'additional_information',
        'archive_storage_location_id',
        'archive_storage_place_id',
        'archive_shelf_row_id',
        'archive_box_id',
        'archive_folder_id',
        'created_by',
        'updated_by',
    ];

    /**
     * * Event untuk otomatis mengisi created_by dan updated_by *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($archive) {
            if (Auth::check()) {
                $archive->created_by = Auth::id();
                $archive->updated_by = Auth::id();
            }
        });

        static::updating(function ($archive) {
            if (Auth::check()) {
                $archive->updated_by = Auth::id();
            }
        });
    }

    /**
     * * Relationship from Archive to User*
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke user yang membuat arsip
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke user yang terakhir mengupdate arsip
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
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
     * * Relationship from Archive to Archive Type*
     */
    public function archive_type(): BelongsTo
    {
        return $this->belongsTo(ArchiveType::class);
    }

    /**
     * * Relationship from Archive to Archive Type*
     */
    public function archive_subtype(): BelongsTo
    {
        return $this->belongsTo(ArchiveSubType::class);
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
     * * Relationship from Archive to Period*
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * * Relationship from Archive to Storage Place*
     */
    public function archive_storage_place(): BelongsTo
    {
        return $this->belongsTo(ArchiveStoragePlace::class);
    }

    /**
     * * Relationship from Archive to Storage Location*
     */
    public function archive_storage_location(): BelongsTo
    {
        return $this->belongsTo(ArchiveStorageLocation::class);
    }

    /**
     * * Relationship from Archive to Shelf Row*
     */
    public function archive_shelf_row(): BelongsTo
    {
        return $this->belongsTo(ArchiveShelfRow::class);
    }

    /**
     * * Relationship from Archive to Box*
     */
    public function archive_box(): BelongsTo
    {
        return $this->belongsTo(ArchiveBox::class);
    }

    /**
     * * Relationship from Archive to Folder*
     */
    public function archive_folder(): BelongsTo
    {
        return $this->belongsTo(ArchiveFolder::class);
    }
}
