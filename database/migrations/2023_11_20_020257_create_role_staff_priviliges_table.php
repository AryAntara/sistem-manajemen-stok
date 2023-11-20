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
        Schema::create('role_staff_priviliges', function (Blueprint $table) {
            // $table->id();
            $table->unsignedInteger('id_role_staffs');
            $table->enum('action', [
                'read',
                'update',
                'delete',
                'edit'
            ]);
            $table->unsignedInteger('id_menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_staff_priviliges');
    }
};
