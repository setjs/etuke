@extends('layouts.admin')

@section('body')

    @include('components.breadcrumb', ['name' => '全站配置'])

    <div class="row row-cards">
        <div class="col-sm-12">

            <form action="" method="post">
                <div class="form-horizontal form-item">
                @csrf
                <div class="card">
                    <div class="card-header">系统配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">缓存开关</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*system*cache*status" value="1"
                                    {{config('etuke.system.cache.status') == 1 ? 'checked' : ''}}> 开启
                            <input type="radio" name="etuke*system*cache*status" value="-1"
                                    {{config('etuke.system.cache.status') == -1 ? 'checked' : ''}}> 不开启
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">缓存时间</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*system*cache*expire" class="form-control" value="{{config('etuke.system.cache.expire')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">统计代码</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*system*js" class="form-control" value="{{config('etuke.system.js')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">第三方登录</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Github登录</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*member*socialite*github*enabled" value="1"
                                    {{config('etuke.member.socialite.github.enabled') == 1 ? 'checked' : ''}}> 开启
                            <input type="radio" name="etuke*member*socialite*github*enabled" value="0"
                                    {{config('etuke.member.socialite.github.enabled') == 0 ? 'checked' : ''}}> 不开启
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Github ClientId</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*github*client_id" class="form-control" value="{{config('services.github.client_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Github ClientSecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*github*client_secret" class="form-control" value="{{config('services.github.client_secret')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Github ClientSecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*github*redirect" class="form-control" value="{{config('services.github.redirect')}}">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ登录</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*member*socialite*qq*enabled" value="1"
                                    {{config('etuke.member.socialite.qq.enabled') == 1 ? 'checked' : ''}}> 开启
                            <input type="radio" name="etuke*member*socialite*qq*enabled" value="0"
                                    {{config('etuke.member.socialite.qq.enabled') == 0 ? 'checked' : ''}}> 不开启
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ ClientId</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*qq*client_id" class="form-control" value="{{config('services.qq.client_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ ClientSecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*qq*client_secret" class="form-control" value="{{config('services.qq.client_secret')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ RedirectUrl</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*qq*redirect" class="form-control" value="{{config('services.qq.redirect')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">阿里云邮箱配置</div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <a href="https://www.aliyun.com/product/directmail?spm=5176.224200.search.1.67236ed6hjhyN0">阿里云邮件服务</a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云AccessKeyId</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*directmail*app_key" class="form-control"
                                   value="{{config('services.directmail.app_key')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云AccessKeySecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*directmail*app_secret" class="form-control"
                                   value="{{config('services.directmail.app_secret')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮件发送用户名</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*directmail*account*alias" class="form-control"
                                   value="{{config('services.directmail.account.alias')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮件发送地址</label>
                            <div class="col-sm-5">
                            <input type="text" name="services*directmail*account*name" class="form-control"
                                   value="{{config('services.directmail.account.name')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">选择短信服务商</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">短信服务商</label>
                            <div class="col-sm-5">
                            <select name="etuke*system*sms" class="form-control">
                                <option value="aliyun" {{config('etuke.system.sms') == 'aliyun' ? 'selected' : ''}}>阿里云</option>
                                <option value="yunpian" {{config('etuke.system.sms') == 'yunpian' ? 'selected' : ''}}>云片</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">阿里云短信配置</div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <a href="https://www.aliyun.com/product/sms?spm=5176.8142029.search.1.e9396d3e9M6zyh">阿里云短信服务</a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云AccessKeyId</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*access_key_id" class="form-control"
                                   value="{{config('sms.gateways.aliyun.access_key_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云AccessKeySecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*access_key_secret" class="form-control"
                                   value="{{config('sms.gateways.aliyun.access_key_secret')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">阿里云短信签名</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*sign_name" class="form-control"
                                   value="{{config('sms.gateways.aliyun.sign_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码重置短信模板ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*template*password_reset" class="form-control"
                                   value="{{config('sms.gateways.aliyun.template.password_reset')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册短信模板ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*template*register" class="form-control"
                                   value="{{config('sms.gateways.aliyun.template.register')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号绑定模板ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*aliyun*template*mobile_bind" class="form-control"
                                   value="{{config('sms.gateways.aliyun.template.mobile_bind')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">云片短信配置</div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <a href="https://www.yunpian.com/component/reg?inviteCode=kwfrte">云片短信服务</a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">云片APIKEY</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*yunpian*api_key" class="form-control"
                                   value="{{config('sms.gateways.yunpian.api_key')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码重置短信模板</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*yunpian*template*password_reset" class="form-control"
                                   value="{{config('sms.gateways.yunpian.template.password_reset')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册短信模板</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*yunpian*template*register" class="form-control"
                                   value="{{config('sms.gateways.yunpian.template.register')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号绑定模板</label>
                            <div class="col-sm-5">
                            <input type="text" name="sms*gateways*yunpian*template*mobile_bind" class="form-control"
                                   value="{{config('sms.gateways.yunpian.template.mobile_bind')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">图片上传设置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片存储磁盘</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*image*disk" class="form-control"
                                   value="{{config('eutke.upload.image.disk')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片存储路径</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*image*path" class="form-control"
                                   value="{{config('etuke.upload.image.path')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片参数（用于第三方图片存储）</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*image*params" class="form-control"
                                   value="{{config('etuke.upload.image.params')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">支付宝配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否开启</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*payment*alipay*enabled" value="1"
                                    {{config('etuke.payment.alipay.enabled') == 1 ? 'checked' : ''}}> 启用
                            <input type="radio" name="etuke*payment*alipay*enabled" value="0"
                                    {{config('etuke.payment.alipay.enabled') == 0 ? 'checked' : ''}}> 不启用
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppId</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*alipay*app_id" class="form-control"
                                   value="{{config('pay.alipay.app_id')}}"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公钥(RSA2加密方式)</label>
                            <div class="col-sm-5">
                            <textarea name="pay*alipay*ali_public_key" class="form-control" rows="3">{{config('pay.alipay.ali_public_key')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">私钥(RSA2加密方式)</label>
                            <div class="col-sm-5">
                            <textarea name="pay*alipay*private_key" class="form-control" rows="3">{{config('pay.alipay.private_key')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">返回地址</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*alipay*return_url" class="form-control"
                                   value="{{config('pay.alipay.return_url')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">回调地址</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*alipay*notify_url" class="form-control"
                                   value="{{config('pay.alipay.notify_url')}}">
                            <span class="form-text text-muted">示例：http://demo.com/payment/callback/alipay</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">微信支付配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否开启</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*payment*wechat*enabled" value="1"
                                    {{config('etuke.payment.wechat.enabled') == 1 ? 'checked' : ''}}> 启用
                            <input type="radio" name="etuke*payment*wechat*enabled" value="0"
                                    {{config('etuke.payment.wechat.enabled') == 0 ? 'checked' : ''}}> 不启用
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公众号ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*wechat*app_id" class="form-control"
                                   value="{{config('pay.wechat.app_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商户ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*wechat*mch_id" class="form-control"
                                   value="{{config('pay.wechat.mch_id')}}"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密钥</label>
                            <div class="col-sm-5">
                            <textarea name="pay*wechat*key" class="form-control" rows="3">{{config('pay.wechat.key')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">回调地址</label>
                            <div class="col-sm-5">
                            <input type="text" name="pay*wechat*notify_url" class="form-control"
                                   value="{{config('pay.wechat.notify_url')}}">
                            <span class="form-text text-muted">示例：http://demo.com/payment/callback/wechat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">易商户支付配置</div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <p>个人收款解决方案，申请地址 <a target="_blank" href="https://1shanghu.com">易商户</a></p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否开启</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*payment*eshanghu*enabled" value="1"
                                    {{config('etuke.payment.eshanghu.enabled') == 1 ? 'checked' : ''}}> 启用
                            <input type="radio" name="etuke*payment*eshanghu*enabled" value="0"
                                    {{config('etuke.payment.eshanghu.enabled') == 0 ? 'checked' : ''}}> 不启用
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppKey</label>
                            <div class="col-sm-5">
                            <input type="text" name="eshanghu*app_key" class="form-control"
                                   value="{{config('eshanghu.app_key')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppSecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="eshanghu*app_secret" class="form-control"
                                   value="{{config('eshanghu.app_secret')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">子商户ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="eshanghu*sub_mch_id" class="form-control"
                                   value="{{config('eshanghu.sub_mch_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">回调地址</label>
                            <div class="col-sm-5">
                            <input type="text" name="eshanghu*notify" class="form-control"
                                   value="{{config('eshanghu.notify')}}">
                            <span class="form-text text-muted">示例：http://demo.com/payment/callback/eshanghu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">阿里云视频上传配置</div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <a href="https://www.aliyun.com/product/vod?spm=5176.8142029.search.1.e9396d3eFvjBxH">
                                阿里云视频服务，<b>注意这里是阿里云的视频服务不是oss服务</b>
                            </a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">区域ID</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*video*aliyun*region" class="form-control"
                                   value="{{config('etuke.upload.video.aliyun.region')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeyId</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*video*aliyun*access_key_id" class="form-control"
                                   value="{{config('etuke.upload.video.aliyun.access_key_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeySecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="etuke*upload*video*aliyun*access_key_secret" class="form-control"
                                   value="{{config('etuke.upload.video.aliyun.access_key_secret')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">腾讯云视频上传配置</div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <a href="https://cloud.tencent.com/product/vod">腾讯云视频服务</a>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeyId</label>
                            <div class="col-sm-5">
                            <input type="text" name="tencent*vod*secret_id" class="form-control"
                                   value="{{config('tencent.vod.secret_id')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeySecret</label>
                            <div class="col-sm-5">
                            <input type="text" name="tencent*vod*secret_key" class="form-control"
                                   value="{{config('tencent.vod.secret_key')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">会员配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员注册默认激活</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*member*is_active_default" value="1"
                            {{config('etuke.member.is_active_default') == 1 ? 'checked' : ''}}> 激活
                            <input type="radio" name="etuke*member*is_active_default" value="-1"
                            {{config('etuke.member.is_active_default') == -1 ? 'checked' : ''}}> 不激活
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员注册默认锁定</label>
                            <div class="col-sm-5">
                            <input type="radio" name="etuke*member*is_lock_default" value="1"
                            {{config('etuke.member.is_lock_default') == 1 ? 'checked' : ''}}> 锁定
                            <input type="radio" name="etuke*member*is_lock_default" value="-1"
                            {{config('etuke.member.is_lock_default') == -1 ? 'checked' : ''}}> 不锁定
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员默认头像</label>
                            <div class="col-sm-5">
                            @include('components.backend.image', ['name' => 'etuke*member*default_avatar', 'value' => config('etuke.member.default_avatar')])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">首页SEO配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">首页标题</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*index*title" class="form-control" rows="2">{{config('etuke.seo.index.title')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">首页关键字</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*index*keywords" class="form-control" rows="2">{{config('etuke.seo.index.keywords')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">首页描述</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*index*description" class="form-control" rows="2">{{config('etuke.seo.index.description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">课程列表SEO配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">课程列表页面标题</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*course_list*title" class="form-control" rows="2">{{config('etuke.seo.course_list.title')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">课程列表页面关键字</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*course_list*keywords" class="form-control" rows="2">{{config('etuke.seo.course_list.keywords')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">课程列表页面描述</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*course_list*description" class="form-control" rows="2">{{config('etuke.seo.course_list.description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">订阅页面SEO配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订阅页面标题</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*role_list*title" class="form-control" rows="2">{{config('etuke.seo.role_list.title')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订阅页面关键字</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*role_list*keywords" class="form-control" rows="2">{{config('etuke.seo.role_list.keywords')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订阅页面描述</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*role_list*description" class="form-control" rows="2">{{config('etuke.seo.role_list.description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">电子书列表页面SEO配置</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电子书列表页面标题</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*book_list*title" class="form-control" rows="2">{{config('etuke.seo.book_list.title')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电子书列表页面关键字</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*book_list*keywords" class="form-control" rows="2">{{config('etuke.seo.book_list.keywords')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电子书列表页面描述</label>
                            <div class="col-sm-5">
                            <textarea name="etuke*seo*book_list*description" class="form-control" rows="2">{{config('etuke.seo.book_list.description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">EtukeCloud</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">云账号</label>
                            <div class="col-sm-5">
                            <input name="etuke*cloud*username" class="form-control" value="{{config('etuke.cloud.username')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">云密码</label>
                            <div class="col-sm-5">
                            <input name="etuke*cloud*password" class="form-control" value="{{config('etuke.cloud.password')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
                </div>
            </form>

        </div>
    </div>


@endsection