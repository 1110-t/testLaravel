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
        Schema::create('biodetails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('bio_id');
            $table->date('date');
            $table->text('title');
            $table->boolean('date_display');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodetails');
    }
};
