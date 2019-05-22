<div class="pt-2 pb-2">
    <div class="tab">
        <div class="tab-header">
            <ul>
                <li class="active" data-id="tab-aliyun">阿里云视频服务</li>
                <li data-id="tab-vod">腾讯云视频服务</li>
                <li data-id="tab-url">视频直链</li>
            </ul>
        </div>
        <div class="tab-body">
            <div class="tab-body-box active" id="tab-aliyun">
                <div class="alert alert-warning">
                    请确保您配置了阿里云视频服务的参数，否则会上传失败。<a href="{{route('setting.index')}}">点击这里进行配置</a>
                </div>
                <div class="custom-file">
                    <input type="file" id="video_files">
                </div>
                <div class="mt-3 mb-3">
                    <span>上传进度：<span id="upload-progress">暂无</span></span>
                </div>
                <div>
                    <button type="button" class="btn btn-info" id="start-upload">开始上传</button>
                    <button type="button" class="btn btn-danger" id="stop-upload">停止上传</button>
                </div>
                <input type="hidden" name="aliyun_video_id" id="aliyun_video_id" value="{{optional($video ?? '')->aliyun_video_id ?? ''}}">
            </div>
            <div class="tab-body-box" id="tab-vod">
                <div class="alert alert-warning">
                    请确保您配置了腾讯云视频服务的参数，否则会上传失败。<a href="{{route('setting.index')}}">点击这里进行配置</a>
                </div>
                <div class="custom-file">
                    <input type="file" id="vod_video_file">
                </div>
                <div class="mt-3 mb-3">
                    <span>上传进度：<span id="vod-upload-progress">暂无</span></span>
                </div>
                <div>
                    <button type="button" class="btn btn-info" id="vod-start-upload">开始上传</button>
                    <button type="button" class="btn btn-danger" id="vod-stop-upload">取消上传</button>
                </div>
                <input type="hidden" name="vod_video_id" id="vod_video_id" value="{{optional($video ?? '')->vod_video_id ?? ''}}">
            </div>
            <div class="tab-body-box" id="tab-url">
                <input type="text" name="url" class="form-control"
                       placeholder="请输入视频直链"
                       value="{{optional($video ?? '')->url ?? ''}}">
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(function () {
        $('.tab-header ul li').click(function () {
            var id = $(this).attr('data-id');
            $(this).addClass('active').siblings().removeClass('active');
            $(`#${id}`).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@append