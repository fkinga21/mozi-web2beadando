<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('film', function (Blueprint $table) {
        $table->id();
        $table->string('cim');
        $table->integer('ev');
        $table->integer('hossz');
    });
}

    public function down(): void
{
    Schema::dropIfExists('film');
}
};
