<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    /**
     * The table associated with this model.
     * @var string
     */
    protected $table = 'products';

    /**
     * The primary key of the table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be saved.
     * @var array
     */
    protected $allowedFields = [
        'name',
        'description',
        'price',
        'image_url'
    ];
}