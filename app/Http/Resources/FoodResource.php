<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $foodCategory = Category::getFoodCategories();
//TODO نحوه نمایش دسته بندی غذاهای هر رستوران بر اساس دسته بندی
        return
            $this->mergeWhen(
                in_array($this->food->foodCategory, $foodCategory) == true,
                [
                    $this->food->foodCategory =>
                    [
                        'id' => $this->food->id,
                        'title' => $this->food->name,
                        'category' => $this->food->foodCategory,
                        'price' => $this->food->price * 100,
                        'image' => $this->food->image,
                        'discount' => $this->coupon . '%',
                        'is_food_party' => $this->foodParty ? true : false,
                    ]
                ]
            );
    }
}
