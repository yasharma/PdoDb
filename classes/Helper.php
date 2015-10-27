<?php
class Helper
{
	
	public static function pr($variable)
	{
		echo "<pre>";
		print_r($variable);
		echo "</pre>";
	}

	public static function FormatDate($date,$format = 'm/d/Y')
	{
		return date($format, strtotime($date));
	}
}