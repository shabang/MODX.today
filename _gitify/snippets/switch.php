id: 34
name: switch
description: 'Simple switch snippet'
category: Switch
properties: 'a:0:{}'

-----

/*
  * Switch
  *
  * Created by Uroš Likar
  * uros.likar@gmail.com
  * http://uros.likar.si
  *
  */
  
  if(empty($default)) $default = '';  
  $i = 1;  
  while(isset(${'c'.$i})){
    $case[$i] = trim(${'c'.$i});
    $do[$i] = trim(${'do'.$i});
    $i++;  
  }
  
  $key = array_search(trim($get),$case); 
  if(!empty($key)) $output = $do[$key]; else $output = $default;
    
  return $output;