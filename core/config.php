<?php
$server_name = $_SERVER['SERVER_NAME'] ?? 'localhost';

if($server_name == 'localhost')
{
	/** database config **/
	define('DBNAME', 'petspot_clinic'); // <-- use your real DB name
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/PetSpot_clinic/public'); // <-- use your real project path

}else
{
	/** database config **/
	define('DBNAME', 'petspot_clinic');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "petspot clinic");

/** true means show errors **/
define('DEBUG', true);
