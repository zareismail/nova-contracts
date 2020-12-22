<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zareismail\NovaContracts\Models\User;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('mobile', 15)->nullable()->unique()->index();  
            $table->json('profile')->nullable(); 
            $table->softDeletes(); 
        });

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
            $table->dropColumn('mobile', 'profile');
        });  
    }
}
