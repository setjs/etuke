@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '添加菜单'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">编辑菜单</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">
            <form id="form">
                @csrf
                <div class="form-horizontal form-item">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">父菜单:</label>
                        <div class="col-sm-5">
                        <select name="parent_id" class="form-control">
                            <option value="0">无父菜单</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                @foreach($menu->children as $child)
                                    <option value="{{$child->id}}" disabled="disabled">|----{{$child->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">图标:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="action_icon" class="form-control" placeholder="icon" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 排序:</label>
                        <div class="col-sm-5">
                        <input type="text" name="order" class="form-control" placeholder="排序" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 链接名:</label>
                        <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" placeholder="链接名" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 链接地址:  </label>
                        <div class="col-sm-5">
                        <input type="text" name="url" class="form-control" placeholder="链接地址" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 关联权限: </label>
                        <div class="col-sm-5">
                        <select name="permission_id" class="form-control">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="botton-form botton-item" >
                        <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#submit-form').click(function(){
            APP.ajax({'url':"{{route('menu.save')}}"},'#form',function(r){
                if(r.code == 500){
                    alert('请填检查相应的数据');
                }else if(r.code == 'HY000'){
                    alert('请填检查数据格式');
                }else{
                    location.href = '/menu.html';
                }
//
            })
        });
    </script>
@append