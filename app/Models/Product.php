<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Config;

class Product extends Model
{
    /**
     * @var int K_TO_PRICE - the dividen when price being converted to K annotation
     */
    const K_TO_PRICE = 1000;

    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'price',
        'code',
        'category',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['price_in_k', 'image_url', 'stock_final'];

    /**
     * convert the price into K annotation
     *
     * @return string
     */
    public function getPriceInKAttribute()
    {
        $k_price = (string)$this->price / self::K_TO_PRICE;
        return str_replace('.',',', $k_price) . 'K';
    }

    /**
     * @return string
     */
    public function getImageUrlAttribute()
    {
        $filename = $this->image;
        if(is_file(public_path('images/product') . '/' . $filename)){
            return asset('images/product/' . $filename);
        }

        return url('storage/profile/not-found.jpg');
    }

    /**
     * Get final stock of an product from product code
     *
     * @return int
     */
    public function getStockFinalAttribute(){
        return Stock::where('product_code', $this->code)->orderBy('id', 'DESC')->value('stock_final') ?? 0;
    }

}
