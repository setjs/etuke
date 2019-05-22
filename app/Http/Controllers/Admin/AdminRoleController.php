<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdministratorRole;
use App\Models\AdministratorPermission;
use App\Http\Requests\Admin\AdministratorRoleRequest;

class AdminRoleController extends Controller
{
    public function index()
    {
        $roles = AdministratorRole::paginate(30);

        return view('admin.admin_role.index', compact('roles'),[
            'pitch'=>'system'
        ]);
    }

    public function create()
    {
        return view('admin.admin_role.create',[
            'pitch'=>'system'
        ]);
    }

    public function store(
        AdministratorRoleRequest $request,
        AdministratorRole $role
    ) {
        $role->fill($request->filldata())->save();
        flash('角色添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $role = AdministratorRole::findOrFail($id);

        return view('admin.admin_role.edit', compact('role'),[
            'pitch'=>'system'
        ]);
    }

    public function update(AdministratorRoleRequest $request, $id)
    {
        $role = AdministratorRole::findOrFail($id);
        $role->fill($request->filldata())->save();
        flash('角色编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        $role = AdministratorRole::findOrFail($id);
        if ($role->administrators()->exists()) {
            flash('该角色下还存在管理员，请先删除相应的管理员');
        } else {
            $role->delete();
            flash('删除成功', 'success');
        }

        return back();
    }

    public function showSelectPermissionPage($id)
    {
        $role = AdministratorRole::findOrFail($id);
        $permissions = AdministratorPermission::all();

        return view('admin.admin_role.select_permission', compact('permissions', 'role'),[
            'pitch'=>'system'
        ]);
    }

    public function handlePermissionSave(Request $request, $id)
    {
        $role = AdministratorRole::findOrFail($id);
        $role->permissions()->sync($request->input('permission_id', []));
        flash('授权成功', 'success');

        return back();
    }
}
