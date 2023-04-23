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
        Schema::create('kafka_permission_staff_page', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('permission_id');
            $table->integer('order');
            $table->foreign('permission_id')->references('id')->on('permissions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kafka_permission_staff_page');
    }
};
