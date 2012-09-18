<?php
require 'upd_common.php';

//RSE 3.3.1 Doc
$search = array(
'Remote System Explorer Connections',
'Remote System Explorer',
'RSE User Guide',
'Getting Started',
'Working with ',
'label="Legal"',
);

$replace = array(
'リモート・システム・エクスプローラー接続',
'リモート・システム・エクスプローラー',
'RSE ユーザーガイド',
'はじめに',
'',
'label="リーガル"',
);

$ret = replaceTexts('toc', $search, $replace, 14);

echo '<BR>end';