<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Stock extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id',
        'product_name',
        'product_code',
        'stock_initial',
        'stock_in',
        'stock_out',
        'stock_final',
        'price'
    ];

    /**
     * Relations to Staff Model
     *
     * @return BelongsTo
     */
    public function staff(){
        return $this->belongsTo(Staff::class);
    }

}
