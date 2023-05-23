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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sector_id');
            $table->string('logo');
            $table->string('name');
            $table->string('owner_name');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('sector_id')->references('id')->on('sector');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
