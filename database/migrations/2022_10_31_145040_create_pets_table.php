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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('nickname')->nullable();
            $table->text('note')->nullable();
            $table->integer('type')->default(1)->comment('1 - dog | 2 - cat | 3 - pig | 4 - rabbit | 5 - chicken | 6 - bird | 7 - horse | 8 - other');
            $table->string('breed')->nullable();
            $table->integer('gender')->nullable()->default(1)->comment('1 - male | 2 - female');
            $table->date('dob')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('puppy')->nullable()->default(0)->comment('1 - yes | 0 - no');
            $table->string('color')->nullable();
            $table->integer('sterilised')->nullable()->default(0);
            $table->string('allergies')->nullable();
            $table->integer('vaccinated')->nullable()->default(0);
            $table->string('health_issues')->nullable();
            $table->string('therapy')->nullable();
            $table->integer('food_type')->nullable()->default(3)->comment('1 - human_food | 2 - pellets | 3 - mix');
            $table->integer('socialized')->nullable()->default(0)->comment('1 - yes | 0 - no');
            $table->string('vet_name')->nullable();
            $table->string('vet_contact')->nullable();
            $table->string('other_emergency_contacts')->nullable();
            $table->integer('reward')->nullable()->default(0)->comment('0 - no | 1 - yes');
            $table->string('reward_fee')->nullable();
            $table->integer('missing')->default(0)->comment('0 - no | 1 missing');
            $table->integer('status')->default(0)->comment('1 - active | 0 inactive');
            $table->string('token')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
