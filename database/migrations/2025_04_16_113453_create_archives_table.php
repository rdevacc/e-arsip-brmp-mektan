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
            $table->foreignId('user_id')->nullable(true);
            $table->foreignId('work_unit_id')->nullable(true);
            $table->foreignId('work_group_id')->nullable(true);
            $table->foreignId('work_team_id')->nullable(true);
            $table->foreignId('work_team_classification_id')->nullable(true);
            $table->foreignId('archive_retention_id')->nullable(true);
            $table->foreignId('archive_type_id')->nullable(true);
            $table->foreignId('archive_development_level_id')->nullable(true);
            $table->foreignId('archive_media_id')->nullable(true);
            $table->foreignId('archive_condition_id')->nullable(true);
            $table->foreignId('archive_final_depreciation_action_id')->nullable(true);
            $table->foreignId('archive_security_classification_id')->nullable(true);
            $table->foreignId('archive_access_level_id')->nullable(true);
            $table->foreignId('archive_public_access_level_id')->nullable(true);
            $table->foreignId('archive_status_id')->nullable(true);
            $table->foreignId('archive_quantity_unit_id')->nullable(true);
            $table->foreignId('building_id')->nullable(true);
            $table->foreignId('cabinet_id')->nullable(true);
            $table->foreignId('shelf_id')->nullable(true);
            $table->foreignId('shelf_row_id')->nullable(true);
            $table->foreignId('box_id')->nullable(true);
            $table->foreignId('folder_id')->nullable(true);
            // $table->string('a_regnumber');
            $table->string('archive_letter_origin_number')->nullable(true);
            $table->text('archive_description')->nullable(true);
            $table->string('archive_lifespan')->nullable(true);
            $table->integer('archive_number')->nullable(true);
            $table->date('archive_input_date')->nullable(true);
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
