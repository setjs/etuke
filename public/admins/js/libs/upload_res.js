var accessid = ''
var accesskey = ''
var host = ''
var policyBase64 = ''
var signature = ''
var callbackbody = ''
var filename = ''
var key = ''
var expire = 0
var g_object_name = ''
var g_object_name_type = ''
var now = timestamp = Date.parse(new Date()) / 1000;
var is_video = 0;


function get_signature() {

  //可以判断当前expire是否超过了当前时间,如果超过了当前时间,就重新取一下.3s 做为缓冲
  var now = timestamp = Date.parse(new Date()) / 1000;

  if (expire < now + 3) {
    console.log(obj);
    //body = send_request()
    var obj = eval ("(" + body + ")");
    host = obj['host']
    policyBase64 = obj['policy']
    accessid = obj['accessid']
    signature = obj['signature']
    expire = parseInt(obj['expire'])
    callbackbody = obj['callback']
    key = obj['dir']
    return true;
  }
  return false;
};

function random_string(len) {
  len = len || 32;
  var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
  var maxPos = chars.length;
  var pwd = '';
  for (i = 0; i < len; i++) {
    pwd += chars.charAt(Math.floor(Math.random() * maxPos));
  }
  return pwd;
}

function get_suffix(filename) {
  pos = filename.lastIndexOf('.')
  suffix = ''
  if (pos != -1) {
    suffix = filename.substring(pos)
  }
  return suffix;
}

function calculate_object_name(filename) {

  if (g_object_name_type == 'local_name') {

    g_object_name += "${filename}"
  } else if (g_object_name_type == 'random_name') {
    suffix = get_suffix(filename)
    g_object_name = key + random_string(10) + suffix
  }
  return ''
}

function set_upload_param(up, filename, ret) {
  if (ret == false) {
    ret = get_signature()
  }
  g_object_name = key;

  if (filename != '') {
    suffix = get_suffix(filename)
    calculate_object_name(filename)
  }
  new_multipart_params = {
    'success_action_status' : '200', //让服务端返回200,不然，默认会返回204
    // 'callback' : callbackbody,
    '_token': _token
  };
  up.setOption({
    'multipart_params': new_multipart_params
  });
  if (ret == true){
    up.start();
  }
}
$.each(ids,function(i,n){
  var self = this.toString();


  //实例化一个plupload上传对象
  var uploader = new plupload.Uploader({
    browse_button : self, //触发文件选择对话框的按钮，为那个元素id
    url : '/upload/'+self+'?str=poster' ,//服务器端的上传页面地址
    max_file_size: '100mb',//限制为2MB
    filters: {
      mime_types : [ //只允许上传图片和zip,rar文件
        { title : "Video files", extensions : "mp4,mp3" },
        {title : "Image files", extensions : "jpg,gif,png"}
        // {title : "Zip files", extensions : "zip"}
      ],
      max_file_size : '100mb', //最大只能上传10mb的文件
      prevent_duplicates : false //不允许选取重复文件
    },
    init:{
      PostInit: function(){
        set_upload_param(uploader, '', true);
      },

      BeforeUpload: function(up, file) {
        //check_object_radio();
        g_object_name_type = 'random_name';
        set_upload_param(up, file.name, true);
      },
      UploadProgress: function(up, file) {

        $('#upload-loadding').show();
        $('#demand-progress').html(file.percent);
      },

      Error: function(up, err) {

        if (err.code == -600) {
          alert('选择的文件太大了');
        } else if (err.code == -601) {
          alert('选择的文件后缀不对');
        } else if (err.code == -602) {
          alert('这个文件已经上传过一遍了');
        } else {
          alert(err.response);
        }
      }
    }
  });
  //在实例对象上调用init()方法进行初始化
  uploader.init();
  //绑定各种事件，并在事件监听函数中做你想做的事
  uploader.bind('FilesAdded',function(uploader,files){
    uploader.start();
  });
  uploader.bind('FileUploaded',function(uploader,files,data){

    if(data.status == 200 ){
      data = $.parseJSON(data.response);
      //图片赋值
      if(self == 'poster'){

        $('#'+self).html('<img src="'+data.url+'" /><input type="hidden" value="'+data.url+'" name="'+name+'" />');

      }else if(self == 'cos'){

        $('#'+self).html('<div style="font-size:20px; color: #fff; text-align: center;padding-top: 30px">上传成功<audio id="audio-file" src="'+cosUrl+data.url+'"></audio></div><input type="hidden" value="'+data.url+'" name="t[res_path]" /> <input type="hidden" id="audio-times" value="0"  name="t[times]" />');

        var myAudio = document.getElementById("audio-file");

        if(myAudio != null){

          myAudio.load();
          myAudio.oncanplay = function () {
            $('#audio-times').val(parseInt(myAudio.duration));
          }
        }
      }

    }
  });
});


