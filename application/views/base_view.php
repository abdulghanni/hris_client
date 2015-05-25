<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta content="komunigrafik" name="author" />
        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <!-- / -->

        <!-- favicon.ico and apple-touch-icon.png -->

        <!-- Bootstrap core CSS -->
        <link href="<?php echo assets_url('css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <link href="<?php echo assets_url('css/plugins/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" >
        <!-- Custom styles -->
        <?php echo $css; ?>
        <link rel="stylesheet" href="<?php echo assets_url('css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo assets_url('css/responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo assets_url('css/custom-icon-set.css'); ?>" type="text/css"/>
        
        <!-- / -->


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php echo assets_url('js/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo assets_url('js/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>
    <body class="bg-login">
        <?php echo $body; ?>
        <!-- / -->

        <script src="<?php echo assets_url('js/jquery-1.8.3.min.js'); ?>"></script>
        <script src="<?php echo assets_url('js/bootstrap.min.js'); ?>"></script>
        
        <!-- Extra javascript -->
        <?php echo $js; ?>
        <!-- / -->

        <?php if ( ! empty($ga_id)): ?><!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','<?php echo $ga_id; ?>');ga('send','pageview');
        </script>
        <?php endif; ?><!-- / -->
    </body>
</html>