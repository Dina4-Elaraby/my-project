<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'status')) {
            $table->string('status')->default('user');
        }
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'status')) {
            $table->dropColumn('status');
        }
    });
}


// <!--
 

// // use Illuminate\Database\Migrations\Migration;
// // use Illuminate\Database\Schema\Blueprint;
// // use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->string('status')->default('user');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('users', function (Blueprint $table) {
//             //
//         });
//     }
// }; -->
};