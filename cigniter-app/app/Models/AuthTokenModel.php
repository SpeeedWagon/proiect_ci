<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthTokenModel extends Model
{
    /**
     * The table associated with this model.
     * @var string
     */
    protected $table = 'auth_tokens';

    /**
     * The primary key of the table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be saved when creating a new token.
     * @var array
     */
    protected $allowedFields = [
        'selector',
        'hashed_validator',
        'user_id',
        'expires'
    ];
}