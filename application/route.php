<?php
use think\Route;
// Route::alias('dl/login/checkverify','daili/login/checkverify');  

// Route::alias('dl/index/index','daili/index/index');


 
 Route::rule('dl$','daili/login/index');
 Route::rule('dl/sina/:a','daili/index/:a');
 Route::rule('dl/:c/:a','daili/:c/:a');

 
 Route::rule('guanli$','dsadmin/login/index');
 Route::rule('guanli/:c/:a','dsadmin/:c/:a');

 #http://ds.000376.cn/index.php/sina/baidu/hezi/userid/10004/ddh/K6vyHdzghM/id/44.html
 
  Route::rule('index/index/hezi','index/index/hezi');
  Route::rule('sina/baidu/hezi','index/index/hezi');


 
 // Route::get('guanli$','dsadmin/login/index');
//Route::get('dl/login/:action','daili/login'); 
//Route::get('dl/login','daili/login/index'); 
//Route::get('dl/login/index','daili/login/index'); 

?>