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

use App\Models\AdministratorPermission;
use App\Http\Requests\Admin\AdministratorPermissionRequest;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $permissions = AdministratorPermission::paginate(30);

        return view('admin.admin_permission.index', compact('permissions'),[
            'pitch'=>'system'
        ]);
    }

    public function create()
    {
        return view('admin.admin_permission.create',[
            'pitch'=>'system'
        ]);
    }

    public function store(AdministratorPermissionRequest $request, AdministratorPermission $permission) {

        $permission->fill($request->filldata())->save();
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id){

        $permission = AdministratorPermission::findOrFail($id);

        return view('admin.admin_permission.edit', compact('permission'),[
            'pitch'=>'system'
        ]);
    }

    public function update(AdministratorPermissionRequest $request, $id){

        $permission = AdministratorPermission::findOrFail($id);
        $permission->fill($request->fillData())->save();
        return ['code'=>0 , 'msg'=>'编辑成功'];
    }

    public function destroy($id){

        $permission = AdministratorPermission::findOrFail($id);

        dd($permission);
        if ($permission->roles()->exists()) {

            return ['code'=>1 , 'msg'=>'该权限下还有角色，请先删除该角色'];
        } else {
            $permission->delete();
            return ['code'=>0 , 'msg'=>'该权限下还有角色，请先删除该角色'];
        }
    }
}
