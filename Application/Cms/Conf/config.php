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
    'URL_MAP_RULES'     => array(
    ),
    'URL_ROUTE_RULES'   => array(
        'list/:cid\d'  => 'index/lists',
        ':id\d'        => 'index/detail',
        'cate/:id\d'   => 'category/detail',
    ),
);
