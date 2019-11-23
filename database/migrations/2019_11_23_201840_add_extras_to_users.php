<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtrasToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('User');
            $table->integer('rank')->default('100');
            $table->string('title')->default('Filthy Casual');
            $table->string('profile_picture')->default("noimage.jpg");
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('rank');
            $table->dropColumn('title');
            $table->dropColumn('profile_picture');
            $table->dropColumn('gender');
            $table->dropColumn('city');
            $table->dropColumn('country');
        });
    }
}
