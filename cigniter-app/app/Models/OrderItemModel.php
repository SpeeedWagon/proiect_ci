<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    /**
     * The table associated with this model.
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The primary key of the table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be saved. All fields are needed
     * for the 'insertBatch' operation during checkout.
     * @var array
     */
    protected $allowedFields = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
}