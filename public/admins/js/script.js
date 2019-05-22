var configs={
    type:'post',
    callback:function(){},
    'width'     : 400,
    'height'    : 0,
    'docTop'    : $(document).scrollTop() ,
    'mask'      : true,
    'docW'      : document.documentElement.clientWidth,
    'docH'      : document.documentElement.clientHeight, // 可见区域高度
    'pageW'     : document.body.clientWidth,
    'pageH'     : parseInt($(document).outerHeight()), //页面高度
    'title'     :'弹出',
    'html':    [] ,
    'css':     '',
    'dataType':'json'
};
var APP = function () {
    
    //@todo 左边自动页面高
    //@todo ajax
    var ajaxItem = function(opt,data,fun ){

        var _this =this ;
        opt = $.extend({},configs , opt);
        // console.log(opt);
        var url = opt.url;
        // console.info(opt);
        if(typeof data == 'string'){
            data = $(data).serialize() ;
        }else if(typeof data == 'object '){
            data = data;
        }
        //TODO ajax 执行

        $.ajax({
            type:opt.type,
            url:url,
            dataType:opt.dataType,
            data:data,
            //async:opt.asyncType,
            success:function(r, textStatus){
                //opt.callback(r);

                fun(r);
            },
            error:function(e,a, r){
            }
        });
    };
    var mask=function(opt){
        var _this = this;
        opt = $.extend({} , configs);

        $('body').append('<div class="page-mask" id="page-mask" style="display:block; width: 100%; height:'+parseInt(document.body.scrollHeight)+'px"></div>');
    };
    //@TODO 弹出层
    var dialogItem = function(opt){

        opt = $.extend({},configs, opt);
        var innerHtml ='';
        var boxW = opt.width;
        //var boxH = 200;
        if(typeof opt.html == 'string'){
            innerHtml =opt.html ;
        }else{
            innerHtml =opt.html.join('') ;
        }


        var html =  [
            '<div class="panel-block" id="panel-block" style="display:none">',
            '<div class="box portlet green-sharp">',
            '<div class="portlet-title">',
            '<h4><i class="icon-settings"></i><span class="panel-title">'+opt.title+'</span></h4>',
            '<div class="tools"><a class="remove x" href="javascript:;"><i class="fa fa-times"></i>',
            '</a></div></div>',
            '<div class="box-body padding" id="client">',innerHtml,
            '</div></div></div>'
        ];

        if($('#page-mask').length == 0){
            $('body').append(html.join(''));
            mask();
        }

        $('#panel-block').css({
            left:parseInt(opt.docW/2-boxW/2),
            width:opt.width,
            top:(opt.docH - $('#panel-block').outerHeight())/2
        });
        $('#panel-block').fadeIn('3000');
        $('#panel-block').find('.x').click(function(){
            $(this).parents('.panel-block').remove();
            $('#page-mask').remove();
        });
        if(typeof opt.callback == 'function'){
            opt.callback();
        }
        $('#back-close').click(function(){
            $(this).parents('.panel-block').remove();
            $('#page-mask').remove();
        });
        $('body').keydown(function (e) {
          if(e.keyCode==27){
            $('#page-mask , #panel-block').remove();
          }
        })
    };
    //@TODO 提示弹出层 2秒消失

    var dialogLose = function(txt){
        var html =  [
            '<div class="panel-block box border red" id="panel-block" style="display:none; width:auto">',
            '<div class="alert-msg">',txt,
            '</div></div>'
        ];
        $('body').append(html.join(''));
        $('#panel-block').css({
            left:'50%',
            top:'50%',
            'margin-left':-($('#panel-block').outerWidth()/2),
            'margin-top':-($('#panel-block').outerHeight()/2)
        });
        $('#panel-block').fadeIn('2000');

        setTimeout(function(){
            $('#panel-block').remove();
        },1000);
    }
    var delOne= function(id,msg){
        ///admin/home/delbanner?id=<{$val.id}>

        if(msg == undefined){
            msg = "确定删除吗?";
        }
        var html = [
            '<div style="padding-bottom:24px">',msg,'</div>',
            '<div class="submit-line"><a id="submit-form" class="btn btn-primary">确定</a> <a class="btn btn-danger" id="back-close">取消</a></div>'
        ];
        $(id).click(function(e){
            //e.preventDefault();
            var href = $(this).data('href');

            APP.dialog({'html':html,'callback':function(){
                $('#submit-form').click(function(){
                    console.log(1);
                    location.href=href;
                })
            }});
        });

    };
  var dialogScript = function(opt ,  html , complete){
    opt = $.extend({},configs, opt);
    var content =  '<div class="js_dialog" id="iosDialog" style="opacity: 1; ">\
        <div class="weui-mask"></div>\
        <div class="weui-dialog" id="view-ui-content" style="width: 600px">\
        <div class="weui-dialog-bd" id="content"></div>\
        </div></div>';

    $('body').append(content);
    $('#content').html(html);
    $('#view-ui-content').css({
      width:opt.width
    });

    if(typeof complete == 'function'){
      complete();
    }

  };
    return {
        // ajax 请求
      ajax: function (opt,data,fun){

            ajaxItem(opt,data,fun);
      }, //@todo dialog 入口
      dialog:function(opt){
        dialogItem(opt);
      },
      alert:function(txt){

        dialogLose(txt);
      },
      delete:function(_this , url , _token , title){



        var html = [
          '<div class="opt-text">'+title+'</div>',
          '<div class="submit-line" >',
          '<a id="del-data"   class="btn btn-primary">确定删除</a> ',
          '<a  class="btn btn-danger" id="back-close">返回列表</a>',
          '</div>'
        ];
        var id= _this.data('id');

        APP.dialog({'html':html, 'title':title});

        //删除
        $('#del-data').click(function(){
          APP.ajax({'url':url},{'id':id , '_token':_token},function(r){
            if(r.code == 200){
              location.reload();
            }
          });
        });
      },
        formatTime:function(t , format){
            //TODO 格式化时间  console.log(APP.formatTime('1253774420','yyyy-mm-d h:m:s'));
            var datetime = new Date();
            //	Date.prototype.format = function(t , format) {
            datetime.setTime(t * 1000);
            var date = {
                "mm+": datetime.getMonth() + 1,
                "d+": datetime.getDate(),
                "h+": datetime.getHours(),
                "m+": datetime.getMinutes(),
                "s+": datetime.getSeconds(),
                "q+": Math.floor((datetime.getMonth() + 3) / 3),
                "S+": datetime.getMilliseconds()
            };
            if (/(y+)/i.test(format)) {
                //console.log(RegExp.$1.length);
                format = format.replace(RegExp.$1, (datetime.getFullYear() + '').substr(4 - RegExp.$1.length));
            }
            for (var k in date) {
                if (new RegExp("(" + k + ")").test(format)) {
                    //console.log(RegExp.$1);
                    format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                }
            }
            return format;
            //	};
        },
        //Initialise theme pages
        init: function () {

        }
        //Set page
    };
}();


