<?php
error_reporting(3);
session_start();

// Work around missing functions in old php
if (phpversion() < 5.5)
{
	require_once ('passwordLib.php');
}

include('functions.php');

if (isset($_POST["username_login"]))
{
	$user = new user($_SESSION["user_username"], 0);
	$user->login($_POST["username_login"], $_POST["password_login"]);
	$voting = new voting($_SESSION["user_username"]);
}
elseif (isset($_SESSION["user_username"]))
{
	$user = new user($_SESSION["user_username"], 0);
	$voting = new voting($_SESSION["user_username"]);
}
else
{
	$user = new user("guest", 0);
	$voting = new voting("guest");
}

if (isset($_POST["username_logout"]))
{
	$user->logout(0);
}
elseif (isset($_GET["stranka"]))
{
	$actual = $_GET["stranka"];
}
else
{
	$actual = "index";
}

include('header.php');

if (isset($_GET["stranka"]))
{
	$inc = $_GET["stranka"] . ".php";
	include($inc);
}
else
{
	include("uvod.php");
}

include('footer.php');
?>
</body>