<?php 
function toEnglish($number)
{
	return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], $number);
}
function toBangla($number)
{

	return str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $number);	
}	

function label($text, $type = "success")
{
	return "<span class='label label-xs label-$type' >$text</span>";
}