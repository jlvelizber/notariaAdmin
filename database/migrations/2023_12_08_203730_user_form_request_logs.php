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
        Schema::create('user_form_request_logs', function(Blueprint $table) {
            $table->id();
            $table->unsignedInteger('form_request_id');
            $table->unsignedInteger('user_id');
            $table->enum('action',['create', 'update', 'delete','change_state'] );
            $table->string('description',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_form_request_logs');
    }
};
