<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_transactions
 * @property integer $id_account_from
 * @property integer $id_account_up
 * @property int $amount
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 * @property Account $account
 */
class Transaction extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_transactions';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_account_from', 'id_account_up', 'amount', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account_from()
    {
        return $this->belongsTo('App\Account', 'id_account_from', 'id_account');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account_up()
    {
        return $this->belongsTo('App\Account', 'id_account_up', 'id_account');
    }
}
