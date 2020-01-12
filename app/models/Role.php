<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $table = "roles";
    protected $fillable = [
        'name', 'slug', 'permission',
    ];
    protected $casts = [
        'permission' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users', "users_id", "roles_id");

    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
