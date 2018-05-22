<?php
include("global.inc.php");
$errors=0;
$error="
The following terrestrial errors occurred while processing your form input.<ul>";
pt_register('POST','name');
pt_register('POST','email');
pt_register('POST','phone');
pt_register('POST','preference');
pt_register('POST','comments');
$comments=preg_replace("/(\015\012)|(\015)|(\012)/","&nbsp;<br />", $comments);if($name=="" || $email=="" || $comments=="" ){
$errors=1;
$error.="You did not enter one or more of the required fields. Please go back and try again, human.";
}
if(!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" ."@"."([a-z0-9]+([\.-][a-z0-9]+)*)+"."\\.[a-z]{2,}"."$",$email)){
$error.="<li>Invalid email address entered</li>";
$errors=1;
}
if($errors==1) echo $error;
else{
$where_form_is="http".($HTTP_SERVER_VARS["HTTPS"]=="on"?"s":"")."://".$SERVER_NAME.strrev(strstr(strrev($PHP_SELF),"/"));
$message="Name: ".$name."
E-mail: ".$email."
Phone: ".$phone."
Contact Preference: ".$preference."
Questions/Comments: ".$comments."
";
$message = stripslashes($message);
mail("jeff@zmachine.net","Contact from: $email",$message,"$email");


header('Location: thanks.html');
exit();

?>


<!-- Thank You Page -->




<?php 
}
?>