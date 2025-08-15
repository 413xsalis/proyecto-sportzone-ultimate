<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes(); // Esto añade la columna deleted_at como TIMESTAMP NULL
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Esto eliminará la columna
        });
    }
};