$('#edit-password').click(function () {
  var html = [
    '<p class="validatetips">带<span class="required">*</span>为必填项目。</p>',
    '<form id="form"  class="form-validate">',
    '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'" />',
    '<input type="hidden" name="_method" value="PUT">',
    '<ul class="role-form">',
    '<li class="item">',
    '<label class="item-title"><span class="songti">*</span>原密码：</label>',
    '<input type="password" name="old_password" placeholder="请输入原密码" class="form-control" required>',
    '</li>',
    '<li class="item">',
    '<label class="item-title"><span class="songti">*</span>新秘密：</label>',
    '<input type="password" name="new_password" placeholder="请输入新密码" class="form-control" required>',
    '</li>',
    '<li class="item">',
    '<label class="item-title"><span class="songti">*</span>确认密码：</label>',
    '<input type="password" name="new_password_confirmation" placeholder="请再输入一次新密码" class="form-control" required>',
    '</li>',
    '</ul>',
    '<div class="tips-error" id="panel-tips-error" style="display:none"></div>',
    '<div class="submit-line" >',
    '<a id="submit-form"   class="btn green-meadow">确认修改</a>',
    '<a class="btn red-sunglo" id="back-close">取消</a>',
    '</div>',
    '</form>'
  ];

  APP.dialog({'html':html, 'title':'修改密码' ,'callback':function(){

    $('#submit-form').click(function(){
      APP.ajax({'url':'/password/update.html' },'#form',function(r){
          console.log(r);
        if(r.code == 0){
         // location.href=location.href;
        }
      });
    });
  }});
})