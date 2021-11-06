<?php

return [
    'beian'=>env('LITEBLOG_BEIAN'),//ICP备案号
    'wa'=>env('LITEBLOG_WA'),//网安备案号
    'wa_url'=>env('LITEBLOG_WA_URL'),//网安备案号
    'ip_check'=>env('LITEBLOG_IP_CHECK',true),//GEOIP检测地区
    'ip_info_display'=>env('LITEBLOG_IP_INFO_DISPLAY',false),//是否显示IP信息给用户看
    'ip_mmdb_file'=>env('LITEBLOG_IP_MMDB_FILE',storage_path('app/ip.db')),

    'china_comment'=>env('LITEBLOG_CHINA_COMMENT',true),//中国地区屏蔽评论系统

    'comment'=>env('LITEBLOG_COMMENT',true),//评论系统
    'copyright'=>env('LITEBLOG_COPYRIGHT',env('APP_NAME')),//底部版权标识(可与APP NAME不同 默认APP_NAME)
    'power_by'=>env('LITEBLOG_POWER_BY',true),//开源项目链接

    'cn_user_use_mirror'=>env('LITEBLOG_CN_USER_USE_MIRROR'),//为中国用户引入前端资源时自动使用国内镜像

    'index_title'=>env('LITEBLOG_INDEX_TITLE',env('APP_NAME')),//网站首页标题
    'index_subtitle'=>env('LITEBLOG_INDEX_SUBTITLE'),//网站首页描述
    'index_description'=>env('LITEBLOG_INDEX_DESCRIPTION'),//网站首页描述

    'index_seo_title'=>env('LITEBLOG_INDEX_SEO_TITLE',env('LITEBLOG_INDEX_TITLE')),//网站首页标题
    'index_seo_description'=>env('LITEBLOG_INDEX_SEO_DESCRIPTION',env('LITEBLOG_INDEX_SUBTITLE')),//网站首页副标题 SEO
    'index_seo_keywords'=>env('LITEBLOG_INDEX_SEO_KEYWORDS'),//网站首页关键词

    'img_mirror'=>env('LITEBLOG_IMG_MIRROR'),//使用镜像节点加载图片（指替换图片URL）
    'img_sync'=>env('LITEBLOG_IMG_SYNC'),// 是否同步图片到本地 !!!
    'url_shore_replace'=>env('LITEBLOG_URL_SHORE_REPLACE'),//本地短连接替换

//    AD配置
    'google_ad'=>env('LITEBLOG_GOOGLE_AD'),

    'ad_posts_head_img'=>env('LITEBLOG_AD_POSTS_HEAD_IMG'),//文章顶部
    'ad_posts_end_img'=>env('LITEBLOG_AD_POSTS_END_IMG'),//文章底部
    'ad_posts_left_img'=>env('LITEBLOG_AD_POSTS_LEFT_IMG'),//左侧菜单栏

    'ad_index_right_img'=>env('LITEBLOG_AD_INDEX_RIGHT_IMG'),

    //首页文章广告
    'ad_index_posts_img'=>env('LITEBLOG_AD_INDEX_POSTS_IMG'),
    'ad_index_posts_title'=>env('LITEBLOG_AD_INDEX_POSTS_TITLE'),
    'ad_index_posts_desc'=>env('LITEBLOG_AD_INDEX_POSTS_DESC'),

    //节点管理
    'node_county'=>env('LITEBLOG_NODE_COUNTY'),

    //Theme Configure
    'theme_nav_bg_color'=>env('THEME_NAV_BG_COLOR','bg-blue-800'),//网站首页关键词

];
