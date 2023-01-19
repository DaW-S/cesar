<?php

$data_json = file_get_contents('data.json');
$decoded_json = json_decode($data_json, false);
$input_encrypt = $decoded_json->input_encrypt;
$add_encrypt = $decoded_json->add_encrypt;
$input_decrypt = $decoded_json->input_decrypt;
$add_decrypt = $decoded_json->add_decrypt;

function caesarEncrypter (string $input, int $add) {

  if ($add > 26) {
    $add = $add % 26;
  }

  //check forbidden symbols
  if (preg_replace('/[^a-zA-Z]+/', '_', $input)) { 
    $strToArr = str_split(strtolower($input));
    $nextChar = [];

    foreach ($strToArr as $char) {
      //ascii number
      $ascii = ord($char);

      if ($ascii == 32 ) {
        $nextChar[] = ' ';
        continue;
      }
      if (($ascii + $add) > 122) {
        $nextChar[] = chr($ascii + $add - 26);
      }
      else {
      $nextChar[] = chr(ord($char) + $add);
      
      }
    }

    echo implode($nextChar);
  }

  else {
    echo 'Please inser text without symbols.';
  }
  
}

function caesarDecrypter (string $input, int $add) {

  if ($add > 26) {
    $add = $add % 26;
  }

  //check forbidden symbols
  if (preg_replace('/[^a-zA-Z]+/', '_', $input)) { 
    $strToArr = str_split(strtolower($input));
    $nextChar = [];

    foreach ($strToArr as $char) {
      //ascii number
      $ascii = ord($char);

      if ($ascii == 32 ) {
        $nextChar[] = ' ';
        continue;
      }
      if (($ascii - $add) < 97) {
        $nextChar[] = chr($ascii - $add + 26);
      }
      else {
      $nextChar[] = chr(ord($char) - $add);
      
      }
    }

    echo implode($nextChar);
  }

  else {
    echo 'Please inser text without symbols.';
  }
  
}

caesarEncrypter($input_encrypt, $add_encrypt);
echo '<br>';
caesarDecrypter($input_decrypt, $add_decrypt);