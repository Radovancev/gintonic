<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{

    public $timestamps = false;
    protected $table = "users";
    protected $casts = [
        'active' => 'boolean',
    ];

    public function __construct() {
        $hex = bin2hex(openssl_random_pseudo_bytes(5));
        $this->activation_code = $hex;
        $this->active = 0;
        $this->role_id = 1;
    }

    public function role() {
        return $this->hasOne('App\Models\RoleModel', 'id', 'role_id');
    }

    public function getAll() {
        return DB::table('users')
                   ->join('roles', 'roles.id', 'users.role_id')
                   ->select('users.id as user_id', 'username', 'email', 'active', 'roles.role_name as role_name')
                   ->get();
    }


}
