<?php

use App\Models\User;
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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('coupon')->default(0);
            $table->string('foodParty')->nullable();
            $table->string('ingredients');
            $table->string('foodCategory');
            $table->string('image');
            $table->foreignIdFor(User::class)->constrained();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->morphs('categoryable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
};
