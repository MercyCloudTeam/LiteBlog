~~~

location = / {
    try_files /page-cache/pc__index__pc.html /index.php?$query_string;
}

location / {
    try_files $uri $uri/ /page-cache/$uri.html /page-cache/$uri.json /page-cache/$uri.xml /index.php?$query_string;
}

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

一个轻博客

没有管理页面，用户系统，只有使用Token认证的API

没有任何插件系统 模板系统（功能简陋）


每个站点会维护一份其他站点的列表

特点

支持 Markdown

支持 Cloudflare

API操作

站点之间自动同步

生成静态文件

SEO友好

支持分类、文章TAG
