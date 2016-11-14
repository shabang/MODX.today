id: 31
name: PoweredBy
properties: 'a:0:{}'
disabled: 1

-----

if (!headers_sent()) {
    header('X-Powered-By: MODX Revolution');
}