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

use App\Models\Administrator;
use App\Models\AdministratorRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\AdministratorLoginSuccessEvent;
use App\Http\Requests\Admin\Administrator\LoginRequest;
use App\Http\Requests\Admin\Administrator\EditPasswordRequest;
use App\Http\Requests\Admin\Administrator\AdministratorRequest;

class AdminController extends Controller
{
    protected $guard = 'administrator';

    public function __construct(){

        $this->middleware(
            'admin.login.check', [
                'except' => [
                    'showLoginForm', 'loginHandle',
                ],
            ]
        );
    }

    public function index(){

        $administrators = Administrator::orderByDesc('created_at')->paginate(30);

        return view('admin.administrator.index', compact('administrators'),[
            'pitch'=>'system'
        ]);
    }

    public function showLoginForm(){
       
        if (Auth::guard($this->guard)->check()) {
            return redirect(route('dashboard.index'));
        }

        return view('admin.login');
    }

    public function loginHandle(LoginRequest $request){

        $captcah = $request->input('captcha');

        if(strtolower($captcah) != strtolower($request->session()->pull('validate_code'))){
            return json_encode(array('code'=>1 , 'msg'=>'验证码错误') , JSON_UNESCAPED_UNICODE);
        }

        if (! Auth::guard($this->guard)->attempt($request->only(['email', 'password'], $request->input('remember_me')))) {
            //flash('邮箱或密码错误');
            return ['code'=>1 , 'msg'=>'邮箱或密码错误'];
        }

        event(new AdministratorLoginSuccessEvent(Auth::guard($this->guard)->user()));

        return ['code'=>0 , 'msg'=>'success'];


    }

    public function create(){

        $roles = AdministratorRole::all();

        return view('admin.administrator.create', compact('roles'),[
            'pitch'=>'system'
        ]);

    }

    public function store(AdministratorRequest $request, Administrator $administrator) {

        $administrator->fill($request->fillData())->save();

        $administrator->roles()->sync($request->input('role_id', []));

        flash('管理员添加成功', 'success');

        return back();
    }

    public function edit($id){

        $administrator = Administrator::findOrFail($id);
        $roles = AdministratorRole::all();

        return view('admin.administrator.edit', compact('roles', 'administrator'),[
            'pitch'=>'system'
        ]);
    }

    public function update(AdministratorRequest $request, $id){

        $administrator = Administrator::findOrFail($id);

        $administrator->fill($request->filldata())->save();

        $administrator->roles()->sync($request->input('role_id', []));

        flash('管理员信息编辑成功', 'success');

        return back();
    }

    public function showEditPasswordForm(){


        return view('admin.auth.edit_password');
    }

    public function editPasswordHandle(EditPasswordRequest $request){

        $administrator = Auth::guard($this->guard)->user();



        if ( ! Hash::check($request->input('old_password'), $administrator->password) ) {


            return ['code'=>0 , 'msg'=>'原密码不正确'];

        }
        $permission = $administrator->fill($request->fillData())->save();

        return $permission;

        flash('密码修改成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        $administrator = Administrator::findOrFail($id);
        if (! $administrator->couldDestroy()) {
            flash('当前用户是超级管理员账户无法删除');
        } else {
            $administrator->delete();
            flash('管理员删除成功', 'success');
        }

        return back();
    }

    public function logoutHandle()
    {
        Auth::guard($this->guard)->logout();
        flash('成功退出', 'success');

        return redirect('login.html');
    }
}
