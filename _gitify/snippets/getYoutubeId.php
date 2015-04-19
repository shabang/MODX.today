id: 36
name: getYoutubeId
properties: null

-----

preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $input, $matches);

return (!empty($matches)) ? $matches[1] : ' ';