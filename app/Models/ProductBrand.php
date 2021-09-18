<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_product_brand
 * @property string $product_brand
 * @property string $reference
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 */
class ProductBrand extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_brand';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_product_brand';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['product_brand', 'reference', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'id_product_brand', 'id_product_brand');
    }
}
