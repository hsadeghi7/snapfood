<?php

use App\Models\Restaurant;
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
            $table->string('foodParty')->default(null);
            $table->string('ingredients');
            $table->string('foodCategory');
            $table->string('image');
            $table->foreignIdFor(Restaurant::class)->constrained();
            $table->string('restaurant_id')->default(null);
            // $table->boolean('is_active')->default(true);
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
