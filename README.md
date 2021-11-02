# LiteBlog



### 简介

一个轻博客

**没有**管理页面，用户系统，只有使用Token认证的API

**没有**任何插件系统 模板系统（**功能简陋**）


每个站点会维护一份其他站点的列表 TODO

### 特点

支持 Markdown

API操作

站点之间自动同步 *TODO*

生成静态文件

SEO友好

支持分类、文章TAG  *TODO*


地区区分 *TODO*

使用geoip判断 ，中国地区IP不显示及提供评论系统 *TODO*



### 文章操作方法

Token令牌API操作

本地Markdown文件导入  *TODO*



### 伪静态

~~~
#NGINX 伪静态

location = / {
    try_files /page-cache/pc__index__pc.html /index.php?$query_string;
}

location / {
    try_files $uri $uri/ /page-cache/$uri.html /page-cache/$uri.json /page-cache/$uri.xml /index.php?$query_string;
}

#Apache 伪静态

# Serve Cached Page If Available...
RewriteCond %{REQUEST_URI} ^/?$
RewriteCond %{DOCUMENT_ROOT}/page-cache/pc__index__pc.html -f
RewriteRule .? page-cache/pc__index__pc.html [L]
RewriteCond %{DOCUMENT_ROOT}/page-cache%{REQUEST_URI}.html -f
RewriteRule . page-cache%{REQUEST_URI}.html [L]
RewriteCond %{DOCUMENT_ROOT}/page-cache%{REQUEST_URI}.json -f
RewriteRule . page-cache%{REQUEST_URI}.json [L]
RewriteCond %{DOCUMENT_ROOT}/page-cache%{REQUEST_URI}.xml -f
RewriteRule . page-cache%{REQUEST_URI}.xml [L]

~~~



### 感谢

erusev/parsedown

genealabs/laravel-model-caching

geoip2/geoip2

laravel/lumen-framework

laravolt/avatar

league/html-to-markdown

silber/page-cache

Tailwind CSS

daisyUI

