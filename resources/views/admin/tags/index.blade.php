@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '图片'])
    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark"></i>
                <span class="caption-subject font-dark bold uppercase">标签列表</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="javascript:void(0)" id="add-tag" class="btn btn-primary ml-auto">添加</a>
                </div>
            </div>
        </div>

        <div class="portlet-body cf">
            <div class="row row-cards">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>图片人名</th>
                            <th>图片标题</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $val)
                        <tr>
                            <td>{{$val->name}}</td>
                            <td>{{$val->title}}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">编辑</a>
                                @include('components.backend.delete',  ['id' => $val->id , 'url'=>route('tags.destroy') , 'title'=>'删除标签'])
                            </td>
                        </tr>
                            @empty
                        <tr>
                            <td class="text-center" colspan="4">暂无记录</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row align-right">
                    {{$list->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/admins/js/template.js"></script>
    <script type="text/html" id="app-tag">
        <div class="js-dialog" id="ios-dialog" >
            <div class="weui-mask"></div>

            <div class="box portlet green-sharp weui-dialog panel-block" id="panel-block">
                <div class="portlet-title">
                    <h4><i class="icon-settings"></i><span class="panel-title">创建标签</span></h4>
                    <div class="tools"><a class="x fa fa-times" href="javascript:;"></a></div>
                </div>
                <div class="tag-body padding" >
                    <form id="form">
                        <div class="form-horizontal form-item">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@include('components.backend.required') 名字:  </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="请输入书名字" required>
                                </div>
                            </div>
                            <div class="botton-form botton-item" >
                                <a href="javascript:void(0)" class="btn btn-danger" id="submit-form">保存数据 </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </script>
    <script>

        $('#add-tag').click(function(){

            var html = template('app-tag');
            $('body').append(html);
        })
        $(document).on('click' , '#ios-dialog .x',function(){
            $('#ios-dialog').remove();
        })

        $(document).on('click','#submit-form',function(){
            APP.ajax({'url':'{{ route("post.tags.create")}}'},'#form',function(r){
                if(r.code == 500){
                    alert('请填检查相应的数据');
                }else if(r.code == 'HY000'){
                    alert('请填检查数据格式');
                }else if(r.code == 100){
                    alert('标签重复');
                    $('#ios-dialog').remove();
                }else{
                    location.reload();
                }
//
            })
        });
    </script>
@append