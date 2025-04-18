<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('work_unit_id');
            $table->foreignId('work_group_id');
            $table->foreignId('work_team_id');
            $table->foreignId('work_team_classification_id');
            $table->foreignId('archive_retention_id');
            $table->foreignId('archive_type_id');
            $table->foreignId('archive_development_level_id');
            $table->foreignId('archive_media_id');
            $table->foreignId('archive_condition_id');
            $table->foreignId('archive_final_depreciation_action_id');
            $table->foreignId('archive_security_classification_id');
            $table->foreignId('archive_access_level_id');
            $table->foreignId('archive_public_access_level_id');
            $table->foreignId('archive_status_id');
            $table->foreignId('archive_quantity_unit_id');
            $table->foreignId('building_id');
            $table->foreignId('cabinet_id');
            $table->foreignId('shelf_id');
            $table->foreignId('shelf_row_id');
            $table->foreignId('box_id');
            $table->foreignId('folder_id');
            // $table->string('a_regnumber');
            $table->string('archive_letter_origin_number');
            $table->string('archive_description');
            $table->string('archive_lifespan');
            $table->integer('archive_number');
            $table->date('archive_input_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
