<?php require('game-body-panel/functions/function.php');?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Vikings Slot</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
<!--This Function holds Css,Js and fonts links-->
    <?php get_links(); ?>
<!--This Function holds Css,Js and fonts links-->
    <script src="TemplateData/UnityProgress.javascript"></script>
    <script src="Build/UnityLoader.js"></script>
    <script>
        var gameInstance = UnityLoader.instantiate("gameContainer", "Build/Egyptian gods slots.json", {
            onProgress: UnityProgress
        });
    </script>
</head>
<body>
<!--This Function holds NavBar part-->
    <?php get_navbar(); ?>
<!--This Function holds NavBar part-->
   
    <div class="webgl-content">
        <div id="gameContainer" style="width: 1104px; height: 630px; margin: 0 auto; overflow:hidden"></div>
        
        <!--common part end-->
        <div class="footer">
            <div class="webgl-logo"></div>
            <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
            <div class="title">Egyptian gods slots</div>
        </div>
        <!--common part Start-->
    </div>
    
<!--This Function holds ending part of this section part-->
    <?php get_footer(); ?>
<!--This Function holds ending part of this section part-->
</body>

</html>