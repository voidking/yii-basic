<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>CaptchaTest</title>
</head>
<body>
    <p><img id="captcha" src="http://localhost/basic/web/util/captcha/getcode" alt=""></p>
    <p>请输入验证码：<input id="code" type="text"></p>
    <p><input id="check" type="button" value="确定"></p>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
$(function(){
    $('#captcha').click(function(){
        var $new_src = 'http://localhost/basic/web/util/captcha/getcode?'+Math.random();
        $(this).attr('src',$new_src);
    });

    $('#check').click(function(){
        var data = {
            code: $('#code').val()
        };
        $.ajax({
            url: 'http://localhost/basic/web/util/captcha/check',
            type: 'GET',
            dataType: 'json',
            data: data,
            success: function(data){
                alert(data.ext);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    });
});
</script>
</body>
</html>