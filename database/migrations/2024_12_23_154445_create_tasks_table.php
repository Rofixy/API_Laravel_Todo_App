<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_create_tasks_table.php
public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('task');
        $table->text('description');
        $table->date('due_date')->nullable();
        $table->timestamps();
    });
}
};
