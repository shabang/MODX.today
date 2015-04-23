id: 41
source: 1
name: getTime
properties: 'a:0:{}'

-----

$ts = !empty($input) ? strtotime($input) : time();
return (string) $ts;