<?php

/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

/**
 * generate Random string
 * @param integer $length
 * @return string
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * display and die
 * @param [var or object or array] $var
 */
function dd($var)
{
    var_dump($var);
    die();
}

/**
 * view array content
 *
 * @param [array] $var
 * @return void
 */
function pr($var)
{
    echo "<pre class='text-left ltr'>";
    print_r($var);
    echo "</pre>";
}
/**
 * check if variable exist and not empty
 *
 * @param $var
 * @return bool
 */
function exist($var)
{
    if (isset($var)) {
        if (!empty($var)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
/**
 * Sending SMS message
 *
 * @param [type] $username
 * @param [type] $password
 * @param [type] $messageContent
 * @param [type] $mobileNumber
 * @param [type] $sendername
 * @param [type] $server
 * @param string $return
 * @return void
 */
function sendSMS($username, $password, $messageContent, $mobileNumber, $sendername, $server, $return = 'json')
{
    // built url
    $post = 'username=' . urlencode($username) . '&password=' . urlencode($password) . '&numbers=' . urlencode($mobileNumber)
        . '&message=' . urlencode($messageContent) . '&sender=' . urlencode($sendername) . '&unicode=E&return=' . urlencode($return);
    //open connection
    $ch = curl_init();
    // API URL     
    curl_setopt($ch, CURLOPT_URL, $server);
    //Sending through $_POST request    
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // excution    
    $respond = curl_exec($ch);
    // close connection    
    curl_close($ch);
    //using the return as a PHP array
    return json_decode($respond);
}

/**
 * repeat string using seprator with incrising value
 *
 * @param string $var
 * @param integer $count
 * @param string $seprator
 * @return string
 */
function strIncRepeat($var, $count, $seprator = ',')
{
    $text = '';
    for ($i = 0; $i < $count; $i++) {
        $text .= $var . $i . $seprator;
    }
    return rtrim($text, ',');
}

/**
 * print variable if exist
 *
 * @param string $var
 * @return void
 */
function printIsset($var)
{
    if (isset($var)) {
        echo $var;
    } else {
        return false;
    }
}

/**
 * print variable if exist
 *
 * @param string $var
 * @return void
 */
function returnIsset($var)
{
    if (isset($var)) {
        return $var;
    } else {
        return false;
    }
}
/**
 * clean Search Var
 *
 * @param string $var
 * @return string
 */
function cleanSearchVar($var)
{
    if (isset($_SESSION['search']['bind'][":$var"])) {
        return str_replace('%', '', $_SESSION['search']['bind'][":$var"]);
    }
}

function arrayLines($array)
{
    $string = '';
    foreach ($array as $key => $value) {
        $string .= "<p> $key :  $value </p>";
    }
    return $string;
}
/**
 * nationailties list
 *
 * @return array
 */
function nationality()
{
    return [
        "Afghan", "Albanian", "Algerian", "Argentine", "Argentinian", "Australian", "Austrian", "Bangladeshi", "Belgian", "Bolivian", "Batswana", "Brazilian",
        "Bulgarian", "Cambodian", "Cameroonian", "Canadian", "Chilean", "Chinese", "Colombian", "CostaRican", "Croatian", "Cuban", "Czech", "Danish", "Dominican",
        "Ecuadorian", "Egyptian", "Salvadorian", "English", "Estonian", "Ethiopian", "Fijian", "Finnish", "French", "German", "Ghanaian", "Greek", "Guatemalan",
        "Haitian", "Honduran", "Hungarian", "Icelandic", "Indian", "Indonesian", "Iranian", "Iraqi", "Irish", "Israeli", "Italian", "Jamaican", "Japanese",
        "Jordanian", "Kenyan", "Kuwaiti", "Lao", "Latvian", "Lebanese", "Libyan", "Lithuanian", "Malagasy", "Malaysian", "Malian", "Maltese", "Mexican", "Mongolian",
        "Moroccan", "Mozambican", "Namibian", "Nepalese", "Dutch", "NewZealand", "Nicaraguan", "Nigerian", "Norwegian", "Pakistani", "Panamanian", "Paraguayan",
        "Peruvian", "Philippine", "Polish", "Portuguese", "Romanian", "Russian", "Saudi", "Scottish", "Senegalese", "Serbian", "Singaporean", "Slovak", "SouthAfrican",
        "Korean", "Spanish", "SriLankan", "Sudanese", "Swedish", "Swiss", "Syrian", "Taiwanese", "Tajikistani", "Thai", "Tongan", "Tunisian", "Turkish", "Ukrainian",
        "Emirati", "British", "American", "Uruguayan", "Venezuelan", "Vietnamese", "Welsh", "Zambian", "Zimbabwean"

    ];
}
