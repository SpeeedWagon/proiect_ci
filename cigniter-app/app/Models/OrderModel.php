<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    /**
     * The table associated with this model.
     * @var string
     */
    protected $table = 'orders';

    /**
     * The primary key of the table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be saved.
     * The 'created_at' field is handled by the database's DEFAULT,
     * but including it here allows for programmatically setting it if needed.
     * @var array
     */
    protected $allowedFields = [
        'user_id',
        'total_price',
        'created_at'
    ];
}