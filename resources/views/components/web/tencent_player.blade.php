<link href="//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.css" rel="stylesheet">
<script src="//imgcache.qq.com/open/qcloud/video/tcplayer/lib/hls.min.0.8.8.js"></script>
<script src="//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.min.js"></script>
<video id="xiaoteng-player" width="825" height="500" preload="auto" playsinline webkit-playsinline></video>
<script>
    var vodPlayer = TCPlayer('xiaoteng-player', {
        fileID: '4564972818956091133',
        appID: '1253668508'
    });
    $(function () {
        $('#xiaoteng-player').on('contextmenu', function (e) {
            e.preventDefault();
            return false;
        });
    });
</script>