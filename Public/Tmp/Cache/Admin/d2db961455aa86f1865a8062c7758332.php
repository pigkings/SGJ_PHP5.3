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
                                
    <div class="builder listbuilder-box panel-body">
    <!-- Tab导航 -->
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group"></div><?php endif; ?>

    <!-- 顶部工具栏按钮 -->
    <?php if(!empty($top_button_list)): ?><div class="builder-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <?php if(!empty($top_button_list)): ?><div class="col-xs-12 col-sm-9 button-list clearfix">
                        <div class="form-group">
                            <?php if(is_array($top_button_list)): $i = 0; $__LIST__ = $top_button_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$button): $mod = ($i % 2 );++$i;?><a <?php echo ($button["attribute"]); ?>><?php echo ($button["title"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div><?php endif; ?>

                <!-- 搜索框 -->
                <?php if(!empty($search)): ?><div class="col-xs-12 col-sm-3 clearfix">
                        <form class="form" method="get" action="<?php echo ($search["url"]); ?>">
                            <div class="form-group">
                                <div class="input-group search-form">
                                    <input type="text" name="keyword" class="search-input form-control" value="<?php echo ($_GET["keyword"]); ?>" placeholder="<?php echo ($search["title"]); ?>">
                                    <span class="input-group-btn"><a class="btn btn-default search-btn"><i class="fa fa-search"></i></a></span>
                                </div>
                            </div>
                        </form>
                    </div><?php endif; ?>
            </div>
        </div><?php endif; ?>

    <!-- 数据列表 -->
    <div class="builder-container">
        <div class="row">
            <div class="col-xs-12">
                <div class="builder-table">
                    <div class="panel panel-default table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><input class="check-all" type="checkbox"></th>
                                    <?php if(is_array($table_column_list)): $i = 0; $__LIST__ = $table_column_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$column): $mod = ($i % 2 );++$i;?><th><?php echo (htmlspecialchars($column["title"])); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($table_data_list)): $i = 0; $__LIST__ = $table_data_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td>
                                            <input class="ids" type="checkbox" value="<?php echo ($data[$table_data_list_key]); ?>" name="ids[]">
                                        </td>
                                        <?php foreach ($table_column_list as $column) :?>
                                            <td>
                                                <?php if ($column['name'] === 'right_button') : ?>
                                                    <?php foreach ($data['right_button'] as $rb) : ?>
                                                        <a <?php echo ($rb['attribute']); ?>><?php echo ($rb['title']); ?></a>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php echo ($data[$column['name']]); ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                <?php if(empty($table_data_list)): ?><tr class="builder-data-empty">
                                        <?php $tdcolspan = count($table_column_list)+1 ?>
                                        <td class="text-center empty-info" colspan="<?php echo ($tdcolspan); ?>">
                                            <i class="fa fa-database"></i> 暂时没有数据<br>
                                            <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                                        </td>
                                    </tr><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(!empty($table_data_page)): ?><ul class="pagination"><?php echo ($table_data_page); ?></ul><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 额外功能代码 -->
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
                
    <div class="builder listbuilder-box panel-body">
    <!-- Tab导航 -->
    <?php if(!empty($tab_nav)): ?><div class="builder-tabs">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <?php if(is_array($tab_nav["tab_list"])): $i = 0; $__LIST__ = $tab_nav["tab_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li class="<?php if($tab_nav['current_tab'] == $key) echo 'active'; ?>"><a href="<?php echo ($tab["href"]); ?>"><?php echo ($tab["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group"></div><?php endif; ?>

    <!-- 顶部工具栏按钮 -->
    <?php if(!empty($top_button_list)): ?><div class="builder-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <?php if(!empty($top_button_list)): ?><div class="col-xs-12 col-sm-9 button-list clearfix">
                        <div class="form-group">
                            <?php if(is_array($top_button_list)): $i = 0; $__LIST__ = $top_button_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$button): $mod = ($i % 2 );++$i;?><a <?php echo ($button["attribute"]); ?>><?php echo ($button["title"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div><?php endif; ?>

                <!-- 搜索框 -->
                <?php if(!empty($search)): ?><div class="col-xs-12 col-sm-3 clearfix">
                        <form class="form" method="get" action="<?php echo ($search["url"]); ?>">
                            <div class="form-group">
                                <div class="input-group search-form">
                                    <input type="text" name="keyword" class="search-input form-control" value="<?php echo ($_GET["keyword"]); ?>" placeholder="<?php echo ($search["title"]); ?>">
                                    <span class="input-group-btn"><a class="btn btn-default search-btn"><i class="fa fa-search"></i></a></span>
                                </div>
                            </div>
                        </form>
                    </div><?php endif; ?>
            </div>
        </div><?php endif; ?>

    <!-- 数据列表 -->
    <div class="builder-container">
        <div class="row">
            <div class="col-xs-12">
                <div class="builder-table">
                    <div class="panel panel-default table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><input class="check-all" type="checkbox"></th>
                                    <?php if(is_array($table_column_list)): $i = 0; $__LIST__ = $table_column_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$column): $mod = ($i % 2 );++$i;?><th><?php echo (htmlspecialchars($column["title"])); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($table_data_list)): $i = 0; $__LIST__ = $table_data_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td>
                                            <input class="ids" type="checkbox" value="<?php echo ($data[$table_data_list_key]); ?>" name="ids[]">
                                        </td>
                                        <?php foreach ($table_column_list as $column) :?>
                                            <td>
                                                <?php if ($column['name'] === 'right_button') : ?>
                                                    <?php foreach ($data['right_button'] as $rb) : ?>
                                                        <a <?php echo ($rb['attribute']); ?>><?php echo ($rb['title']); ?></a>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php echo ($data[$column['name']]); ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                <?php if(empty($table_data_list)): ?><tr class="builder-data-empty">
                                        <?php $tdcolspan = count($table_column_list)+1 ?>
                                        <td class="text-center empty-info" colspan="<?php echo ($tdcolspan); ?>">
                                            <i class="fa fa-database"></i> 暂时没有数据<br>
                                            <span class="small">本系统由 <a href="<?php echo C('WEBSITE_DOMAIN');?>" class="text-muted" target="_blank"><?php echo C('PRODUCT_NAME');?></a> v<?php echo C('CURRENT_VERSION');?> 强力驱动</span>
                                        </td>
                                    </tr><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(!empty($table_data_page)): ?><ul class="pagination"><?php echo ($table_data_page); ?></ul><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 额外功能代码 -->
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