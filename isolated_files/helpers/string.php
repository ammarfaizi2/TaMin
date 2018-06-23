<?php

/**
 * Generate a random string. 
 *
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @param int		$n
 * @param string	$e
 * @return string
 */
function rstr($n, $e = null)
{
	$q = is_string($e) ? $e : "1234567890QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm____----";
	$c = strlen($q) - 1;
	$r = "";
	for ($i=0; $i < $n; $i++) { 
		$r .= $q[rand(0, $c)];
	}
	return $r;
}
