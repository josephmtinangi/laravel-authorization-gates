<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasAccess(array $permissions) // bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    /**
     * @param string $permission
     * @return bool
     */
    private function hasPermission($permission)// bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
