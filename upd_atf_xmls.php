<?php
require 'upd_common.php';

//ATF 0.3 Doc help
$search = array(
	'Toolkit Framework Limitations',
	'Launching an AJAX Application',
	'Debugging an AJAX Application',
	'Toolkit Framework User Guide',
	'Extension Points Reference',

	'JavaScript Debugger',
	'Request Monitor',
	'Mozilla Browser',
	'JavaScript View',
	'Browser Console',

	'DOM Inspector',
	'DOM Watcher',
	'DOM Compare',
	'DOM Source',
	'Reference',

	'Overview',
	'Concepts',
	'Tools',
	'Tasks',
	'Legal',
'    ',
);

//TODO Working
$replace = array(
	'Toolkit Framework Limitations',
	'Launching an AJAX Application',
	'Debugging an AJAX Application',
	'Toolkit Framework User Guide',
	'Extension Points Reference',

	'JavaScript Debugger',
	'Request Monitor',
	'Mozilla Browser',
	'JavaScript View',
	'Browser Console',

	'DOM Inspector',
	'DOM Watcher',
	'DOM Compare',
	'DOM Source',
	'Reference',

	'Overview',
	'Concepts',
	'Tools',
	'Tasks',
	'Legal',
"\t",
);

$ret = replaceTexts('atfToc', $search, $replace, 1);

echo '<BR>end';