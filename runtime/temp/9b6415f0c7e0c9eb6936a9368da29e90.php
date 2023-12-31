<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/www/wwwroot/yun.chinaeaglepower.cn/application/dsadmin/view/zhifu/index.html";i:1536907466;s:79:"/www/wwwroot/yun.chinaeaglepower.cn/application/dsadmin/view/public/header.html";i:1550146424;s:79:"/www/wwwroot/yun.chinaeaglepower.cn/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
	
<script src="/uploadhtml5e/js/hcfile.config-0.3.js?12"></script>
<script src="/uploadhtml5e/js/hcfile-0.3-min.js?37"></script>

<script src="/uploadhtml5e/js/exif.js?19"></script>
<link href="/uploadhtml5e/js/hcfile03.css?3" rel="stylesheet" type="text/css">
</head>
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/style.css">
<style>
.file-item{float: left; position: relative; width: 110px;height: 110px; margin: 0 20px 20px 0; padding: 4px;}
.file-item .info{overflow: hidden;}
.uploader-list{width: 100%; overflow: hidden;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php if(config("zfjk")==1): ?>微信<?php endif; if(config("zfjk")==2): ?>U<?php endif; if(config("zfjk")==3): ?>云<?php endif; ?>支付设置</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                
                
                
                    <form class="form-horizontal m-t" name="add" id="add" method="post" action="index">
                        
                        
                        <?php if(config("zfjk")==1): ?>
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-group">
                            <label class="col-sm-3 control-label">公众号(AppId)：</label>
                            <div class="input-group col-sm-4">
                                 <input id="wxappid" type="text" class="form-control" name="wxappid" placeholder="输入公众号(AppId)" value="<?php if(!empty($content['wxappid'])): ?><?php echo $content['wxappid']; endif; ?>">
                            </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-sm-3 control-label">开发者密码(AppSecret)：</label>
                            <div class="input-group col-sm-4">
                                 <input id="AppSecret" type="text" class="form-control" name="AppSecret" placeholder="输入开发者密码(AppSecret)" value="<?php if(!empty($content['AppSecret'])): ?><?php echo $content['AppSecret']; endif; ?>">
                            </div>
                            </div>
                            
                            
                            <div class="form-group">
                            <label class="col-sm-3 control-label">支付商户号(Mch_Id)：</label>
                            <div class="input-group col-sm-4">
                                 <input id="wxmchid" type="text" class="form-control" name="wxmchid" placeholder="输入支付商户号(Mch_Id)" value="<?php if(!empty($content['wxmchid'])): ?><?php echo $content['wxmchid']; endif; ?>">
                            </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-sm-3 control-label">支付密钥(APIKEY)：</label>
                            <div class="input-group col-sm-4">
                                 <input id="wxapikey" type="text" class="form-control" name="wxapikey" placeholder="输入支付密钥(APIKEY)" value="<?php if(!empty($content['wxapikey'])): ?><?php echo $content['wxapikey']; endif; ?>">
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-3 control-label">公众号域名：</label>
                            <div class="input-group col-sm-4">
                                 <input id="gzhename" type="text" class="form-control" name="gzhename" placeholder="公众号域名" value="<?php if(!empty($content['gzhename'])): ?><?php echo $content['gzhename']; endif; ?>">
                            </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-sm-3 control-label">商户域名：</label>
                            <div class="input-group col-sm-4">
                                 <input id="shename" type="text" class="form-control" name="shename" placeholder="商户域名" value="<?php if(!empty($content['shename'])): ?><?php echo $content['shename']; endif; ?>">
                            </div>
                            </div>
                            
                            
                        <?php endif; if(config("zfjk")==2): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回掉地址：</label>
                            <div class="input-group col-sm-4">
                                <label class="control-label">http://域名/index.php/index/pay/uzhifu.html</label>
                            </div>
                        </div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">U支付密钥：</label>
                            <div class="input-group col-sm-4">
                                <input id="ukey" type="text" class="form-control" name="ukey" placeholder="输入U支付密钥" value="<?php if(!empty($content['ukey'])): ?><?php echo $content['ukey']; endif; ?>">
                            </div>
                        </div>
                       <?php endif; if(config("zfjk")==3): ?>
                       
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">云支付商户编号：</label>
                            <div class="input-group col-sm-4">
                                <input id="merId" type="text" class="form-control" name="merId" placeholder="输入云支付商户编号" value="<?php if(!empty($content['merId'])): ?><?php echo $content['merId']; endif; ?>">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商户秘钥：</label>
                            <div class="input-group col-sm-4">
                                <input id="key" type="text" class="form-control" name="key" placeholder="输入商户秘钥" value="<?php if(!empty($content['key'])): ?><?php echo $content['key']; endif; ?>">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">通知秘钥：</label>
                            <div class="input-group col-sm-4">
                                <input id="notifyKey" type="text" class="form-control" name="notifyKey" placeholder="输入通知秘钥" value="<?php if(!empty($content['notifyKey'])): ?><?php echo $content['notifyKey']; endif; ?>">
                            </div>
                        </div>

                        


                       <?php endif; if(config("zfjk")==4): ?>
                        

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">网关：</label>
                            <div class="input-group col-sm-4">
                                <input id="wangguan" type="text" class="form-control" name="wangguan" placeholder="输入商户编号" value="<?php if(!empty($content['wangguan'])): ?><?php echo $content['wangguan']; endif; ?>">
                            </div>
                        </div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商户编号：</label>
                            <div class="input-group col-sm-4">
                                <input id="mch_id" type="text" class="form-control" name="mch_id" placeholder="输入商户编号" value="<?php if(!empty($content['mch_id'])): ?><?php echo $content['mch_id']; endif; ?>">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商户秘钥：</label>
                            <div class="input-group col-sm-4">
                                <input id="key" type="text" class="form-control" name="key" placeholder="输入商户秘钥" value="<?php if(!empty($content['key'])): ?><?php echo $content['key']; endif; ?>">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">通知秘钥：</label>
                            <div class="input-group col-sm-4">
                                <input id="notifyKey" type="text" class="form-control" name="notifyKey" placeholder="输入通知秘钥" value="<?php if(!empty($content['notifyKey'])): ?><?php echo $content['notifyKey']; endif; ?>">
                            </div>
                        </div>

                        


                       <?php endif; ?>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>
                               
                            </div>
                        </div>
                        
                        
                        
                    </form>
                    
                    
                </div>
            </div>

        </div>
    </div>
</div>
  <script src="__JS__/jquery-ui.cs.js?v=1.32"></script>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/dashang.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>


   

<script type="text/javascript">


   


    $(function(){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){
        
        <?php if(config("zfjk")==1): ?>
            if( '' == $.trim($('#wxappid').val())){
                layer.msg('公众号(AppId)不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
             if( '' == $.trim($('#wxmchid').val())){
                layer.msg('支付商户号(Mch_Id)不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
             if( '' == $.trim($('#wxapikey').val())){
                layer.msg('支付密钥(APIKEY)不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        <?php endif; if(config("zfjk")==2): ?>
            if( '' == $.trim($('#ukey').val())){
                layer.msg('U支付密钥不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        <?php endif; ?>
     }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.href="<?php echo url('index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

    });


    //IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }



</script>
</body>
</html>
