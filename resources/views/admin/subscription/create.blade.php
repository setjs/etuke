@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '订阅推送'])

    <div class="row row-cards">
       <div class="col-sm-12">
           <div class="alert alert-warning">
               所有订阅过本站的邮箱都将收到邮件！
           </div>
           <form action="" method="post">
               <div class="form-horizontal form-item">
               @csrf
               <div class="form-group">
                   <label class="col-sm-2 control-label">邮件标题 @include('components.backend.required')</label>
                   <div class="col-sm-5">
                   <input type="text" name="title" class="form-control" placeholder="邮件标题" value="{{old('title')}}" required>
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-2 control-label">邮件内容 @include('components.backend.required')</label>
                   <div class="col-sm-5">
                   @include('components.backend.editor', ['name' => 'content'])
                   </div>
               </div>
               <div class="form-group">
                   <button class="btn btn-primary" type="submit">开始群发</button>
               </div>
               </div>
           </form>
       </div>
    </div>

@endsection