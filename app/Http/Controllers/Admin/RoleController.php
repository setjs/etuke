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

use App\Models\Role;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('weight')->get();

        return view('admin.role.index', compact('roles'),[
            'pitch'=>'operated'
        ]);
    }

    public function create()
    {
        return view('admin.role.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->filldata());
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.edit', compact('role'),[
            'pitch'=>'operated'
        ]);
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        flash('角色无删除成功，如果真的需要删除请直接从数据库删除，但是请确保数据完整性！');

        return back();
    }
}
