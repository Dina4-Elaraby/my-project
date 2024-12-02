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
        Schema::create('plants', function (Blueprint $table)
         {
            $table->id();
            $table->string('scientific_name'); 
            $table->string('common_name'); 
            $table->string('plant_family'); 
            $table->text('care_instructions');
            $table->timestamp('created_at')->nullable();

         
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plants', function (Blueprint $table) 
        {
            $table->dropTimestamps();
        });
    }
};
