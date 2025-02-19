<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('id')->change();
            $table->string('fullname')->after('id');
            $table->string('username')->unique()->after('fullname');
            $table->string('avatar')->nullable()->after('password');
            $table->enum('role', ['admin', 'user'])->default('user')->after('avatar');
            $table->boolean('active')->default(1)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fullname', 'username', 'avatar', 'role', 'active']);
        });
    }
};
