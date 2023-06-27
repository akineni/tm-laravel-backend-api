<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('tasks', function(Blueprint $table){
            $table->boolean('completed')->default(false)->change();
            $table->renameColumn('task_deadline', 'deadline');
        });
    }
};
