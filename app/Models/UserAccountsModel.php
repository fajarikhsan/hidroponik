<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAccountsModel extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'created_at'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
}
