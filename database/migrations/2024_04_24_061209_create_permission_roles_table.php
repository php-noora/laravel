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
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['role_id', 'permission_id']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_roles');
    }
};
