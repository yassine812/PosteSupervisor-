<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('first_login')->default(true);
            $table->string('organization_name')->nullable();
            $table->string('organization_logo')->nullable();
            $table->string('timezone')->default('Africa/Tunis');
            $table->string('language')->default('fr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_login', 'organization_name', 'organization_logo', 'timezone', 'language']);
        });
    }
};
