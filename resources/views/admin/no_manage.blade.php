@extends('admin.layouts.main')
@section('style')
    <link href="{{asset('admins/css/album.css')}}" rel="stylesheet"  />
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> 无权限</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="dataTables_wrapper no-footer">
                        您访问的页面无权限
                  </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop
