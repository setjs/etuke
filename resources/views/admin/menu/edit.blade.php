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
                <input type="hidden" name="_method" value="PUT">
                <div class="form-horizontal form-item">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">父菜单:</label>
                        <div class="col-sm-5">
                            <select name="parent_id" class="form-control">
                                <option value="0">无父菜单</option>
                                @foreach($menus as $menuItem)
                                    <option value="{{$menuItem->id}}" {{$menu->parent_id == $menuItem->id ? 'selected' : ''}}>{{$menuItem->name}}</option>
                                    @foreach($menuItem->children as $child)
                                        <option value="{{$child->id}}" disabled="disabled">|----{{$child->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">图标:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="action_icon" class="form-control" placeholder="icon" value="{{$menu->action_icon}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> @include('components.backend.required') 排序:</label>
                        <div class="col-sm-5">
                        <input type="text" name="order" class="form-control" placeholder="排序" value="{{$menu->order}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> @include('components.backend.required') 链接名:</label>
                        <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" placeholder="链接名" value="{{$menu->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 链接地址: </label>
                        <div class="col-sm-5">
                        <input type="text" name="url" class="form-control" placeholder="链接地址" value="{{$menu->url}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 关联权限: </label>
                        <div class="col-sm-5">
                        <select name="permission_id" class="form-control">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" {{$menu->permission_id == $permission->id ? 'selected' : ''}}>{{ $permission->display_name }}</option>
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
        APP.ajax({'url':'/menu/edit/{{$menu->id}}.html'},'#form',function(r){
          location.href = '/menu.html';
        })
      });
    </script>
@stop
