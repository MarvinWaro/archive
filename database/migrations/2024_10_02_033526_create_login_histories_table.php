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
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user_id (Foreign Key)
            $table->timestamp('logged_in_at')->useCurrent();                   // Login time
            $table->string('ip_address')->nullable();                          // IP Address
            $table->string('browser')->nullable();                             // Browser Info
            $table->string('os')->nullable();                                  // Operating System Info
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('login_histories', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'browser', 'os']);
        });
    }

};
