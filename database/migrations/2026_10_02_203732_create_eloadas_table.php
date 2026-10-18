<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::create('eloadas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('filmid');
        $table->unsignedBigInteger('moziid');
        $table->date('datum');
        $table->integer('nezoszam');
        $table->integer('bevetel');

        $table->foreign('filmid')->references('id')->on('film');
        $table->foreign('moziid')->references('id')->on('mozi');
    });
}

    public function down(): void
{
    Schema::dropIfExists('eloadas');
}
};
