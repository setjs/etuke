@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '双色球'])

    <div class="row portlet light bordered cf">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject font-dark bold uppercase">编辑双色球</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:history.back(-1)">
                    <i class="fa fa-reply"></i>
                </a>
            </div>
        </div>

        <div class="portlet-body cf">
            <form id="form">
                <div class="form-horizontal form-item">
                    @csrf
                    <input type="hidden" value="{{$line->id}}" name="id" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required')期号:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="number" value="{{$line->number}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 日期:  </label>
                        <div class="col-sm-5">
                            @include('components.backend.date', ['name' => 'date' , 'value'=>$line->date])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 红号码:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="ball" value="{{$line->r1.' '}}" class="form-control" placeholder="红号" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 蓝号码:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="blue" value="{{$line->blue}}" class="form-control" placeholder="蓝号" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 同号:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="equal" value="{{$line->equal}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 连号:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="to_be" value="{{$line->to_be}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 连号值:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="to_be_val" value="{{$line->to_be_val}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 同尾:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="same_tail" value="{{$line->same_tail}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 同尾值:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="same_tail_val" value="{{$line->same_tail_val}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') 区间比例:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="interval" value="{{$line->interval}}" class="form-control" placeholder="请输入书名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@include('components.backend.required') AC值:  </label>
                        <div class="col-sm-5">
                            <input type="text" name="ac" value="{{$line->ac}}" class="form-control" placeholder="请输入书名" required>
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
@push('scripts')
    <script>
        $('#submit-form').click(function(){
            APP.ajax({'url':'{{route('post.double.update')}}'},'#form',function(r){
                if(r.code == 500){
                    alert('请填检查相应的数据');
                }else if(r.code == 'HY000'){
                    alert('请填检查数据格式');
                }else{
                    location.href = '{{route('double.index')}}';
                }
//
            })
        });
    </script>
@endpush