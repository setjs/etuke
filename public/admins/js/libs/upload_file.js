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

// var uploader = new plupload.Uploader({
// 	runtimes : 'html5,flash,silverlight',
// 	browse_button : 'selectfiles',
//     //multi_selection: false,
// 	container: document.getElementById('container'),
// 	flash_swf_url : '/admin/plupload/Moxie.swf',
// 	silverlight_xap_url : '/admin/plupload/Moxie.xap',
//   url : poster,
//   filters: {
//     mime_types : [ //只允许上传图片和zip,rar文件
//         { title : "Video files", extensions : "mp4,mp3" },
//         {title : "Image files", extensions : "jpg,gif,png"}
//         // {title : "Zip files", extensions : "zip"}
//     ],
//     max_file_size : '10mb', //最大只能上传10mb的文件
//     prevent_duplicates : false //不允许选取重复文件
//   },
//    // multipart_params:{},
// 	init:{
// 		PostInit: function(){
//       set_upload_param(uploader, '', true);
// 		},
//
// 		FilesAdded: function(up, files) {
//
//       filesCallback(up , files);
// 		},
//
// 		BeforeUpload: function(up, file) {
//             //check_object_radio();
//       g_object_name_type = 'random_name';
//       set_upload_param(up, file.name, true);
//     },
// 		UploadProgress: function(up, file) {
//
//       $('#upload-loadding').show();
//       $('#demand-progress').html(file.percent);
// 		},
//
// 		FileUploaded: function(up, file, info) {
// 		    var r = $.parseJSON(info.response);
// 		    var len = $('#show-thumbnail >span').length ;
//
//         if (info.status == 200) {
//             $('#upload-loadding').hide();
//             insertImage(len , r );
//
//         } else {
//             alert(info.response);
//
//         }
// 		},
//
// 		Error: function(up, err) {
//
//         if (err.code == -600) {
//             alert('选择的文件太大了');
//         } else if (err.code == -601) {
//             alert('选择的文件后缀不对');
//         } else if (err.code == -602) {
//             alert('这个文件已经上传过一遍了');
//         } else {
//             alert(err.response);
//         }
// 		}
// 	}
// });


var uploader = new plupload.Uploader({
  runtimes : 'html5,flash,silverlight',
  browse_button : 'select-files-1',
  //multi_selection: false,
  container: document.getElementById('container-1'),
  flash_swf_url : '/admin/plupload/Moxie.swf',
  silverlight_xap_url : '/admin/plupload/Moxie.xap',
  url : upUrl,
  filters: {
    mime_types : [ //只允许上传图片和zip,rar文件
      { title : "Video files", extensions : "mp4,mp3" },
      {title : "Image files", extensions : "jpg,gif,png"}
      // {title : "Zip files", extensions : "zip"}
    ],
    max_file_size : '10mb', //最大只能上传10mb的文件
    prevent_duplicates : false //不允许选取重复文件
  },
  // multipart_params:{},
  init:{
    PostInit: function(){
      set_upload_param(uploader, '', true);
    },

    FilesAdded: function(up, files) {

      filesCallback(up , files);
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

    FileUploaded: function(up, file, info) {
      var r = $.parseJSON(info.response);
      var len = $('#show-thumbnail >span').length ;

      if (info.status == 200) {
        $('#upload-loadding').hide();
        insertImage(len , r );

      } else {
        alert(info.response);

      }
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


// uploader.init();
uploader.init();