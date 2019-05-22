@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '角色授权'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">角色授权</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">

            <form action="" method="post">
                @csrf
                <div class="form-group cf">
                    @foreach($permissions as $permission)
                        <label class="accredit">
                            <input type="checkbox"
                                   name="permission_id[]"
                                   value="{{ $permission->id }}"
                                    {{ $role->hasPermission($permission) ? 'checked' : '' }}> {{ $permission->display_name }}
                        </label>
                    @endforeach
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </form>

        </div>
    </div>

@endsection