<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    /**
     * The table associated with this model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key of the table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be inserted or updated.
     * This is a security feature to prevent mass-assignment vulnerabilities.
     * @var array
     */
    protected $allowedFields = [
        'username',
        'email',
        'password_hash',
        'role'
    ];
}