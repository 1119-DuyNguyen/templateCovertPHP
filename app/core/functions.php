<?php
# những function dùng xuyên suốt app coi như library , tái chế
# namespace = class toàn statics function :)))
namespace myFuncs;

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
/**
 * hash number to random string
 * @param int $number
 * @return string
 */
function hashNumber(int $number)
{
    //id-random-random
    $randomNum = rand(100, 999);

    $randomStr = get_random_string_max(5);
    $hash = strval($number + $randomNum) . '-' . strval($randomNum) . '-' . $randomStr;
    return $hash;
}
/**
 * unhash number of myFuncs\hashNumber
 * @param string $params
 * @return int|null
 */
function unHashNumber(string $params)
{

    if (!$params)
        $params = "";

    $array = explode('-', $params, 2);
    if (is_array($array) && count($array) == 2) {
        $number = intval($array[0]);
        $randomNumber = intval($array[1]);

        return $number - $randomNumber;
    }
    //id-random-random
    return null;

}
function get_random_string_max($length)
{

    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $text = "";

    $length = rand(4, $length);

    for ($i = 0; $i < $length; $i++) {

        $random = rand(0, 61);

        $text .= $array[$random];
    }

    return $text;
}

function check_message()
{

    if (isset($_SESSION['error']) && $_SESSION['error'] !== "") {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

/*  multiple file sẽ có dạng
Array
(
[name] => Array
(
[0] => foo.txt
[1] => bar.txt
)
[type] => Array
(
[0] => text/plain
[1] => text/plain
)
[tmp_name] => Array
(
[0] => /tmp/phpYzdqkD
[1] => /tmp/phpeEwEWG
)
[error] => Array
(
[0] => 0
[1] => 0
)
[size] => Array
(
[0] => 123
[1] => 456
)
)
* còn convert lại cho dễ nhìn
Array
(
[0] => Array
(
[name] => foo.txt
[type] => text/plain
[tmp_name] => /tmp/phpYzdqkD
[error] => 0
[size] => 123
)
[1] => Array 
(
[name] => bar.txt
[type] => text/plain
[tmp_name] => /tmp/phpeEwEWG
[error] => 0
[size] => 456
)
)
*/
function reArrayFiles(&$file_post)
{

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}