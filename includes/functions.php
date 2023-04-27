
<?php

function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
  $errors=array();
}

function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." can't be blank.";
      return $errors;
    }
  }
}

function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}

function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}



function read_date($str){
     if($str)
      return date('F j, Y, g:i:s a', strtotime($str));
     else
      return null;
  }

function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}

function count_id(){
  static $count = 1;
  return $count++;
}

function verifyUserDetails($id, $name, $email, $phone) {
    
    
    $errors = array();
    // Verify ID length
    if (strlen($id) !== 8) {
      $errors['std_id'] = 'Student id should be of length 8';
    }
    
    // Verify name contains only alphabets
    if (!ctype_alpha($name)) {
      $errors['name'] = 'Name should contain only alphabets';
    }
    
    // Verify phone number length and only contains numbers
    if (strlen($phone) !== 10 || !ctype_digit($phone)) {
      $errors['phone'] = 'Phone number should be of length 10';
       
    }
    
    // Verify email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !strpos($email, "@gmail.com")) {
      $errors['email'] = 'Please enter valid email address';
    }
    
    return $errors;
}




?>
