<?php
require 'upd_common.php';

//wst.wsi.ui.doc.user_1.0.700
$search = array(
		"Using the TCP/IP Monitor to test Web services",
//		"Validating WS-I Web service traffic compliance",
		"Validating WSDL files",
);

$replace = array(
		"Web サービスのテストに TCP/IP モニターを使用",
//		"Validating WS-I Web service traffic compliance",
		"WSDL ファイルを検証",
);

$ret = replaceTexts('org.eclipse.wst.wsi.ui.doc.userindex', $search, $replace, 5);
$ret = replaceTexts('wswsitest_toc', $search, $replace, 2);

echo '<BR>end';