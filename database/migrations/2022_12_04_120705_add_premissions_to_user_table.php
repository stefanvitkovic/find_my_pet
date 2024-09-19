<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('share_address')->after('admin')->default(1)->nullable();
            $table->integer('share_contact')->after('admin')->default(1)->nullable();
            $table->integer('share_other_contact')->after('admin')->default(1)->nullable();
            $table->integer('share_name')->after('admin')->default(1)->nullable();    
            $table->integer('share_vet_info')->after('admin')->default(1)->nullable();      
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
            $table->dropColumn('share_address');
            $table->dropColumn('share_contact');
            $table->dropColumn('share_other_contact');
            $table->dropColumn('share_name');
            $table->dropColumn('share_vet_info');
        });
    }
};
