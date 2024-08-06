<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('doc_ref_code');
            $table->string('doc_title');
            $table->string('division');
            $table->string('project');
            $table->string('owner');
            $table->boolean('status');
            $table->string('doc_type');
            $table->string('request_type');
            $table->string('request_reason');
            $table->date('request_date');
            $table->integer('revision_num');
            $table->date('effectivity_date');
            $table->string('file');
            $table->string('type');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // If forms are related to users
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
