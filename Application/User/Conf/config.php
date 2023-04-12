<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
return array(
    // 路由配置
    'URL_ROUTER_ON'     => true,
    'GUESS_TIXIAN_LIMIT' =>100,
    'URL_MAP_RULES'     => array(
    ),
    'URL_ROUTE_RULES'   => array(
        ':uid\d'         => 'index/home',
    ),
    'DEFAULT_V_LAYER'=>'Template',
);
