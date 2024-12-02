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

{
    Schema::create('diseases', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // اسم المرض
        $table->json('symptoms')->nullable(); // الأعراض
        $table->json('factors')->nullable(); // العوامل
        $table->text('treatment')->nullable(); // العلاج
        $table->json('affected_plants')->nullable(); // النباتات المتأثرة
        $table->timestamps(); // created_at و updated_at
    });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
