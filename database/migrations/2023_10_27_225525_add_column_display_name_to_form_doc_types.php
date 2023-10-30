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
        Schema::table('form_doc_types', function (Blueprint $table) {
            $table->string('display_name',80)->after('name');
            $table->string('route_name',80)->after('display_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_doc_types', function (Blueprint $table) {
            $table->dropColumn(['display_name', 'route_name']);
        });
    }
};
