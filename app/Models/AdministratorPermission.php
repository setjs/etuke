<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministratorPermission extends Model
{
    protected $table = 'admin_permissions';

    protected $fillable = [
        'display_name', 'slug', 'description',
        'method', 'url',
    ];

    protected $appends = [
        'edit_url', 'destroy_url',
    ];

    /**
     * 权限下的角色.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            AdministratorRole::class,
            'admin_role_permission_relation',
            'permission_id',
            'role_id'
        );
    }

    public function getEditUrlAttribute()
    {
        return route('backend.admin_permission.edit', $this);
    }

    public function getDestroyUrlAttribute()
    {
        return route('backend.administrator_permission.destroy', $this);
    }

    /**
     * @return array
     */
    public function getMethodArray()
    {
        $method = $this->getOriginal('method');

        return $method ? explode('|', $method) : [];
    }
}
