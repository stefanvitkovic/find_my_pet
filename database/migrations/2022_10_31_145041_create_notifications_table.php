<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');            
                        
            $table->integer('sender_id')->unsigned(); 
            $table->integer('receiver_id')->unsigned(); 

            $table->string('type', 12)->nullable(); 
            $table->string('template')->nullable(); 
            $table->string('receiver')->nullable(); 
            $table->string('subject')->nullable(); 
            $table->text('content')->nullable(); 

            $table->smallInteger('processed')->unsigned()->default(0); 
            $table->smallInteger('delivered')->unsigned()->default(0);
            $table->smallInteger('read')->unsigned()->default(0);
            
            $table->string('status')->nullable(); 

            $table->string('sub_type')->nullable();
            $table->string('additional_id')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('message')->nullable();
            $table->integer('cms')->nullable();
         
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
