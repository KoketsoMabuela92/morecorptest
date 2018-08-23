<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBids extends Model
{

    /**
     * The connection name for the model.
     *
     * @connection string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @table string
     */
    protected $table = 'product_bids';
}
