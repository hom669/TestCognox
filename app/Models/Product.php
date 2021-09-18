<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_product
 * @property integer $id_size
 * @property integer $id_product_brand
 * @property string $product
 * @property string $observations
 * @property string $quantity
 * @property string $date_shipment
 * @property string $created_at
 * @property string $updated_at
 * @property ProductBrand $productBrand
 * @property Size $size
 */
class Product extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_product';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_size', 'id_product_brand', 'product', 'observations', 'quantity', 'date_shipment', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productBrand()
    {
        return $this->belongsTo('App\ProductBrand', 'id_product_brand', 'id_product_brand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size()
    {
        return $this->belongsTo('App\Size', 'id_size', 'id_size');
    }
}
