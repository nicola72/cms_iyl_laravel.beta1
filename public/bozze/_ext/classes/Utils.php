<?php


class Utils 
{
	public static function formatPrice($amount)
	{
	    return number_format($amount, 2, ",", ".");
	}
	
	public static function isEmail($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return false;
		}
		return true;
	}
}

?>