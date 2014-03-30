<?php
	if (isset($_FILES["file"]["name"]) && isset($_POST["fileName"]))
	{
		$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		$imgPath = "../../imgauto/";
		
		/*if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 2000000)
		&& in_array($extension, $allowedExts))*/

	if (
		($_FILES["file"]["size"] < 2000000)
		&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				echo "Type: " . $_FILES["file"]["type"] . "<br>";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

				if (file_exists($imgPath . $_FILES["file"]["name"]))
				{
					echo $_FILES["file"]["name"] . " already exists. ";
				}
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], $imgPath . $_POST["fileName"]);
					echo "Stored in: " . $imgPath . $_POST["fileName"];
				}
			}
		}
		else
		{
			echo "Invalid file";
		}
	}
	else
	{
		
		echo "No file";
		
		//Controllo i permessi di scrittura
		/*$imgPath = "../../imgauto/";
		error_reporting(E_ALL);
		ini_set("display_errors", "on");

		if (! is_writable(__DIR__)) {
			trigger_error("I don't have permission");
		}

		file_put_contents($imgPath . 'test.txt', 'TEST');*/

	}
?> 