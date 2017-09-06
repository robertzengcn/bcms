<?php

function boyi_redirect($url) {
	global $logger;

	// clean up URL before executing it
	while (strstr($url, '&&')) $url = str_replace('&&', '&', $url);
	while (strstr($url, '&amp;&amp;')) $url = str_replace('&amp;&amp;', '&amp;', $url);
	// header locates should not have the &amp; in the address it breaks things
	while (strstr($url, '&amp;')) $url = str_replace('&amp;', '&', $url);

	header('Location: ' . $url);
	session_write_close();
	exit;
}