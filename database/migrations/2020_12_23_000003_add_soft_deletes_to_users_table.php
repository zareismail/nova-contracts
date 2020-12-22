<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zareismail\NovaContracts\Models\User;

class AddSoftDeletesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasColumn('users', 'deleted_at') || 
        Schema::table('users', function (Blueprint $table) { 
            $table->softDeletes(); 
        });  

        User::whereEmail('zarehesmaiel@gmail.com')->first() ||

        (new User)->forceFill([
            'name'  => 'zareismail',
            'email' => 'zarehesmaiel@gmail.com',
            'password'  => bcrypt('Zareh@1371'),
            'profile'   => [],
            'mobile'    => '09010509130',
            'email_verified_at' => now(),
        ])->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('users', function (Blueprint $table) {  
            $table->dropSoftDeletes();
        });  
    }
}
