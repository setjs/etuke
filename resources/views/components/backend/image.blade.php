<div class="form-group">
    <label class="col-sm-2 control-label">@include('components.backend.required') {{$title ?? '选择文件'}}:  </label>
    <div class="col-sm-8 more-photo cf" id="select-user-photo">
        <div class="user-photo">
            <div class="upload-files" id="poster">
                @if($value)
                    <img src="{{$value}}" />
                @else
                    上传封面
                @endif
            </div>
        </div>
    </div>

</div>

@section('script')
    <script src="/plupload/plupload.full.min.js"></script>
    <script src="/plupload/i18n/zh_CN.js"></script>
    <script src="/admins/js/libs/upload_res.js"></script>
@append