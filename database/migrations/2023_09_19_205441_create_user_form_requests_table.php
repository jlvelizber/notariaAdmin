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
        Schema::create('user_form_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('form_request_body');
            $table->integer('form_doc_id');
            $table->integer('status_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'user_id',
                'form_doc_id',
                'status_id'
            ]);

            // $table->foreign('user_id')->on('users');
            // $table->foreign('form_doc_id')->on('form_docs');
            // $table->foreign('status_id')->on('user_form_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_form_requests');
    }
};
