<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>跳转提示</title>
</head>
<body>
<script src="/boot_jq/lib/jquery-3.3.1.min.js"></script>
<script src="/boot_jq/lib/layer/layer.js"></script>
<!--
* $msg 待提示的消息
* $url 待跳转的链接
* $time 弹出维持时间（单位秒）
* icon 这里主要有两个layer的表情，5和6，代表（哭和笑）
-->
<script type="text/javascript">
    (function(){
        var msg = '<?php echo(strip_tags($message));?>';
        var error = '<?php echo(strip_tags($error));?>';
        var url = '<?php echo($jumpUrl);?>';
        // 去除.html
        url = url.replace(/\.html/, "");
        var wait = '<?php echo($waitSecond);?>';
    <?php
        if (isset($message)) {
                    ?>
                layer.msg(msg,{icon:"6",time:wait*1000});
            <?php
        } else {
                    ?>
                layer.msg(error,{icon:"5",time:wait*1000});
            <?php
        }
            ?>
        setTimeout(function(){
            location.href=url;
        },1000)
    })();
</script>
</body>
</html>