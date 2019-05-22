<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdministratorMenu;
use App\Models\AdministratorPermission;
use App\Http\Requests\Admin\AdministratorMenuRequest;

class AdminMenuController extends Controller{

    public function index(AdministratorMenu $administratorMenu){

        $menus = $administratorMenu->menus();
        $permissions = AdministratorPermission::get();

        return view('admin.menu.index', compact('menus', 'permissions'),[
            'pitch'=>'system'
        ]);
    }

    public function create(AdministratorMenu $administratorMenu)
    {
        $permissions = AdministratorPermission::get();
        $menus = $administratorMenu->menus();

        return view('admin.menu.create', compact('menus', 'permissions'),[
            'pitch'=>'system'
        ]);
    }

    public function store(AdministratorMenuRequest $request){

        $result = AdministratorMenu::create($request->fillData());
        if($result){
            return ['code'=>0 , 'msg'=>'success'];
        }else{
            return ['code'=>300 , 'msg'=>300];
        }
    }

    public function edit( AdministratorMenu $administratorMenu, $id){

//        if($request->isMethod('post') && $request->ajax()){
            $permissions = AdministratorPermission::get();
            $menus = $administratorMenu->menus();
            $menu = AdministratorMenu::findOrFail($id);

            return view('admin.menu.edit', compact('menus', 'menu', 'permissions'),[
                'pitch'=>'system'
            ]);
//        }

    }

    public function update( AdministratorMenuRequest $request, $id){


        $menu = AdministratorMenu::findOrFail($id);

        $menu->fill($request->fillData())->save();

        return ['code'=>0 , 'msg'=>'success'];
    }

    public function destroy(Request $request){
        $id = $request->post('id');

        $menu = AdministratorMenu::findOrFail($id);
        AdministratorMenu::whereParentId($menu->id)->update(['parent_id' => 0]);


        $result = $menu->delete();

        if($result){
            return ['code'=>200 , 'msg'=>'success'];
        }else{
            return ['code'=>300 , 'msg'=>'error'];
        }
    }

    public function saveChange(Request $request)
    {
        $data = json_decode($request->post('data'), true);
        foreach ($data as $index => $item) {
            $node = AdministratorMenu::findOrFail($item['id']);
            $node->fill(['order' => $index, 'parent_id' => 0])->save();
            if (isset($item['children'])) {
                foreach ($item['children'] as $childIndex => $child) {
                    $nodeChild = AdministratorMenu::findOrFail($child['id']);
                    $nodeChild->fill(['order' => $childIndex, 'parent_id' => $node->id])->save();
                }
            }
        }
        flash('保存成功', 'success');

        return back();
    }
}
