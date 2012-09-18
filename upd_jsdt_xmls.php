<?php
require 'upd_common.php';

//RSE 3.3.1 Doc
$search = array(
		'Create a new JavaScript file','Create a Javascript project',
		'Create an HTML Project',
		'Create a new HTML file','Property Pages',
		'Development Guide',
		'Getting Started', 'API Reference',
		'JSDT Overview', 'Rhino Debug',
		'Working with ',
		'label="Preferences"','label="Launching "',
		'label="Reference"','label="Launching"',
		'label="Debugging"','label="Editors"',
		'label="Concepts"',
		'label="views"','label="Topic"',
		'label="Tasks"','label="Legal"',
		'label="Debug"','label="Book"',
);

$replace = array(
'JavaScript ファイルを新規作成','Javascript プロジェクトを作成',
		'HTML プロジェクトを作成',
		'HTML ファイルを新規作成','プロパティーページ',
		'開発ガイド',
		'はじめに', 'API リファレンス',
		'JSDT 概要', 'Rhino デバッグ',
		'',
		'label="設定"','label="起動"',
		'label="リファレンス"','label="起動"',
		'label="デバッグ"','label="エディター"',
		'label="コンセプト"',
		'label="ビュー"','label="トピック"',
		'label="タスク"','label="リーガル"',
		'label="デバッグ"','label="ブック"'
);

$ret = replaceTexts('debug-contexts', $search, $replace, 1);
$ret = replaceTexts('toc', $search, $replace, 7);
$ret = replaceTexts('tocconcepts', $search, $replace, 2);
$ret = replaceTexts('tocgettingstarted', $search, $replace, 5);
$ret = replaceTexts('tocreference', $search, $replace, 9);
$ret = replaceTexts('toctasks', $search, $replace, 2);
$ret = replaceTexts('ui-contexts', $search, $replace, 1);

echo '<BR>end';