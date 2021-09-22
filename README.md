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
