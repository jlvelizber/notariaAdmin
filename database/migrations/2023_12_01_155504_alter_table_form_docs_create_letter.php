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
        Schema::table('form_docs', function (Blueprint $table){
            $table->text('affidavit')->nullable()->comment('carta_acta_notarial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_docs', function (Blueprint $table){
            $table->dropColumn('affidavit');
        });
    }
};
