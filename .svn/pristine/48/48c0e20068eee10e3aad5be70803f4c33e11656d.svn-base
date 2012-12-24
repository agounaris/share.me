<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_title() ?>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include_stylesheets() ?>

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .sidebar-nav {
            padding: 9px 0;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" media="screen" href="/js/ui-lightness/jquery-ui-1.8.16.custom.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css"/>

    <?php include_javascripts() ?>
    <script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>

</head>

<body <?php if (!include_slot('body_id')): ?>id="default"<?php endif; ?>>

<div class="navbar navbar-fixed-top" id="navbar">
    <div id="logo"><a class="brand" href="/"></a></div>

    <?php if ($sf_user->isAuthenticated()) { ?>
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Workshare</a>

            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i> <?php echo $sf_user->getUsername();?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li><a href="/content/archived">Archived Projects</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Sign Out</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="/">Home</a></li>

                    <?php if($sf_user->hasCredential('admin' ) || $sf_user->hasCredential('manage_project')){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Clients<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        	<li><a href="/client">Clients</a></li>
                            <li><a href="/project">Projects</a></li>                            
                            <li><a href="/image">Images</a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($sf_user->hasCredential('admin') || $sf_user->hasCredential('manage_project')){ ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user">Users</a></li>
                            <li><a href="/user_group">Groups</a></li>
                        </ul>
                    </li>
                    <?php } ?>


                </ul>
                
                <?php
					if ( $sf_user->hasCredential('manage_project') ) {
						include_partial('global/filterForm');
					}
                
                ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    <?php } else { ?>
    <div class="navbar-inner-login"></div>
    <?php } ?>
</div>

<div id="content-main" class="container-fluid">
    <div class="row-fluid" style="margin-bottom: 15px;">

        <?php echo $sf_content ?>

    </div>
    <!--/row-->
</div>
<!--/.fluid-container-->

<footer style="background:#323232;color:#fff;margin-top:10px;">

    <div style="width:500px;;height:120px;margin: 0 auto;border: none;text-align: left;">

        <ul class="nav nav-list" style="float:left;margin-left:30px;">
            <li class="nav-header">Test</li>
            <li><a href="/">Test Test</a></li>
            <li><a href="/">Test Test</a></li>
        </ul>

        <ul class="nav nav-list" style="float:left;margin-left:30px;">
            <li class="nav-header">Test</li>
            <li><a href="/">Test Test</a></li>
            <li><a href="/">Test Test</a></li>
        </ul>

        <ul class="nav nav-list" style="float:left;margin-left:30px;">
            <li class="nav-header">Test</li>
            <li><a href="/">Test Test</a></li>
            <li><a href="/">Test Test</a></li>
        </ul>

        <ul class="nav nav-list" style="float:left;margin-left:30px;">
            <li class="nav-header">Test</li>
            <li><a href="/">Test Test</a></li>
            <li><a href="/">Test Test</a></li>
        </ul>

    </div>

    <p>&copy; AlchemyWorx Ltd <?php echo date("Y")?></p>
</footer>


</body>
</html>
