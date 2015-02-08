id: 12
name: CopyrightYear
properties: null

-----

$startjahr = !empty($start) ? $start : strftime("%Y");
$heute = strftime("%Y");

if ($startjahr == $heute) {
  $jahrangabe = $heute;
} else {
  $jahrangabe = $startjahr.' - '.$heute;
}

return $jahrangabe;