<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id_account
 * @property integer $id_user
 * @property string $code_account
 * @property string $balance
 * @property boolean $enabled
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Transaction[] $transactions
 * @property Transaction[] $transactions
 */
class Account extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_account';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'code_account', 'balance', 'enabled', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionsfrom()
    {
        return $this->hasMany('App\Transaction', 'id_account_from', 'id_account');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionsup()
    {
        return $this->hasMany('App\Transaction', 'id_account_up', 'id_account');
    }
}
