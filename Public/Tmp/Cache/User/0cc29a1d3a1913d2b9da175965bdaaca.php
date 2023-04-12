<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title><?php echo ($meta_title); ?>｜<?php echo C('WEB_SITE_TITLE');?>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="author" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="keywords" content="<?php echo ($meta_keywords); ?>">
    <meta name="description" content="<?php echo ($meta_description); ?>">
    <meta name="generator" content="CoreThink">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/logo.png">
    <link rel="stylesheet" type="text/css" href="/Public/libs/cui/css/cui.min.css">
    <link rel="stylesheet" type="text/css" href="/./Application/Admin/View/Public/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/./Application/Admin/View/Public/css/theme/<?php echo C('ADMIN_THEME');?>.css">
    <link rel="stylesheet" type="text/css" href="/Public/libs/animate/animate.min.css">
    
    <link rel="stylesheet" type="text/css" href="/Public/libs/cui/css/cui.extend.min.css">
    <style type="text/css">
    /* Builder样式 */
    .builder .builder-container .builder-data-empty {
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }
    .builder .builder-container .builder-data-empty .empty-info {
        padding: 130px 0;
        color: #555;
    }
    .builder .builder-container .builder-table .table td {
        max-width: 600px;
        vertical-align: middle;
        overflow: hidden;
    }
    .builder .builder-container .builder-table .table td img.picture {
        max-width: 200px;
        max-height: 40px;
    }
    .builder .builder-container .pagination {
        margin-top: 0px;
    }
    .builder.formbuilder-box .form-builder .img-box .remove-picture {
        color: red;
        position: absolute;
        top: 0;
        right: 2px;
        background: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
    .builder.formbuilder-box .form-builder .img-box .remove-picture:hover {
        color: #DD0000;
        box-shadow: inset 0 1px 1px red, 0 0 8px red;
    }
    .builder.formbuilder-box .form-builder .file-box .remove-file {
        color: red;
        position: absolute;
        top: 12px;
        right: 10px;
        border-radius: 20px;
        cursor: pointer;
    }
    .builder.formbuilder-box .form-builder .file-box .remove-file:hover {
        color: #DD0000;
        box-shadow: inset 0 1px 1px red, 0 0 8px red;
    }
    .builder.formbuilder-box .form-builder .board_list .board {
        padding: 0px;
        margin-right: 10px;
    }
    @media (min-width: 768px) {
        .builder.formbuilder-box .form-builder .input,
        .builder.formbuilder-box .form-builder .select,
        .builder.formbuilder-box .form-builder .textarea,
        .builder.formbuilder-box .form-builder .file-box {
            width: 70%;
        }
        .builder.formbuilder-box .form-builder .submit,
        .builder.formbuilder-box .form-builder .return {
            min-width: 120px;
        }
        .builder.formbuilder-box .form-builder.form-horizontal {
            padding: 0 15px;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .control-label {
            text-align: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .left {
            width: 15%;
            float: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .right {
            width: 85%;
            float: left;
        }
    }
    @media (min-width: 992px) {
        .builder.formbuilder-box .form-builder.form-horizontal .left {
            width: 12%;
            float: left;
        }
        .builder.formbuilder-box .form-builder.form-horizontal .right {
            width: 88%;
            float: left;
        }
    }
</style>


    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/Public/libs/jquery/1.x/jquery.min.js"></script>
</head>
<body class="<?php echo ($_page_name); ?>">
    <div class="clearfix full-header">
        
            <?php if (!C('ADMIN_TABS')): ?>
                <!-- 顶部导航 -->
                <div class="navbar navbar-inverse navbar-fixed-top main-nav" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if(C('WEB_SITE_LOGO')): ?>
                        <a class="navbar-brand" target="_blank" href="/">
                            后台管理
                            <!--<img class="logo img-responsive" src="<?php echo (get_cover(C("WEB_SITE_LOGO"))); ?>">-->
                        </a>
                    <?php else: ?>
                        <a class="navbar-brand" target="_blank" href="/">
                            <!--<span><?php echo C('PRODUCT_LOGO');?></span>-->
                            后台管理
                        </a>
                    <?php endif; ?>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-top">
                    <ul class="nav navbar-nav">
                        <!-- 主导航 -->
                        <?php if (count($_menu_list) > 7): ?>
                            <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,0,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                                    <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                        <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                        <span><?php echo ($vo["title"]); ?></span>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-th-large"></i> 更多 <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = array_slice($_menu_list,7,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                                            <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                                <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                                <span><?php echo ($vo["title"]); ?></span>
                                            </a>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <?php if(is_array($_menu_list)): $i = 0; $__LIST__ = $_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($_parent_menu_list[0]['title'] == $vo['title']) echo 'class="active"'; ?>>
                                    <a href="<?php echo U($vo['_child'][0]['_child'][0]['url']);?>" target="<?php echo C(strtolower($vo['name']).'_config.target'); ?>">
                                        <i class="fa <?php echo ($vo["icon"]); ?>"></i>
                                        <span><?php echo ($vo["title"]); ?></span>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                        <li><a target="_blank" href="/"><i class="fa fa-external-link-square"></i> 打开前台</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> <?php echo ($_user_auth["username"]); ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo U('Admin/Public/logout');?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        
    </div>

    <div class="clearfix full-container">
        
            <?php if (!C('ADMIN_TABS')): ?>
                <div class="container-fluid with-top-navbar">
                    <div class="row">
                        <!-- 后台左侧导航 -->
                        <div id="sidebar" class="col-xs-12 col-sm-2 sidebar tab-content">
                            <!-- 模块菜单 -->
                            <nav class="navside navside-default" role="navigation">
                                <?php if($_current_menu_list['_child']): ?>
                                    <ul class="nav navside-nav navside-first">
                                        <?php if(is_array($_current_menu_list["_child"])): $fkey = 0; $__LIST__ = $_current_menu_list["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                                <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                                    <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                                    <span class="nav-label"><?php echo ($_ns_first["title"]); ?></span>
                                                    <span class="fa arrow"></span>
                                                </a>
                                                <?php if(!empty($_ns_first["_child"])): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns["id"]); ?>-<?php echo ($fkey); ?>">
                                                        <?php if(is_array($_ns_first["_child"])): $skey = 0; $__LIST__ = $_ns_first["_child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey;?><li <?php if($_parent_menu_list[2]['id'] == $_ns_second['id']) echo 'class="active"'; ?>>
                                                                <a href="<?php echo U($_ns_second['url']);?>" >
                                                                    <i class="<?php echo ($_ns_second["icon"]); ?>"></i>
                                                                    <span class="nav-label"><?php echo ($_ns_second["title"]); ?></span>
                                                                </a>
                                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </ul><?php endif; ?>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </nav>
                        </div>

                        <!-- 右侧内容 -->
                        <div id="main" class="col-xs-12 col-sm-10 main"  style="overflow-y: scroll;">
                            <!-- 面包屑导航 -->
                            <ul class="breadcrumb">
                                <li><i class="fa fa-map-marker"></i></li>
                                <?php if(is_array($_parent_menu_list)): $i = 0; $__LIST__ = $_parent_menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="text-muted"><?php echo ($vo["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>

                            <!-- 主体内容区域 -->
                            <div class="tab-content ct-tab-content">
                                
    <div class="builder formbuilder-box panel-body">
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs builder-form-tabs">
            <ul class="nav nav-tabs">
                <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="form-group"></div><?php endif; ?>

    
    <div class="builder-container">
        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo ($post_url); ?>" method="post" class="form-horizontal form form-builder">
                    <div class="col-xs-12">
                        <?php if(is_array($form_items)): $k = 0; $__LIST__ = $form_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$form): $mod = ($k % 2 );++$k; switch($form["type"]): case "hidden": ?><div class="form-group hidden item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" class="form-control input" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
        </div>
    </div><?php break;?>

                                
                                <?php case "static": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <p><?php echo ($form["value"]); ?></p>
        </div>
    </div><?php break;?>

                                
                                <?php case "num": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "price": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "text": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input text" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "textarea": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra"]["attr"]); ?>><?php echo ($form["value"]); ?></textarea>
            <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "array": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra"]["attr"]); ?>><?php echo ($form["value"]); ?></textarea>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "password": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="password" class="form-control input password" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="radio-inline cui-control cui-radio">
                    <label for="<?php echo ($form["name"]); echo ($option_key); ?>">
                        <?php if(is_array($option)): ?>
                            <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>> 
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="checkbox-inline cui-control cui-checkbox">
                    <label class="checkbox-label">
                        <?php if(is_array($option)): ?>
                            <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <select name="<?php echo ($form["name"]); ?>" class="form-control cui-select select" <?php echo ($form["extra"]["attr"]); ?>>
                <option value=''>请选择：</option>
                <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): if(is_array($option)): ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>
                            <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <?php echo ($option["title"]); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
                    <?php endif; endforeach; endif; ?>
            </select>
        </div>
    </div><?php break;?>

                                
                                <?php case "icon": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div class="input-group input" id="<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                </span>
                <input type="text" class="form-control" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            </div>
            <script type="text/javascript">
                $(function(){
                    $("#<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>").iconpicker({
                        icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "date": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_date_<?php echo ($k); ?>" class="form-control input date" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"],'Y-m-d')); endif; ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#<?php echo ($group_k); ?>_date_<?php echo ($k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd',
                        autoclose   : true,
                        minView     : 'month',
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "datetime": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_time_<?php echo ($k); ?>" class="form-control input time" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"],'Y-m-d H:i:s')); endif; ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#<?php echo ($group_k); ?>_time_<?php echo ($k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd hh:ii:ss',
                        autoclose   : true,
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "picture": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right row">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="col-md-4 file-item thumbnail">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img src="<?php echo (get_cover($form["value"])); ?>" data-id="<?php echo ($form["value"]); ?>">
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="col-md-4 file-item thumbnail hidden">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img>
                        </div><?php endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传图片</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> img').attr('src', response.url);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-picture', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "pictures": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right row">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($form["value"])): if (is_array($form['value'])) { $images = $form['value']; $input_value = implode(',', $form['value']); } else { $images = explode(',', $form['value']); $input_value = $form['value']; } ?>
                        <?php if(is_array($images)): foreach($images as $key=>$img): ?><div class="col-md-4 thumbnail">
                                <i class="fa fa-times-circle remove-picture"></i>
                                <img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>">
                            </div><?php endforeach; endif; endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多图</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<div id="' + file.id + '" class="col-md-3 thumbnail">' +
                                    '<i class="fa fa-times-circle remove-picture"></i>' +
                                    '<img>' +
                                '</div>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                            $( '#'+file.id + ' img').attr('src', response.url);
                            $( '#'+file.id + ' img').attr('data-id', response.id);
                        } else {
                            $.alertMessager('错误：：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-picture', function() {
                        var ready_for_remove_id = $(this).closest('.thumbnail').find('img').attr('data-id'); //获取待删除的图片ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_picture_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                        current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.thumbnail').remove(); //删除图片预览图
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "file": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "files": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($form["value"])): if (is_array($form['value'])) { $files = $form['value']; $input_value = implode(',', $form['value']); } else { $files = explode(',', $form['value']); $input_value = $form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "file": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',         // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "files": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($form["value"])): if (is_array($form['value'])) { $files = $form['value']; $input_value = implode(',', $form['value']); } else { $files = explode(',', $form['value']); $input_value = $form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "kindeditor": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>" class="form-control" <?php echo ($form["extra"]["attr"]); ?>>
                <?php echo ($form["value"]); ?>
            </textarea>
            <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    KindEditor.ready(function(K) {
                        kindeditor_<?php echo ($k); ?> = K.create('#<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>', {
                            allowFileManager : true,
                            filePostName : 'file',
                            cssPath : [
                                '/Public/libs/cui/css/cui.min.css',
                                '/Public/libs/kindeditor/plugins/code/prettify.css'
                            ],
                            width : '100%',
                            height : '500px',
                            resizeType: 1,
                            pasteType : 2,
                            filterMode: <?php if(MODULE_MARK === 'Admin') {echo 'false';} else {echo 'true';} ?>,
                            urlType : "",
                            fileManagerJson : '<?php echo U(MODULE_MARK."/Upload/fileManager");?>',
                            uploadJson : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            extraFileUploadParams: {
                                session_id : '<?php echo session_id();?>'
                            },
                            afterBlur: function(){this.sync();}
                        });
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "editormd": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>" style="z-index: 1000;" class="form-control" <?php echo ($form["extra"]["attr"]); ?>></div>
            <pre id="default_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>" class="hidden"><?php echo ($form["value"]); ?></pre>

            <link rel="stylesheet" type="text/css" href="/Public/libs/editormd/css/editormd.min.css">
            <script type="text/javascript" src="/Public/libs/editormd/js/editormd.min.js"></script>

            <script type="text/javascript">
                $(function(){
                var editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>_content = $('#default_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>').text();
                    var editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?> = editormd({
                            id              : '<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>',
                            path            : '/Public/libs/editormd/lib/',
                            pluginPath      : '/Public/libs/editormd/plugins/',
                            name            : '<?php echo ($form["name"]); ?>',
                            markdown        : editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>_content,
                            imageUpload     : true,
                            imageFormats    : ["jpg", "jpeg", "gif", "png", "bmp"],
                            imageUploadURL  : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            placeholder     : 'CoreThink让开发更轻松！',
                            width           : '100%',
                            height          : 640,
                            watch           : <?php if(MODULE_MARK === 'Admin'){ echo 'false';} else {echo 'true';} ?>,
                            codeFold        : true,
                            htmlDecode      : false,
                            toolbarAutoFixed: false,
                        });
                });
            </script>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "tags": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>" class="form-control" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input.css">
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input-bootstrap.css">
            <script type="text/javascript" src="/Public/libs/jquery_tokeninput/js/jquery.tokeninput.min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    //标签自动完成
                    var tags = $('#<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>'), tagsPre = [];
                    if (tags.length > 0) {
                        var items = tags.val().split(','), result = [];
                        for (var i = 0; i < items.length; i ++) {
                            var tag = items[i];
                            if (!tag) {
                                continue;
                            }
                            tagsPre.push({
                                id      :   tag,
                                title   :   tag
                            });
                        }
                    }
                    tags.tokenInput("<?php echo U(MODULE_NAME.'/Tag/search'); ?>",{
                        propertyToSearch    :   'title',
                        tokenValue          :   'title',
                        searchDelay         :   0,
                        tokenLimit          :   10,
                        preventDuplicates   :   true,
                        animateDropdown     :   true,
                        allowFreeTagging    :   true,
                        hintText            :   '请输入标签名',
                        noResultsText       :   '此标签不存在, 按回车创建',
                        searchingText       :   "查找中...",
                        prePopulate         :   tagsPre,
                        theme               :   'bootstrap',
                        onAdd: function (item){ //新增系统没有的标签时提交到数据库
                            $.post("<?php echo U(MODULE_NAME.'/Tag/add'); ?>", {'title': item.title});
                        }
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "board": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" name="<?php echo ($form["name"]); ?>" value='<?php echo ($form["value"]); ?>'>
            <div class="row board_list boards_<?php echo ($k); ?>" <?php echo ($form["extra"]["attr"]); ?>>
                <div class="container-fluid">
                    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                            <div class="panel-heading">
                                <strong><?php echo ($option["title"]); ?></strong>
                            </div>
                            <div class="list-group dragsort_<?php echo ($k); ?>" data-group="<?php echo ($option_key); ?>">
                                <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                        <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                        <input type="hidden" name="<?php echo ($form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
            <script type="text/javascript">
                //拖曳插件初始化
                $(function(){
                    $(".dragsort_<?php echo ($k); ?>").dragsort({
                         dragSelector:'div',
                         placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                         dragBetween:true, //允许拖动到任意地方
                         dragEnd:function(){
                             var self = $(this);
                             self.find('input').attr('name', '<?php echo ($form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($k); ?>').data('group') + '][]');
                         }
                     });
                });
            </script>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>


                                <?php case "group": ?><div class="form-group"></div>
                                    <div class="builder-tabs form-group">
                                        <ul class="nav nav-tabs">
                                            <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($group_k % 2 );++$group_k;?><li data-tab="tab<?php echo ($group_k); ?>" <?php if(($group_k) == "1"): ?>class="active"<?php endif; ?>><a href="#tab<?php echo ($group_k); ?>" data-toggle="tab"><?php echo ($li["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                    <div class="builder-container">
                                        <div class="tab-content">
                                            <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($group_k % 2 );++$group_k;?><div id="tab<?php echo ($group_k); ?>" class='tab-pane <?php if(($group_k) == "1"): ?>active<?php endif; ?> tab<?php echo ($group_k); ?>'>
                                                    <div class="group">
                                                        <?php if(is_array($tab["options"])): $tab_k = 0; $__LIST__ = $tab["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab_form): $mod = ($tab_k % 2 );++$tab_k; switch($tab_form["type"]): case "hidden": ?><div class="form-group hidden item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" class="form-control input" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "static": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <p><?php echo ($tab_form["value"]); ?></p>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "num": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "price": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "text": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input text" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "textarea": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "array": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "password": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="password" class="form-control input password" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><div class="radio-inline cui-control cui-radio">
                    <label for="<?php echo ($tab_form["name"]); echo ($option_key); ?>">
                        <?php if(is_array($option)): ?>
                            <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>> 
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><div class="checkbox-inline cui-control cui-checkbox">
                    <label class="checkbox-label">
                        <?php if(is_array($option)): ?>
                            <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <select name="<?php echo ($tab_form["name"]); ?>" class="form-control cui-select select" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <option value=''>请选择：</option>
                <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): if(is_array($option)): ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>
                            <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <?php echo ($option["title"]); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
                    <?php endif; endforeach; endif; ?>
            </select>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "icon": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div class="input-group input" id="tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                </span>
                <input type="text" class="form-control" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            </div>
            <script type="text/javascript">
                $(function(){
                    $("#tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>").iconpicker({
                        icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "date": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>" class="form-control input date" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"],'Y-m-d')); endif; ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd',
                        autoclose   : true,
                        minView     : 'month',
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "datetime": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>" class="form-control input time" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"],'Y-m-d H:i:s')); endif; ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd hh:ii:ss',
                        autoclose   : true,
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "picture": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right row">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="col-md-4 file-item thumbnail">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img src="<?php echo (get_cover($tab_form["value"])); ?>" data-id="<?php echo ($tab_form["value"]); ?>">
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="col-md-4 file-item thumbnail hidden">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img>
                        </div><?php endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传图片</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> img').attr('src', response.url);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-picture', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "pictures": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right row">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $images = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $images = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                        <?php if(is_array($images)): foreach($images as $key=>$img): ?><div class="col-md-4 thumbnail">
                                <i class="fa fa-times-circle remove-picture"></i>
                                <img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>">
                            </div><?php endforeach; endif; endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多图</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<div id="' + file.id + '" class="col-md-3 thumbnail">' +
                                    '<i class="fa fa-times-circle remove-picture"></i>' +
                                    '<img>' +
                                '</div>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                            $( '#'+file.id + ' img').attr('src', response.url);
                            $( '#'+file.id + ' img').attr('data-id', response.id);
                        } else {
                            $.alertMessager('错误：：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-picture', function() {
                        var ready_for_remove_id = $(this).closest('.thumbnail').find('img').attr('data-id'); //获取待删除的图片ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_picture_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                        current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.thumbnail').remove(); //删除图片预览图
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "file": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($tab_form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($tab_form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "files": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $files = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $files = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "file": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($tab_form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($tab_form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',         // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "files": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $files = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $files = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "kindeditor": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>" class="form-control" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <?php echo ($tab_form["value"]); ?>
            </textarea>
            <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    KindEditor.ready(function(K) {
                        kindeditor_<?php echo ($tab_k); ?> = K.create('#tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>', {
                            allowFileManager : true,
                            filePostName : 'file',
                            cssPath : [
                                '/Public/libs/cui/css/cui.min.css',
                                '/Public/libs/kindeditor/plugins/code/prettify.css'
                            ],
                            width : '100%',
                            height : '500px',
                            resizeType: 1,
                            pasteType : 2,
                            filterMode: <?php if(MODULE_MARK === 'Admin') {echo 'false';} else {echo 'true';} ?>,
                            urlType : "",
                            fileManagerJson : '<?php echo U(MODULE_MARK."/Upload/fileManager");?>',
                            uploadJson : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            extraFileUploadParams: {
                                session_id : '<?php echo session_id();?>'
                            },
                            afterBlur: function(){this.sync();}
                        });
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "editormd": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>" style="z-index: 1000;" class="form-control" <?php echo ($tab_form["extra"]["attr"]); ?>></div>
            <pre id="default_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>" class="hidden"><?php echo ($tab_form["value"]); ?></pre>

            <link rel="stylesheet" type="text/css" href="/Public/libs/editormd/css/editormd.min.css">
            <script type="text/javascript" src="/Public/libs/editormd/js/editormd.min.js"></script>

            <script type="text/javascript">
                $(function(){
                var editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>_content = $('#default_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>').text();
                    var editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?> = editormd({
                            id              : 'tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>',
                            path            : '/Public/libs/editormd/lib/',
                            pluginPath      : '/Public/libs/editormd/plugins/',
                            name            : '<?php echo ($tab_form["name"]); ?>',
                            markdown        : editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>_content,
                            imageUpload     : true,
                            imageFormats    : ["jpg", "jpeg", "gif", "png", "bmp"],
                            imageUploadURL  : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            placeholder     : 'CoreThink让开发更轻松！',
                            width           : '100%',
                            height          : 640,
                            watch           : <?php if(MODULE_MARK === 'Admin'){ echo 'false';} else {echo 'true';} ?>,
                            codeFold        : true,
                            htmlDecode      : false,
                            toolbarAutoFixed: false,
                        });
                });
            </script>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "tags": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>" class="form-control" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input.css">
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input-bootstrap.css">
            <script type="text/javascript" src="/Public/libs/jquery_tokeninput/js/jquery.tokeninput.min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    //标签自动完成
                    var tags = $('#tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>'), tagsPre = [];
                    if (tags.length > 0) {
                        var items = tags.val().split(','), result = [];
                        for (var i = 0; i < items.length; i ++) {
                            var tag = items[i];
                            if (!tag) {
                                continue;
                            }
                            tagsPre.push({
                                id      :   tag,
                                title   :   tag
                            });
                        }
                    }
                    tags.tokenInput("<?php echo U(MODULE_NAME.'/Tag/search'); ?>",{
                        propertyToSearch    :   'title',
                        tokenValue          :   'title',
                        searchDelay         :   0,
                        tokenLimit          :   10,
                        preventDuplicates   :   true,
                        animateDropdown     :   true,
                        allowFreeTagging    :   true,
                        hintText            :   '请输入标签名',
                        noResultsText       :   '此标签不存在, 按回车创建',
                        searchingText       :   "查找中...",
                        prePopulate         :   tagsPre,
                        theme               :   'bootstrap',
                        onAdd: function (item){ //新增系统没有的标签时提交到数据库
                            $.post("<?php echo U(MODULE_NAME.'/Tag/add'); ?>", {'title': item.title});
                        }
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "board": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value='<?php echo ($tab_form["value"]); ?>'>
            <div class="row board_list boards_<?php echo ($tab_k); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <div class="container-fluid">
                    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                            <div class="panel-heading">
                                <strong><?php echo ($option["title"]); ?></strong>
                            </div>
                            <div class="list-group dragsort_<?php echo ($tab_k); ?>" data-group="<?php echo ($option_key); ?>">
                                <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                        <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
            <script type="text/javascript">
                //拖曳插件初始化
                $(function(){
                    $(".dragsort_<?php echo ($tab_k); ?>").dragsort({
                         dragSelector:'div',
                         placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                         dragBetween:true, //允许拖动到任意地方
                         dragEnd:function(){
                             var self = $(this);
                             self.find('input').attr('name', '<?php echo ($tab_form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($tab_k); ?>').data('group') + '][]');
                         }
                     });
                });
            </script>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                // 扩展类型
                                                                <?php default: ?>
                                                                <?php echo hook('FormBuilderExtend', array('form' => $tab_form, 'type' => tab_)); endswitch; endforeach; endif; else: echo "" ;endif; ?>
                                                    </div>
                                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group"><hr></div><?php break;?>

                                // 扩展类型
                                <?php default: ?>
                                <?php echo hook('FormBuilderExtend', array('form' => $form)); endswitch; endforeach; endif; else: echo "" ;endif; ?>
                        <?php if(empty($form_items)): ?><div class="builder-data-empty text-center">
                                <div class="empty-info">
                                    <i class="fa fa-database"></i> 暂时没有数据<br>
                                    <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                                </div>
                            </div><?php endif; ?>
                        <div class="form-group"></div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block submit <?php if($ajax_submit) echo 'ajax-post';?> visible-xs visible-sm" type="submit" target-form="form-builder">确定</button>
                            <button class="btn btn-primary submit <?php if($ajax_submit) echo 'ajax-post';?> visible-md-inline visible-lg-inline" type="submit" target-form="form-builder">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php echo ($extra_html); ?>
</div>


                            </div>

                            <div class="clearfix footer hidden-xs">
                                <div class="navbar navbar-default" role="navigation">
                                    <div class="container-fluid">
                                        <div class="navbar-header">
                                            <a class="navbar-brand" target="_blank" href="/">
                                                <span><?php echo C('PRODUCT_NAME');?></span>
                                            </a>
                                        </div>
                                        <div class="collapse navbar-collapse navbar-collapse-bottom">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank">
                                                        <span>版权所有 © <?php echo date("Y",time()); ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="nav navbar-nav navbar-right">
                                                <li><a class="text-muted pull-right">开发联系：<?php echo C('COMPANY_NAME');?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                
    <div class="builder formbuilder-box panel-body">
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs builder-form-tabs">
            <ul class="nav nav-tabs">
                <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="form-group"></div><?php endif; ?>

    
    <div class="builder-container">
        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo ($post_url); ?>" method="post" class="form-horizontal form form-builder">
                    <div class="col-xs-12">
                        <?php if(is_array($form_items)): $k = 0; $__LIST__ = $form_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$form): $mod = ($k % 2 );++$k; switch($form["type"]): case "hidden": ?><div class="form-group hidden item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" class="form-control input" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
        </div>
    </div><?php break;?>

                                
                                <?php case "static": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <p><?php echo ($form["value"]); ?></p>
        </div>
    </div><?php break;?>

                                
                                <?php case "num": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "price": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "text": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input text" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "textarea": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra"]["attr"]); ?>><?php echo ($form["value"]); ?></textarea>
            <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "array": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($form["name"]); ?>" <?php echo ($form["extra"]["attr"]); ?>><?php echo ($form["value"]); ?></textarea>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "password": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="password" class="form-control input password" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="radio-inline cui-control cui-radio">
                    <label for="<?php echo ($form["name"]); echo ($option_key); ?>">
                        <?php if(is_array($option)): ?>
                            <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="radio" id="<?php echo ($form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>> 
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="checkbox-inline cui-control cui-checkbox">
                    <label class="checkbox-label">
                        <?php if(is_array($option)): ?>
                            <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="checkbox" name="<?php echo ($form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($form["value"])?$form["value"]:explode(',',$form["value"]))): ?>checked<?php endif; ?> <?php echo ($form["extra"]["attr"]); ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <select name="<?php echo ($form["name"]); ?>" class="form-control cui-select select" <?php echo ($form["extra"]["attr"]); ?>>
                <option value=''>请选择：</option>
                <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): if(is_array($option)): ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>
                            <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <?php echo ($option["title"]); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
                    <?php endif; endforeach; endif; ?>
            </select>
        </div>
    </div><?php break;?>

                                
                                <?php case "icon": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div class="input-group input" id="<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                </span>
                <input type="text" class="form-control" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            </div>
            <script type="text/javascript">
                $(function(){
                    $("#<?php echo ($group_k); ?>_icon_<?php echo ($k); ?>").iconpicker({
                        icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "date": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_date_<?php echo ($k); ?>" class="form-control input date" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"],'Y-m-d')); endif; ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#<?php echo ($group_k); ?>_date_<?php echo ($k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd',
                        autoclose   : true,
                        minView     : 'month',
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "datetime": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_time_<?php echo ($k); ?>" class="form-control input time" name="<?php echo ($form["name"]); ?>" value="<?php if(!empty($form["value"])): echo (time_format($form["value"],'Y-m-d H:i:s')); endif; ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#<?php echo ($group_k); ?>_time_<?php echo ($k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd hh:ii:ss',
                        autoclose   : true,
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "picture": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right row">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="col-md-4 file-item thumbnail">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img src="<?php echo (get_cover($form["value"])); ?>" data-id="<?php echo ($form["value"]); ?>">
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="col-md-4 file-item thumbnail hidden">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img>
                        </div><?php endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传图片</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> img').attr('src', response.url);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-picture', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "pictures": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right row">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($form["value"])): if (is_array($form['value'])) { $images = $form['value']; $input_value = implode(',', $form['value']); } else { $images = explode(',', $form['value']); $input_value = $form['value']; } ?>
                        <?php if(is_array($images)): foreach($images as $key=>$img): ?><div class="col-md-4 thumbnail">
                                <i class="fa fa-times-circle remove-picture"></i>
                                <img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>">
                            </div><?php endforeach; endif; endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多图</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<div id="' + file.id + '" class="col-md-3 thumbnail">' +
                                    '<i class="fa fa-times-circle remove-picture"></i>' +
                                    '<img>' +
                                '</div>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                            $( '#'+file.id + ' img').attr('src', response.url);
                            $( '#'+file.id + ' img').attr('data-id', response.id);
                        } else {
                            $.alertMessager('错误：：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-picture', function() {
                        var ready_for_remove_id = $(this).closest('.thumbnail').find('img').attr('data-id'); //获取待删除的图片ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_picture_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                        current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.thumbnail').remove(); //删除图片预览图
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "file": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "files": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($form["value"])): if (is_array($form['value'])) { $files = $form['value']; $input_value = implode(',', $form['value']); } else { $files = explode(',', $form['value']); $input_value = $form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "file": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <?php if(!empty($form["value"])): ?><div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',         // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').removeClass('hidden');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).attr('value', response.id);
                            $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#<?php echo ($group_k); ?>_upload_preview_<?php echo ($k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "files": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div  id="<?php echo ($group_k); ?>_upload_box_<?php echo ($k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($form["value"])): if (is_array($form['value'])) { $files = $form['value']; $input_value = implode(',', $form['value']); } else { $files = explode(',', $form['value']); $input_value = $form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>" name="<?php echo ($form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',     // 文件接收服务端
                        pick: '#<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_<?php echo ($group_k); ?>_upload_<?php echo ($k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#<?php echo ($group_k); ?>_upload_list_<?php echo ($k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#<?php echo ($group_k); ?>_upload_input_<?php echo ($k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "kindeditor": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <textarea name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>" class="form-control" <?php echo ($form["extra"]["attr"]); ?>>
                <?php echo ($form["value"]); ?>
            </textarea>
            <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    KindEditor.ready(function(K) {
                        kindeditor_<?php echo ($k); ?> = K.create('#<?php echo ($group_k); ?>_kindeditor_<?php echo ($k); ?>', {
                            allowFileManager : true,
                            filePostName : 'file',
                            cssPath : [
                                '/Public/libs/cui/css/cui.min.css',
                                '/Public/libs/kindeditor/plugins/code/prettify.css'
                            ],
                            width : '100%',
                            height : '500px',
                            resizeType: 1,
                            pasteType : 2,
                            filterMode: <?php if(MODULE_MARK === 'Admin') {echo 'false';} else {echo 'true';} ?>,
                            urlType : "",
                            fileManagerJson : '<?php echo U(MODULE_MARK."/Upload/fileManager");?>',
                            uploadJson : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            extraFileUploadParams: {
                                session_id : '<?php echo session_id();?>'
                            },
                            afterBlur: function(){this.sync();}
                        });
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "editormd": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <div name="<?php echo ($form["name"]); ?>" id="<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>" style="z-index: 1000;" class="form-control" <?php echo ($form["extra"]["attr"]); ?>></div>
            <pre id="default_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>" class="hidden"><?php echo ($form["value"]); ?></pre>

            <link rel="stylesheet" type="text/css" href="/Public/libs/editormd/css/editormd.min.css">
            <script type="text/javascript" src="/Public/libs/editormd/js/editormd.min.js"></script>

            <script type="text/javascript">
                $(function(){
                var editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>_content = $('#default_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>').text();
                    var editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?> = editormd({
                            id              : '<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>',
                            path            : '/Public/libs/editormd/lib/',
                            pluginPath      : '/Public/libs/editormd/plugins/',
                            name            : '<?php echo ($form["name"]); ?>',
                            markdown        : editormd_<?php echo ($group_k); ?>_markdown_<?php echo ($k); ?>_content,
                            imageUpload     : true,
                            imageFormats    : ["jpg", "jpeg", "gif", "png", "bmp"],
                            imageUploadURL  : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            placeholder     : 'CoreThink让开发更轻松！',
                            width           : '100%',
                            height          : 640,
                            watch           : <?php if(MODULE_MARK === 'Admin'){ echo 'false';} else {echo 'true';} ?>,
                            codeFold        : true,
                            htmlDecode      : false,
                            toolbarAutoFixed: false,
                        });
                });
            </script>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                
                                <?php case "tags": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>" class="form-control" name="<?php echo ($form["name"]); ?>" value="<?php echo ($form["value"]); ?>" <?php echo ($form["extra"]["attr"]); ?>>
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input.css">
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input-bootstrap.css">
            <script type="text/javascript" src="/Public/libs/jquery_tokeninput/js/jquery.tokeninput.min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    //标签自动完成
                    var tags = $('#<?php echo ($group_k); ?>_tag_<?php echo ($k); ?>'), tagsPre = [];
                    if (tags.length > 0) {
                        var items = tags.val().split(','), result = [];
                        for (var i = 0; i < items.length; i ++) {
                            var tag = items[i];
                            if (!tag) {
                                continue;
                            }
                            tagsPre.push({
                                id      :   tag,
                                title   :   tag
                            });
                        }
                    }
                    tags.tokenInput("<?php echo U(MODULE_NAME.'/Tag/search'); ?>",{
                        propertyToSearch    :   'title',
                        tokenValue          :   'title',
                        searchDelay         :   0,
                        tokenLimit          :   10,
                        preventDuplicates   :   true,
                        animateDropdown     :   true,
                        allowFreeTagging    :   true,
                        hintText            :   '请输入标签名',
                        noResultsText       :   '此标签不存在, 按回车创建',
                        searchingText       :   "查找中...",
                        prePopulate         :   tagsPre,
                        theme               :   'bootstrap',
                        onAdd: function (item){ //新增系统没有的标签时提交到数据库
                            $.post("<?php echo U(MODULE_NAME.'/Tag/add'); ?>", {'title': item.title});
                        }
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                
                                <?php case "board": ?><div class="form-group item_<?php echo ($form["name"]); ?> <?php echo ($form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" name="<?php echo ($form["name"]); ?>" value='<?php echo ($form["value"]); ?>'>
            <div class="row board_list boards_<?php echo ($k); ?>" <?php echo ($form["extra"]["attr"]); ?>>
                <div class="container-fluid">
                    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                            <div class="panel-heading">
                                <strong><?php echo ($option["title"]); ?></strong>
                            </div>
                            <div class="list-group dragsort_<?php echo ($k); ?>" data-group="<?php echo ($option_key); ?>">
                                <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                        <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                        <input type="hidden" name="<?php echo ($form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
            <script type="text/javascript">
                //拖曳插件初始化
                $(function(){
                    $(".dragsort_<?php echo ($k); ?>").dragsort({
                         dragSelector:'div',
                         placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                         dragBetween:true, //允许拖动到任意地方
                         dragEnd:function(){
                             var self = $(this);
                             self.find('input').attr('name', '<?php echo ($form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($k); ?>').data('group') + '][]');
                         }
                     });
                });
            </script>
            <?php if(!empty($form["tip"])): ?><span class="check-tips small"><?php echo ($form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>


                                <?php case "group": ?><div class="form-group"></div>
                                    <div class="builder-tabs form-group">
                                        <ul class="nav nav-tabs">
                                            <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($group_k % 2 );++$group_k;?><li data-tab="tab<?php echo ($group_k); ?>" <?php if(($group_k) == "1"): ?>class="active"<?php endif; ?>><a href="#tab<?php echo ($group_k); ?>" data-toggle="tab"><?php echo ($li["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                    <div class="builder-container">
                                        <div class="tab-content">
                                            <?php if(is_array($form["options"])): $group_k = 0; $__LIST__ = $form["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($group_k % 2 );++$group_k;?><div id="tab<?php echo ($group_k); ?>" class='tab-pane <?php if(($group_k) == "1"): ?>active<?php endif; ?> tab<?php echo ($group_k); ?>'>
                                                    <div class="group">
                                                        <?php if(is_array($tab["options"])): $tab_k = 0; $__LIST__ = $tab["options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab_form): $mod = ($tab_k % 2 );++$tab_k; switch($tab_form["type"]): case "hidden": ?><div class="form-group hidden item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" class="form-control input" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "static": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <p><?php echo ($tab_form["value"]); ?></p>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "num": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "price": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input num" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "text": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" class="form-control input text" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "textarea": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "array": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea class="form-control textarea" rows="5" name="<?php echo ($tab_form["name"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>><?php echo ($tab_form["value"]); ?></textarea>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "password": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="password" class="form-control input password" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "radio": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><div class="radio-inline cui-control cui-radio">
                    <label for="<?php echo ($tab_form["name"]); echo ($option_key); ?>">
                        <?php if(is_array($option)): ?>
                            <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="radio" id="<?php echo ($tab_form["name"]); echo ($option_key); ?>" class="radio" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>> 
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "checkbox": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): ?><div class="checkbox-inline cui-control cui-checkbox">
                    <label class="checkbox-label">
                        <?php if(is_array($option)): ?>
                            <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>
                                <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option["title"]); ?></span>
                        <?php else: ?>
                            <input type="checkbox" name="<?php echo ($tab_form["name"]); ?>[]" value="<?php echo ($option_key); ?>" <?php if(in_array(($option_key), is_array($tab_form["value"])?$tab_form["value"]:explode(',',$tab_form["value"]))): ?>checked<?php endif; ?> <?php echo ($tab_form["extra"]["attr"]); ?>>
                            <span class="cui-control-indicator"></span>
                            <span><?php echo ($option); ?></span>
                        <?php endif; ?>
                    </label>
                </div><?php endforeach; endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "select": ?><!--
        如果选项的值是自定义数组(必须定义key为title的元素)需要解析，如果选项的值是常规字符串直接显示
        此处主要是用来给option定义更多的属性，比如data-ia=1，那么option应为
        $option = array('title' => 标题, 'data-id' => 1);
    -->
    <div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <select name="<?php echo ($tab_form["name"]); ?>" class="form-control cui-select select" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <option value=''>请选择：</option>
                <?php if(is_array($tab_form["options"])): foreach($tab_form["options"] as $option_key=>$option): if(is_array($option)): ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>
                            <?php if(is_array($option)): foreach($option as $option_key2=>$option2): echo ($option_key2); ?>="<?php echo ($option2); ?>"<?php endforeach; endif; ?>>
                            <?php echo ($option["title"]); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?php echo ($option_key); ?>" <?php if(($tab_form["value"]) == $option_key): ?>selected<?php endif; ?>><?php echo ($option); ?></option>
                    <?php endif; endforeach; endif; ?>
            </select>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "icon": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div class="input-group input" id="tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-fw fa-info-circle"></i> 点击选择图标</button>
                </span>
                <input type="text" class="form-control" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            </div>
            <script type="text/javascript">
                $(function(){
                    $("#tab_<?php echo ($group_k); ?>_icon_<?php echo ($tab_k); ?>").iconpicker({
                        icons: '[{"filter":"glass","name":"glass","selector":"fa-glass"},{"filter":"music","name":"music","selector":"fa-music"},{"filter":"search","name":"search","selector":"fa-search"},{"filter":"envelope-o","name":"envelope-o","selector":"fa-envelope-o"},{"filter":"heart","name":"heart","selector":"fa-heart"},{"filter":"star","name":"star","selector":"fa-star"},{"filter":"star-o","name":"star-o","selector":"fa-star-o"},{"filter":"user","name":"user","selector":"fa-user"},{"filter":"film","name":"film","selector":"fa-film"},{"filter":"th-large","name":"th-large","selector":"fa-th-large"},{"filter":"th","name":"th","selector":"fa-th"},{"filter":"th-list","name":"th-list","selector":"fa-th-list"},{"filter":"check","name":"check","selector":"fa-check"},{"filter":"times","name":"times","selector":"fa-times"},{"filter":"search-plus","name":"search-plus","selector":"fa-search-plus"},{"filter":"search-minus","name":"search-minus","selector":"fa-search-minus"},{"filter":"power-off","name":"power-off","selector":"fa-power-off"},{"filter":"signal","name":"signal","selector":"fa-signal"},{"filter":"cog","name":"cog","selector":"fa-cog"},{"filter":"trash-o","name":"trash-o","selector":"fa-trash-o"},{"filter":"home","name":"home","selector":"fa-home"},{"filter":"file-o","name":"file-o","selector":"fa-file-o"},{"filter":"clock-o","name":"clock-o","selector":"fa-clock-o"},{"filter":"road","name":"road","selector":"fa-road"},{"filter":"download","name":"download","selector":"fa-download"},{"filter":"arrow-circle-o-down","name":"arrow-circle-o-down","selector":"fa-arrow-circle-o-down"},{"filter":"arrow-circle-o-up","name":"arrow-circle-o-up","selector":"fa-arrow-circle-o-up"},{"filter":"inbox","name":"inbox","selector":"fa-inbox"},{"filter":"play-circle-o","name":"play-circle-o","selector":"fa-play-circle-o"},{"filter":"repeat","name":"repeat","selector":"fa-repeat"},{"filter":"refresh","name":"refresh","selector":"fa-refresh"},{"filter":"list-alt","name":"list-alt","selector":"fa-list-alt"},{"filter":"lock","name":"lock","selector":"fa-lock"},{"filter":"flag","name":"flag","selector":"fa-flag"},{"filter":"headphones","name":"headphones","selector":"fa-headphones"},{"filter":"volume-off","name":"volume-off","selector":"fa-volume-off"},{"filter":"volume-down","name":"volume-down","selector":"fa-volume-down"},{"filter":"volume-up","name":"volume-up","selector":"fa-volume-up"},{"filter":"qrcode","name":"qrcode","selector":"fa-qrcode"},{"filter":"barcode","name":"barcode","selector":"fa-barcode"},{"filter":"tag","name":"tag","selector":"fa-tag"},{"filter":"tags","name":"tags","selector":"fa-tags"},{"filter":"book","name":"book","selector":"fa-book"},{"filter":"bookmark","name":"bookmark","selector":"fa-bookmark"},{"filter":"print","name":"print","selector":"fa-print"},{"filter":"camera","name":"camera","selector":"fa-camera"},{"filter":"font","name":"font","selector":"fa-font"},{"filter":"bold","name":"bold","selector":"fa-bold"},{"filter":"italic","name":"italic","selector":"fa-italic"},{"filter":"text-height","name":"text-height","selector":"fa-text-height"},{"filter":"text-width","name":"text-width","selector":"fa-text-width"},{"filter":"align-left","name":"align-left","selector":"fa-align-left"},{"filter":"align-center","name":"align-center","selector":"fa-align-center"},{"filter":"align-right","name":"align-right","selector":"fa-align-right"},{"filter":"align-justify","name":"align-justify","selector":"fa-align-justify"},{"filter":"list","name":"list","selector":"fa-list"},{"filter":"outdent","name":"outdent","selector":"fa-outdent"},{"filter":"indent","name":"indent","selector":"fa-indent"},{"filter":"video-camera","name":"video-camera","selector":"fa-video-camera"},{"filter":"picture-o","name":"picture-o","selector":"fa-picture-o"},{"filter":"pencil","name":"pencil","selector":"fa-pencil"},{"filter":"map-marker","name":"map-marker","selector":"fa-map-marker"},{"filter":"adjust","name":"adjust","selector":"fa-adjust"},{"filter":"tint","name":"tint","selector":"fa-tint"},{"filter":"pencil-square-o","name":"pencil-square-o","selector":"fa-pencil-square-o"},{"filter":"share-square-o","name":"share-square-o","selector":"fa-share-square-o"},{"filter":"check-square-o","name":"check-square-o","selector":"fa-check-square-o"},{"filter":"arrows","name":"arrows","selector":"fa-arrows"},{"filter":"step-backward","name":"step-backward","selector":"fa-step-backward"},{"filter":"fast-backward","name":"fast-backward","selector":"fa-fast-backward"},{"filter":"backward","name":"backward","selector":"fa-backward"},{"filter":"play","name":"play","selector":"fa-play"},{"filter":"pause","name":"pause","selector":"fa-pause"},{"filter":"stop","name":"stop","selector":"fa-stop"},{"filter":"forward","name":"forward","selector":"fa-forward"},{"filter":"fast-forward","name":"fast-forward","selector":"fa-fast-forward"},{"filter":"step-forward","name":"step-forward","selector":"fa-step-forward"},{"filter":"eject","name":"eject","selector":"fa-eject"},{"filter":"chevron-left","name":"chevron-left","selector":"fa-chevron-left"},{"filter":"chevron-right","name":"chevron-right","selector":"fa-chevron-right"},{"filter":"plus-circle","name":"plus-circle","selector":"fa-plus-circle"},{"filter":"minus-circle","name":"minus-circle","selector":"fa-minus-circle"},{"filter":"times-circle","name":"times-circle","selector":"fa-times-circle"},{"filter":"check-circle","name":"check-circle","selector":"fa-check-circle"},{"filter":"question-circle","name":"question-circle","selector":"fa-question-circle"},{"filter":"info-circle","name":"info-circle","selector":"fa-info-circle"},{"filter":"crosshairs","name":"crosshairs","selector":"fa-crosshairs"},{"filter":"times-circle-o","name":"times-circle-o","selector":"fa-times-circle-o"},{"filter":"check-circle-o","name":"check-circle-o","selector":"fa-check-circle-o"},{"filter":"ban","name":"ban","selector":"fa-ban"},{"filter":"arrow-left","name":"arrow-left","selector":"fa-arrow-left"},{"filter":"arrow-right","name":"arrow-right","selector":"fa-arrow-right"},{"filter":"arrow-up","name":"arrow-up","selector":"fa-arrow-up"},{"filter":"arrow-down","name":"arrow-down","selector":"fa-arrow-down"},{"filter":"share","name":"share","selector":"fa-share"},{"filter":"expand","name":"expand","selector":"fa-expand"},{"filter":"compress","name":"compress","selector":"fa-compress"},{"filter":"plus","name":"plus","selector":"fa-plus"},{"filter":"minus","name":"minus","selector":"fa-minus"},{"filter":"asterisk","name":"asterisk","selector":"fa-asterisk"},{"filter":"exclamation-circle","name":"exclamation-circle","selector":"fa-exclamation-circle"},{"filter":"gift","name":"gift","selector":"fa-gift"},{"filter":"leaf","name":"leaf","selector":"fa-leaf"},{"filter":"fire","name":"fire","selector":"fa-fire"},{"filter":"eye","name":"eye","selector":"fa-eye"},{"filter":"eye-slash","name":"eye-slash","selector":"fa-eye-slash"},{"filter":"exclamation-triangle","name":"exclamation-triangle","selector":"fa-exclamation-triangle"},{"filter":"plane","name":"plane","selector":"fa-plane"},{"filter":"calendar","name":"calendar","selector":"fa-calendar"},{"filter":"random","name":"random","selector":"fa-random"},{"filter":"comment","name":"comment","selector":"fa-comment"},{"filter":"magnet","name":"magnet","selector":"fa-magnet"},{"filter":"chevron-up","name":"chevron-up","selector":"fa-chevron-up"},{"filter":"chevron-down","name":"chevron-down","selector":"fa-chevron-down"},{"filter":"retweet","name":"retweet","selector":"fa-retweet"},{"filter":"shopping-cart","name":"shopping-cart","selector":"fa-shopping-cart"},{"filter":"folder","name":"folder","selector":"fa-folder"},{"filter":"folder-open","name":"folder-open","selector":"fa-folder-open"},{"filter":"arrows-v","name":"arrows-v","selector":"fa-arrows-v"},{"filter":"arrows-h","name":"arrows-h","selector":"fa-arrows-h"},{"filter":"bar-chart-o","name":"bar-chart-o","selector":"fa-bar-chart-o"},{"filter":"twitter-square","name":"twitter-square","selector":"fa-twitter-square"},{"filter":"facebook-square","name":"facebook-square","selector":"fa-facebook-square"},{"filter":"camera-retro","name":"camera-retro","selector":"fa-camera-retro"},{"filter":"key","name":"key","selector":"fa-key"},{"filter":"cogs","name":"cogs","selector":"fa-cogs"},{"filter":"comments","name":"comments","selector":"fa-comments"},{"filter":"thumbs-o-up","name":"thumbs-o-up","selector":"fa-thumbs-o-up"},{"filter":"thumbs-o-down","name":"thumbs-o-down","selector":"fa-thumbs-o-down"},{"filter":"star-half","name":"star-half","selector":"fa-star-half"},{"filter":"heart-o","name":"heart-o","selector":"fa-heart-o"},{"filter":"sign-out","name":"sign-out","selector":"fa-sign-out"},{"filter":"linkedin-square","name":"linkedin-square","selector":"fa-linkedin-square"},{"filter":"thumb-tack","name":"thumb-tack","selector":"fa-thumb-tack"},{"filter":"external-link","name":"external-link","selector":"fa-external-link"},{"filter":"sign-in","name":"sign-in","selector":"fa-sign-in"},{"filter":"trophy","name":"trophy","selector":"fa-trophy"},{"filter":"github-square","name":"github-square","selector":"fa-github-square"},{"filter":"upload","name":"upload","selector":"fa-upload"},{"filter":"lemon-o","name":"lemon-o","selector":"fa-lemon-o"},{"filter":"phone","name":"phone","selector":"fa-phone"},{"filter":"square-o","name":"square-o","selector":"fa-square-o"},{"filter":"bookmark-o","name":"bookmark-o","selector":"fa-bookmark-o"},{"filter":"phone-square","name":"phone-square","selector":"fa-phone-square"},{"filter":"twitter","name":"twitter","selector":"fa-twitter"},{"filter":"facebook","name":"facebook","selector":"fa-facebook"},{"filter":"github","name":"github","selector":"fa-github"},{"filter":"unlock","name":"unlock","selector":"fa-unlock"},{"filter":"credit-card","name":"credit-card","selector":"fa-credit-card"},{"filter":"rss","name":"rss","selector":"fa-rss"},{"filter":"hdd-o","name":"hdd-o","selector":"fa-hdd-o"},{"filter":"bullhorn","name":"bullhorn","selector":"fa-bullhorn"},{"filter":"bell","name":"bell","selector":"fa-bell"},{"filter":"certificate","name":"certificate","selector":"fa-certificate"},{"filter":"hand-o-right","name":"hand-o-right","selector":"fa-hand-o-right"},{"filter":"hand-o-left","name":"hand-o-left","selector":"fa-hand-o-left"},{"filter":"hand-o-up","name":"hand-o-up","selector":"fa-hand-o-up"},{"filter":"hand-o-down","name":"hand-o-down","selector":"fa-hand-o-down"},{"filter":"arrow-circle-left","name":"arrow-circle-left","selector":"fa-arrow-circle-left"},{"filter":"arrow-circle-right","name":"arrow-circle-right","selector":"fa-arrow-circle-right"},{"filter":"arrow-circle-up","name":"arrow-circle-up","selector":"fa-arrow-circle-up"},{"filter":"arrow-circle-down","name":"arrow-circle-down","selector":"fa-arrow-circle-down"},{"filter":"globe","name":"globe","selector":"fa-globe"},{"filter":"wrench","name":"wrench","selector":"fa-wrench"},{"filter":"tasks","name":"tasks","selector":"fa-tasks"},{"filter":"filter","name":"filter","selector":"fa-filter"},{"filter":"briefcase","name":"briefcase","selector":"fa-briefcase"},{"filter":"arrows-alt","name":"arrows-alt","selector":"fa-arrows-alt"},{"filter":"users","name":"users","selector":"fa-users"},{"filter":"link","name":"link","selector":"fa-link"},{"filter":"cloud","name":"cloud","selector":"fa-cloud"},{"filter":"flask","name":"flask","selector":"fa-flask"},{"filter":"scissors","name":"scissors","selector":"fa-scissors"},{"filter":"files-o","name":"files-o","selector":"fa-files-o"},{"filter":"paperclip","name":"paperclip","selector":"fa-paperclip"},{"filter":"floppy-o","name":"floppy-o","selector":"fa-floppy-o"},{"filter":"square","name":"square","selector":"fa-square"},{"filter":"bars","name":"bars","selector":"fa-bars"},{"filter":"list-ul","name":"list-ul","selector":"fa-list-ul"},{"filter":"list-ol","name":"list-ol","selector":"fa-list-ol"},{"filter":"strikethrough","name":"strikethrough","selector":"fa-strikethrough"},{"filter":"underline","name":"underline","selector":"fa-underline"},{"filter":"table","name":"table","selector":"fa-table"},{"filter":"magic","name":"magic","selector":"fa-magic"},{"filter":"truck","name":"truck","selector":"fa-truck"},{"filter":"pinterest","name":"pinterest","selector":"fa-pinterest"},{"filter":"pinterest-square","name":"pinterest-square","selector":"fa-pinterest-square"},{"filter":"google-plus-square","name":"google-plus-square","selector":"fa-google-plus-square"},{"filter":"google-plus","name":"google-plus","selector":"fa-google-plus"},{"filter":"money","name":"money","selector":"fa-money"},{"filter":"caret-down","name":"caret-down","selector":"fa-caret-down"},{"filter":"caret-up","name":"caret-up","selector":"fa-caret-up"},{"filter":"caret-left","name":"caret-left","selector":"fa-caret-left"},{"filter":"caret-right","name":"caret-right","selector":"fa-caret-right"},{"filter":"columns","name":"columns","selector":"fa-columns"},{"filter":"sort","name":"sort","selector":"fa-sort"},{"filter":"sort-asc","name":"sort-asc","selector":"fa-sort-asc"},{"filter":"sort-desc","name":"sort-desc","selector":"fa-sort-desc"},{"filter":"envelope","name":"envelope","selector":"fa-envelope"},{"filter":"linkedin","name":"linkedin","selector":"fa-linkedin"},{"filter":"undo","name":"undo","selector":"fa-undo"},{"filter":"gavel","name":"gavel","selector":"fa-gavel"},{"filter":"tachometer","name":"tachometer","selector":"fa-tachometer"},{"filter":"comment-o","name":"comment-o","selector":"fa-comment-o"},{"filter":"comments-o","name":"comments-o","selector":"fa-comments-o"},{"filter":"bolt","name":"bolt","selector":"fa-bolt"},{"filter":"sitemap","name":"sitemap","selector":"fa-sitemap"},{"filter":"umbrella","name":"umbrella","selector":"fa-umbrella"},{"filter":"clipboard","name":"clipboard","selector":"fa-clipboard"},{"filter":"lightbulb-o","name":"lightbulb-o","selector":"fa-lightbulb-o"},{"filter":"exchange","name":"exchange","selector":"fa-exchange"},{"filter":"cloud-download","name":"cloud-download","selector":"fa-cloud-download"},{"filter":"cloud-upload","name":"cloud-upload","selector":"fa-cloud-upload"},{"filter":"user-md","name":"user-md","selector":"fa-user-md"},{"filter":"stethoscope","name":"stethoscope","selector":"fa-stethoscope"},{"filter":"suitcase","name":"suitcase","selector":"fa-suitcase"},{"filter":"bell-o","name":"bell-o","selector":"fa-bell-o"},{"filter":"coffee","name":"coffee","selector":"fa-coffee"},{"filter":"cutlery","name":"cutlery","selector":"fa-cutlery"},{"filter":"file-text-o","name":"file-text-o","selector":"fa-file-text-o"},{"filter":"building-o","name":"building-o","selector":"fa-building-o"},{"filter":"hospital-o","name":"hospital-o","selector":"fa-hospital-o"},{"filter":"ambulance","name":"ambulance","selector":"fa-ambulance"},{"filter":"medkit","name":"medkit","selector":"fa-medkit"},{"filter":"fighter-jet","name":"fighter-jet","selector":"fa-fighter-jet"},{"filter":"beer","name":"beer","selector":"fa-beer"},{"filter":"h-square","name":"h-square","selector":"fa-h-square"},{"filter":"plus-square","name":"plus-square","selector":"fa-plus-square"},{"filter":"angle-double-left","name":"angle-double-left","selector":"fa-angle-double-left"},{"filter":"angle-double-right","name":"angle-double-right","selector":"fa-angle-double-right"},{"filter":"angle-double-up","name":"angle-double-up","selector":"fa-angle-double-up"},{"filter":"angle-double-down","name":"angle-double-down","selector":"fa-angle-double-down"},{"filter":"angle-left","name":"angle-left","selector":"fa-angle-left"},{"filter":"angle-right","name":"angle-right","selector":"fa-angle-right"},{"filter":"angle-up","name":"angle-up","selector":"fa-angle-up"},{"filter":"angle-down","name":"angle-down","selector":"fa-angle-down"},{"filter":"desktop","name":"desktop","selector":"fa-desktop"},{"filter":"laptop","name":"laptop","selector":"fa-laptop"},{"filter":"tablet","name":"tablet","selector":"fa-tablet"},{"filter":"mobile","name":"mobile","selector":"fa-mobile"},{"filter":"circle-o","name":"circle-o","selector":"fa-circle-o"},{"filter":"quote-left","name":"quote-left","selector":"fa-quote-left"},{"filter":"quote-right","name":"quote-right","selector":"fa-quote-right"},{"filter":"spinner","name":"spinner","selector":"fa-spinner"},{"filter":"circle","name":"circle","selector":"fa-circle"},{"filter":"reply","name":"reply","selector":"fa-reply"},{"filter":"github-alt","name":"github-alt","selector":"fa-github-alt"},{"filter":"folder-o","name":"folder-o","selector":"fa-folder-o"},{"filter":"folder-open-o","name":"folder-open-o","selector":"fa-folder-open-o"},{"filter":"smile-o","name":"smile-o","selector":"fa-smile-o"},{"filter":"frown-o","name":"frown-o","selector":"fa-frown-o"},{"filter":"meh-o","name":"meh-o","selector":"fa-meh-o"},{"filter":"gamepad","name":"gamepad","selector":"fa-gamepad"},{"filter":"keyboard-o","name":"keyboard-o","selector":"fa-keyboard-o"},{"filter":"flag-o","name":"flag-o","selector":"fa-flag-o"},{"filter":"flag-checkered","name":"flag-checkered","selector":"fa-flag-checkered"},{"filter":"terminal","name":"terminal","selector":"fa-terminal"},{"filter":"code","name":"code","selector":"fa-code"},{"filter":"reply-all","name":"reply-all","selector":"fa-reply-all"},{"filter":"mail-reply-all","name":"mail-reply-all","selector":"fa-mail-reply-all"},{"filter":"star-half-o","name":"star-half-o","selector":"fa-star-half-o"},{"filter":"location-arrow","name":"location-arrow","selector":"fa-location-arrow"},{"filter":"crop","name":"crop","selector":"fa-crop"},{"filter":"code-fork","name":"code-fork","selector":"fa-code-fork"},{"filter":"chain-broken","name":"chain-broken","selector":"fa-chain-broken"},{"filter":"question","name":"question","selector":"fa-question"},{"filter":"info","name":"info","selector":"fa-info"},{"filter":"exclamation","name":"exclamation","selector":"fa-exclamation"},{"filter":"superscript","name":"superscript","selector":"fa-superscript"},{"filter":"subscript","name":"subscript","selector":"fa-subscript"},{"filter":"eraser","name":"eraser","selector":"fa-eraser"},{"filter":"puzzle-piece","name":"puzzle-piece","selector":"fa-puzzle-piece"},{"filter":"microphone","name":"microphone","selector":"fa-microphone"},{"filter":"microphone-slash","name":"microphone-slash","selector":"fa-microphone-slash"},{"filter":"shield","name":"shield","selector":"fa-shield"},{"filter":"calendar-o","name":"calendar-o","selector":"fa-calendar-o"},{"filter":"fire-extinguisher","name":"fire-extinguisher","selector":"fa-fire-extinguisher"},{"filter":"rocket","name":"rocket","selector":"fa-rocket"},{"filter":"maxcdn","name":"maxcdn","selector":"fa-maxcdn"},{"filter":"chevron-circle-left","name":"chevron-circle-left","selector":"fa-chevron-circle-left"},{"filter":"chevron-circle-right","name":"chevron-circle-right","selector":"fa-chevron-circle-right"},{"filter":"chevron-circle-up","name":"chevron-circle-up","selector":"fa-chevron-circle-up"},{"filter":"chevron-circle-down","name":"chevron-circle-down","selector":"fa-chevron-circle-down"},{"filter":"html5","name":"html5","selector":"fa-html5"},{"filter":"css3","name":"css3","selector":"fa-css3"},{"filter":"anchor","name":"anchor","selector":"fa-anchor"},{"filter":"unlock-alt","name":"unlock-alt","selector":"fa-unlock-alt"},{"filter":"bullseye","name":"bullseye","selector":"fa-bullseye"},{"filter":"ellipsis-h","name":"ellipsis-h","selector":"fa-ellipsis-h"},{"filter":"ellipsis-v","name":"ellipsis-v","selector":"fa-ellipsis-v"},{"filter":"rss-square","name":"rss-square","selector":"fa-rss-square"},{"filter":"play-circle","name":"play-circle","selector":"fa-play-circle"},{"filter":"ticket","name":"ticket","selector":"fa-ticket"},{"filter":"minus-square","name":"minus-square","selector":"fa-minus-square"},{"filter":"minus-square-o","name":"minus-square-o","selector":"fa-minus-square-o"},{"filter":"level-up","name":"level-up","selector":"fa-level-up"},{"filter":"level-down","name":"level-down","selector":"fa-level-down"},{"filter":"check-square","name":"check-square","selector":"fa-check-square"},{"filter":"pencil-square","name":"pencil-square","selector":"fa-pencil-square"},{"filter":"external-link-square","name":"external-link-square","selector":"fa-external-link-square"},{"filter":"share-square","name":"share-square","selector":"fa-share-square"},{"filter":"compass","name":"compass","selector":"fa-compass"},{"filter":"caret-square-o-down","name":"caret-square-o-down","selector":"fa-caret-square-o-down"},{"filter":"caret-square-o-up","name":"caret-square-o-up","selector":"fa-caret-square-o-up"},{"filter":"caret-square-o-right","name":"caret-square-o-right","selector":"fa-caret-square-o-right"},{"filter":"eur","name":"eur","selector":"fa-eur"},{"filter":"gbp","name":"gbp","selector":"fa-gbp"},{"filter":"usd","name":"usd","selector":"fa-usd"},{"filter":"inr","name":"inr","selector":"fa-inr"},{"filter":"jpy","name":"jpy","selector":"fa-jpy"},{"filter":"rub","name":"rub","selector":"fa-rub"},{"filter":"krw","name":"krw","selector":"fa-krw"},{"filter":"btc","name":"btc","selector":"fa-btc"},{"filter":"file","name":"file","selector":"fa-file"},{"filter":"file-text","name":"file-text","selector":"fa-file-text"},{"filter":"sort-alpha-asc","name":"sort-alpha-asc","selector":"fa-sort-alpha-asc"},{"filter":"sort-alpha-desc","name":"sort-alpha-desc","selector":"fa-sort-alpha-desc"},{"filter":"sort-amount-asc","name":"sort-amount-asc","selector":"fa-sort-amount-asc"},{"filter":"sort-amount-desc","name":"sort-amount-desc","selector":"fa-sort-amount-desc"},{"filter":"sort-numeric-asc","name":"sort-numeric-asc","selector":"fa-sort-numeric-asc"},{"filter":"sort-numeric-desc","name":"sort-numeric-desc","selector":"fa-sort-numeric-desc"},{"filter":"thumbs-up","name":"thumbs-up","selector":"fa-thumbs-up"},{"filter":"thumbs-down","name":"thumbs-down","selector":"fa-thumbs-down"},{"filter":"youtube-square","name":"youtube-square","selector":"fa-youtube-square"},{"filter":"youtube","name":"youtube","selector":"fa-youtube"},{"filter":"xing","name":"xing","selector":"fa-xing"},{"filter":"xing-square","name":"xing-square","selector":"fa-xing-square"},{"filter":"youtube-play","name":"youtube-play","selector":"fa-youtube-play"},{"filter":"dropbox","name":"dropbox","selector":"fa-dropbox"},{"filter":"stack-overflow","name":"stack-overflow","selector":"fa-stack-overflow"},{"filter":"instagram","name":"instagram","selector":"fa-instagram"},{"filter":"flickr","name":"flickr","selector":"fa-flickr"},{"filter":"adn","name":"adn","selector":"fa-adn"},{"filter":"bitbucket","name":"bitbucket","selector":"fa-bitbucket"},{"filter":"bitbucket-square","name":"bitbucket-square","selector":"fa-bitbucket-square"},{"filter":"tumblr","name":"tumblr","selector":"fa-tumblr"},{"filter":"tumblr-square","name":"tumblr-square","selector":"fa-tumblr-square"},{"filter":"long-arrow-down","name":"long-arrow-down","selector":"fa-long-arrow-down"},{"filter":"long-arrow-up","name":"long-arrow-up","selector":"fa-long-arrow-up"},{"filter":"long-arrow-left","name":"long-arrow-left","selector":"fa-long-arrow-left"},{"filter":"long-arrow-right","name":"long-arrow-right","selector":"fa-long-arrow-right"},{"filter":"apple","name":"apple","selector":"fa-apple"},{"filter":"windows","name":"windows","selector":"fa-windows"},{"filter":"android","name":"android","selector":"fa-android"},{"filter":"linux","name":"linux","selector":"fa-linux"},{"filter":"dribbble","name":"dribbble","selector":"fa-dribbble"},{"filter":"skype","name":"skype","selector":"fa-skype"},{"filter":"foursquare","name":"foursquare","selector":"fa-foursquare"},{"filter":"trello","name":"trello","selector":"fa-trello"},{"filter":"female","name":"female","selector":"fa-female"},{"filter":"male","name":"male","selector":"fa-male"},{"filter":"gittip","name":"gittip","selector":"fa-gittip"},{"filter":"sun-o","name":"sun-o","selector":"fa-sun-o"},{"filter":"moon-o","name":"moon-o","selector":"fa-moon-o"},{"filter":"archive","name":"archive","selector":"fa-archive"},{"filter":"bug","name":"bug","selector":"fa-bug"},{"filter":"vk","name":"vk","selector":"fa-vk"},{"filter":"weibo","name":"weibo","selector":"fa-weibo"},{"filter":"renren","name":"renren","selector":"fa-renren"},{"filter":"pagelines","name":"pagelines","selector":"fa-pagelines"},{"filter":"stack-exchange","name":"stack-exchange","selector":"fa-stack-exchange"},{"filter":"arrow-circle-o-right","name":"arrow-circle-o-right","selector":"fa-arrow-circle-o-right"},{"filter":"arrow-circle-o-left","name":"arrow-circle-o-left","selector":"fa-arrow-circle-o-left"},{"filter":"caret-square-o-left","name":"caret-square-o-left","selector":"fa-caret-square-o-left"},{"filter":"dot-circle-o","name":"dot-circle-o","selector":"fa-dot-circle-o"},{"filter":"wheelchair","name":"wheelchair","selector":"fa-wheelchair"},{"filter":"vimeo-square","name":"vimeo-square","selector":"fa-vimeo-square"},{"filter":"try","name":"try","selector":"fa-try"},{"filter":"plus-square-o","name":"plus-square-o","selector":"fa-plus-square-o"}]'
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "date": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>" class="form-control input date" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"],'Y-m-d')); endif; ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#tab_<?php echo ($group_k); ?>_date_<?php echo ($tab_k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd',
                        autoclose   : true,
                        minView     : 'month',
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "datetime": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>" class="form-control input time" name="<?php echo ($tab_form["name"]); ?>" value="<?php if(!empty($tab_form["value"])): echo (time_format($tab_form["value"],'Y-m-d H:i:s')); endif; ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <script type="text/javascript">
                $(function(){
                    $('#tab_<?php echo ($group_k); ?>_time_<?php echo ($tab_k); ?>').datetimepicker({
                        format      : 'yyyy-mm-dd hh:ii:ss',
                        autoclose   : true,
                        todayBtn    : 'linked',
                        language    : 'zh-CN',
                        fontAwesome : true
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "picture": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right row">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="col-md-4 file-item thumbnail">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img src="<?php echo (get_cover($tab_form["value"])); ?>" data-id="<?php echo ($tab_form["value"]); ?>">
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="col-md-4 file-item thumbnail hidden">
                            <i class="fa fa-times-circle remove-picture"></i>
                            <img>
                        </div><?php endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传图片</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> img').attr('src', response.url);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-picture', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "pictures": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right row">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list col-xs-12 img-box">
                    <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $images = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $images = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                        <?php if(is_array($images)): foreach($images as $key=>$img): ?><div class="col-md-4 thumbnail">
                                <i class="fa fa-times-circle remove-picture"></i>
                                <img class="img" src="<?php echo (get_cover($img)); ?>" data-id="<?php echo ($img); ?>">
                            </div><?php endforeach; endif; endif; ?>
                </div>
                <div class="btns col-xs-12">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多图</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "image"));?>',    // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<div id="' + file.id + '" class="col-md-3 thumbnail">' +
                                    '<i class="fa fa-times-circle remove-picture"></i>' +
                                    '<img>' +
                                '</div>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                            $( '#'+file.id + ' img').attr('src', response.url);
                            $( '#'+file.id + ' img').attr('data-id', response.id);
                        } else {
                            $.alertMessager('错误：：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除图片
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-picture', function() {
                        var ready_for_remove_id = $(this).closest('.thumbnail').find('img').attr('data-id'); //获取待删除的图片ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_picture_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前图集以逗号分隔的ID并转换成数组
                        current_picture_ids.remove(ready_for_remove_id); //从数组中删除待删除的图片ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_picture_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.thumbnail').remove(); //删除图片预览图
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "file": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($tab_form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($tab_form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "files": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $files = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $files = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "file"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Files',
                            extensions: 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,zip,rar,gz,bz2,7z,ipa,apk,dmg,iso'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "file": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <?php if(!empty($tab_form["value"])): ?><div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>">
                            <ul class="list-group file-box">
                                <?php if(!empty($tab_form["value"])): ?><li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                        <i class="fa fa-file"></i> 
                                        <span><?php echo (get_upload_info($tab_form["value"],'name')); ?></span>
                                        <i class="fa fa-times-circle remove-file"></i>
                                    </li><?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div id="tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>" class="hidden">
                            <ul class="list-group file-box">
                                <li class="list-group-item file-item" data-id="<?php echo ($tab_form["value"]); ?>">
                                    <i class="fa fa-file"></i> 
                                    <span></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li>
                            </ul>
                        </div><?php endif; ?>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',         // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        //fileNumLimit: 1,                                                             // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').removeClass('hidden');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>' ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('upload-state-done');
                        if(eval('response').status == 0){
                            $.alertMessager(response.info);
                        } else {
                            $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).attr('value', response.id);
                            $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?> span').text(response.name);
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>'),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' ).val('') //删除后覆盖原input的值为空
                        $( '#tab_<?php echo ($group_k); ?>_upload_preview_<?php echo ($tab_k); ?>').addClass('hidden');
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "files": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div  id="tab_<?php echo ($group_k); ?>_upload_box_<?php echo ($tab_k); ?>" class="wu-example">
                <!--用来存放文件信息-->
                <div id="tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?>" class="uploader-list">
                    <ul class="list-group file-box">
                        <?php if(!empty($tab_form["value"])): if (is_array($tab_form['value'])) { $files = $tab_form['value']; $input_value = implode(',', $tab_form['value']); } else { $files = explode(',', $tab_form['value']); $input_value = $tab_form['value']; } ?>
                            <?php if(is_array($files)): foreach($files as $key=>$file): ?><li class="list-group-item file-item" data-id="<?php echo ($file); ?>">
                                    <i class="fa fa-file"></i>
                                    <span><?php echo (get_upload_info($file,'name')); ?></span>
                                    <i class="fa fa-times-circle pull-right remove-file"></i>
                                </li><?php endforeach; endif; endif; ?>
                    </ul>
                </div>
                <div class="btns">
                    <input type="hidden" id="tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($input_value); ?>">
                    <div id="tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>" class="btn btn-primary">上传多文件</div>
                    <button id="ctlBtn" class="btn btn-default hidden">开始上传</button>
                    <?php if(!empty($tab_form["tip"])): ?><span class="check-tips text-muted small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    var uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?> = WebUploader.create({
                        auto: true,                                                                    // 选完文件后，是否自动上传
                        duplicate: true,                                                               // 同一文件是否可以重复上传
                        swf: '/Public/libs/cui/swf/uploader.swf',                                               // swf文件路径
                        server: '<?php echo U(MODULE_MARK."/Upload/upload", array("dir" => "media"));?>',     // 文件接收服务端
                        pick: '#tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>',                                   // 选择文件的按钮
                        resize: false,                                                                 // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                        fileNumLimit: 20,                                                              // 验证文件总数量, 超出则不允许加入队列
                        fileSingleSizeLimit:<?php echo C('UPLOAD_FILE_SIZE') ? : 2; ?>*1024*1024,  // 验证单个文件大小是否超出限制, 超出则不允许加入队列
                        // 文件过滤
                        accept: {
                            title: 'Medias',
                            extensions: 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb,mp4'
                        }
                    });

                    // 当有文件添加进来的时候
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'fileQueued', function( file ) {
                        var $li = $(
                                '<li id="' + file.id + '" class="list-group-item file-item">' +
                                    '<i class="fa fa-file"></i>' +
                                    '<span>' + file.name + '</span>' +
                                    '<i class="fa fa-times-circle pull-right remove-file"></i>' +
                                '</li>'
                                );

                        // $list为容器jQuery实例
                        $('#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> ul.list-group').append( $li );
                    });

                    // 文件上传过程中创建进度条实时显示。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress"><div class="progress-bar"></div></div>')
                                    .appendTo( $li )
                                    .find('.progress-bar');
                        }
                        $percent.css( 'width', percentage * 100 + '%' );
                    });

                    // 完成上传完了，成功或者失败，先删除进度条。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadComplete', function( file ) {
                        $( '#'+file.id ).find('.progress').remove();
                    });

                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadSuccess', function( file , response) {
                        $( '#'+file.id ).addClass('upload-state-done');
                        if(response.status == 1){
                            $( '#'+file.id ).attr('data-id', response.id);
                            var input = $( '#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>' );
                            if (input.val()) {
                                input.val(input.val() + ',' + response.id);
                            } else {
                                input.val(response.id);
                            }
                        } else {
                            $.alertMessager('错误：' + response.info);
                            $( '#'+file.id ).remove();
                        }
                    });

                    // 文件上传失败，显示上传出错。
                    uploader_tab_<?php echo ($group_k); ?>_upload_<?php echo ($tab_k); ?>.on( 'uploadError', function( file ) {
                        $.alertMessager('error');
                        var $li = $( '#'+file.id ),
                            $error = $li.find('div.error');
                        // 避免重复创建
                        if ( !$error.length ) {
                            $error = $('<div class="error"></div>').appendTo( $li );
                        }
                        $error.text('上传失败');
                    });

                    // 删除文件
                    $(document).on('click', '#tab_<?php echo ($group_k); ?>_upload_list_<?php echo ($tab_k); ?> .remove-file', function() {
                        var ready_for_remove_id = $(this).closest('.file-item').attr('data-id'); //获取待删除的文件ID
                        if (!ready_for_remove_id) {
                            $.alertMessager('错误', 'danger');
                        }
                        var current_file_ids = $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val().split(","); //获取当前文件列表以逗号分隔的ID并转换成数组
                        current_file_ids.remove(ready_for_remove_id); //从数组中删除待删除的文件ID
                        $('#tab_<?php echo ($group_k); ?>_upload_input_<?php echo ($tab_k); ?>').val(current_file_ids.join(',')) //删除后覆盖原input的值
                        $(this).closest('.file-item').remove(); //删除文件预览
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "kindeditor": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <textarea name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>" class="form-control" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <?php echo ($tab_form["value"]); ?>
            </textarea>
            <script type="text/javascript" src="/Public/libs/kindeditor/kindeditor-min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    KindEditor.ready(function(K) {
                        kindeditor_<?php echo ($tab_k); ?> = K.create('#tab_<?php echo ($group_k); ?>_kindeditor_<?php echo ($tab_k); ?>', {
                            allowFileManager : true,
                            filePostName : 'file',
                            cssPath : [
                                '/Public/libs/cui/css/cui.min.css',
                                '/Public/libs/kindeditor/plugins/code/prettify.css'
                            ],
                            width : '100%',
                            height : '500px',
                            resizeType: 1,
                            pasteType : 2,
                            filterMode: <?php if(MODULE_MARK === 'Admin') {echo 'false';} else {echo 'true';} ?>,
                            urlType : "",
                            fileManagerJson : '<?php echo U(MODULE_MARK."/Upload/fileManager");?>',
                            uploadJson : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            extraFileUploadParams: {
                                session_id : '<?php echo session_id();?>'
                            },
                            afterBlur: function(){this.sync();}
                        });
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "editormd": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <div name="<?php echo ($tab_form["name"]); ?>" id="tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>" style="z-index: 1000;" class="form-control" <?php echo ($tab_form["extra"]["attr"]); ?>></div>
            <pre id="default_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>" class="hidden"><?php echo ($tab_form["value"]); ?></pre>

            <link rel="stylesheet" type="text/css" href="/Public/libs/editormd/css/editormd.min.css">
            <script type="text/javascript" src="/Public/libs/editormd/js/editormd.min.js"></script>

            <script type="text/javascript">
                $(function(){
                var editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>_content = $('#default_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>').text();
                    var editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?> = editormd({
                            id              : 'tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>',
                            path            : '/Public/libs/editormd/lib/',
                            pluginPath      : '/Public/libs/editormd/plugins/',
                            name            : '<?php echo ($tab_form["name"]); ?>',
                            markdown        : editormd_tab_<?php echo ($group_k); ?>_markdown_<?php echo ($tab_k); ?>_content,
                            imageUpload     : true,
                            imageFormats    : ["jpg", "jpeg", "gif", "png", "bmp"],
                            imageUploadURL  : '<?php echo U(MODULE_MARK."/Upload/upload");?>',
                            placeholder     : 'CoreThink让开发更轻松！',
                            width           : '100%',
                            height          : 640,
                            watch           : <?php if(MODULE_MARK === 'Admin'){ echo 'false';} else {echo 'true';} ?>,
                            codeFold        : true,
                            htmlDecode      : false,
                            toolbarAutoFixed: false,
                        });
                });
            </script>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "tags": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="text" id="tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>" class="form-control" name="<?php echo ($tab_form["name"]); ?>" value="<?php echo ($tab_form["value"]); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input.css">
            <link rel="stylesheet" type="text/css" href="/Public/libs/jquery_tokeninput/css/token-input-bootstrap.css">
            <script type="text/javascript" src="/Public/libs/jquery_tokeninput/js/jquery.tokeninput.min.js" charset="utf-8"></script>
            <script type="text/javascript">
                $(function(){
                    //标签自动完成
                    var tags = $('#tab_<?php echo ($group_k); ?>_tag_<?php echo ($tab_k); ?>'), tagsPre = [];
                    if (tags.length > 0) {
                        var items = tags.val().split(','), result = [];
                        for (var i = 0; i < items.length; i ++) {
                            var tag = items[i];
                            if (!tag) {
                                continue;
                            }
                            tagsPre.push({
                                id      :   tag,
                                title   :   tag
                            });
                        }
                    }
                    tags.tokenInput("<?php echo U(MODULE_NAME.'/Tag/search'); ?>",{
                        propertyToSearch    :   'title',
                        tokenValue          :   'title',
                        searchDelay         :   0,
                        tokenLimit          :   10,
                        preventDuplicates   :   true,
                        animateDropdown     :   true,
                        allowFreeTagging    :   true,
                        hintText            :   '请输入标签名',
                        noResultsText       :   '此标签不存在, 按回车创建',
                        searchingText       :   "查找中...",
                        prePopulate         :   tagsPre,
                        theme               :   'bootstrap',
                        onAdd: function (item){ //新增系统没有的标签时提交到数据库
                            $.post("<?php echo U(MODULE_NAME.'/Tag/add'); ?>", {'title': item.title});
                        }
                    });
                });
            </script>
        </div>
    </div><?php break;?>

                                                                
                                                                <?php case "board": ?><div class="form-group item_<?php echo ($tab_form["name"]); ?> <?php echo ($tab_form["extra"]["class"]); ?>">
        <label class="left control-label"><?php echo ($tab_form["title"]); ?>：</label>
        <div class="right">
            <input type="hidden" name="<?php echo ($tab_form["name"]); ?>" value='<?php echo ($tab_form["value"]); ?>'>
            <div class="row board_list boards_<?php echo ($tab_k); ?>" <?php echo ($tab_form["extra"]["attr"]); ?>>
                <div class="container-fluid">
                    <?php if(is_array($form["options"])): foreach($form["options"] as $option_key=>$option): ?><div class="panel panel-default board col-xs-12 col-sm-3" data-id="<?php echo ($option_key); ?>">
                            <div class="panel-heading">
                                <strong><?php echo ($option["title"]); ?></strong>
                            </div>
                            <div class="list-group dragsort_<?php echo ($tab_k); ?>" data-group="<?php echo ($option_key); ?>">
                                <?php if(is_array($option["field"])): foreach($option["field"] as $option_field_key=>$option_field): ?><div class="list-group-item">
                                        <em data="<?php echo ($field['id']); ?>"><?php echo ($option_field); ?></em>
                                        <input type="hidden" name="<?php echo ($tab_form["name"]); ?>[<?php echo ($option_key); ?>][]" value="<?php echo ($option_field_key); ?>"/>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div><?php endforeach; endif; ?>
                </div>
            </div>
            <script type="text/javascript">
                //拖曳插件初始化
                $(function(){
                    $(".dragsort_<?php echo ($tab_k); ?>").dragsort({
                         dragSelector:'div',
                         placeHolderTemplate: '<div class="clearfix draging-place">&nbsp;</div>',
                         dragBetween:true, //允许拖动到任意地方
                         dragEnd:function(){
                             var self = $(this);
                             self.find('input').attr('name', '<?php echo ($tab_form["name"]); ?>[' + self.closest('.dragsort_<?php echo ($tab_k); ?>').data('group') + '][]');
                         }
                     });
                });
            </script>
            <?php if(!empty($tab_form["tip"])): ?><span class="check-tips small"><?php echo ($tab_form["tip"]); ?></span><?php endif; ?>
        </div>
    </div><?php break;?>

                                                                // 扩展类型
                                                                <?php default: ?>
                                                                <?php echo hook('FormBuilderExtend', array('form' => $tab_form, 'type' => tab_)); endswitch; endforeach; endif; else: echo "" ;endif; ?>
                                                    </div>
                                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group"><hr></div><?php break;?>

                                // 扩展类型
                                <?php default: ?>
                                <?php echo hook('FormBuilderExtend', array('form' => $form)); endswitch; endforeach; endif; else: echo "" ;endif; ?>
                        <?php if(empty($form_items)): ?><div class="builder-data-empty text-center">
                                <div class="empty-info">
                                    <i class="fa fa-database"></i> 暂时没有数据<br>
                                    <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                                </div>
                            </div><?php endif; ?>
                        <div class="form-group"></div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block submit <?php if($ajax_submit) echo 'ajax-post';?> visible-xs visible-sm" type="submit" target-form="form-builder">确定</button>
                            <button class="btn btn-primary submit <?php if($ajax_submit) echo 'ajax-post';?> visible-md-inline visible-lg-inline" type="submit" target-form="form-builder">确定</button>
                            <button class="btn btn-default return visible-md-inline visible-lg-inline" onclick="javascript:history.back(-1);return false;">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php echo ($extra_html); ?>
</div>


            <?php endif; ?>
        
    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <input type="hidden" id="corethink_home_img" value="/./Application/Home/Template/Public/images">
            <script type="text/javascript" src="/Public/libs/cui/js/cui.min.js"></script>
            <script type="text/javascript">
                (function(){
                    var OpenCMF = window.OpenCMF = {
                        "ROOT"   : "", //当前网站地址
                        "APP"    : "/admin.php?s=", //当前项目地址
                        "PUBLIC" : "/Public", //项目公共目录地址
                        "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
                        "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
                        "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
                    }
                })();
            </script>
            <script type="text/javascript" src="/./Application/Admin/View/Public/js/admin.js"></script>
            <script type="text/javascript">
                // 如果是多标签方式自动跳转后台首页
                var admin_tabs = '<?php echo ($_admin_tabs); ?>';
                if(admin_tabs == '1' && !(self.frameElement != null && (self.frameElement.tagName == "IFRAME" || self.frameElement.tagName == "iframe"))){
                    parent.parent.location = "<?php echo U('Admin/Index/index');?>";
                }
            </script>
            
    <script type="text/javascript" src="/Public/libs/cui/js/cui.extend.min.js"></script>
    <script type="text/javascript">
    $(function() {
        //给数组增加查找指定的元素索引方法
        Array.prototype.indexOf = function(val) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == val) return i;
            }
            return -1;
        };

        //给数组增加删除方法
        Array.prototype.remove = function(val) {
            var index = this.indexOf(val);
            if (index > -1) {
                this.splice(index, 1);
            }
        };
    });
</script>


        </div>
    </div>
</body>
</html>