// Database Structure 
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `username` text NOT NULL,
 `email` text NOT NULL,
 `password` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1

$host="localhost";
$username="root";
$password="";
$databasename="sample";
$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

<?php
if(isset($_POST['get_username']))
{
 $user_name=str_replace(' ', '', $_POST['get_username']);
 random_username($user_name);
 exit();
}

function random_username($user_name)
{
 $new_name = $user_name.mt_rand(0,10000);
 check_user_name($new_name,$user_name);
}

function check_user_name($new_name,$user_name)
{
 $select = mysql_query("select * from users where username='$new_name'");

 if(mysql_num_rows($select))
 {
  random_username($user_name);
 }
 else
 {
  echo $new_name;
 }
}

if(isset($_POST['signup']))
{
 $name=$_POST['name'];
 $username=$_POST['username_value'];
 $email=$_POST['email'];
 $pass=$_POST['pass'];
 mysql_query("insert into users values('','$name','$username','$email','$pass')");
}
?>