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
        Schema::create('condition_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('condition_type_field', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condition_type_id');
            $table->unsignedBigInteger('condition_field_id');
            $table->timestamps();

            $table->foreign('condition_type_id')->references('id')->on('condition_types')->onDelete('cascade');
            $table->foreign('condition_field_id')->references('id')->on('condition_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_type_field');
        Schema::dropIfExists('condition_fields');
    }
};
