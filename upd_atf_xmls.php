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
	'label="Reference"',

	'label="Overview"',
	'label="Concepts"',
	'label="Tools"',
	'label="Tasks"',
	'label="Legal"',
);

$replace = array(
	'ツールキット・フレームワークの制約事項',
	'AJAX アプリケーションを起動',
	'AJAX アプリケーションをデバッグ',
	'ツールキット・フレームワーク・ユーザーガイド',
	'拡張ポイント・リファレンス',

	'JavaScript デバッガー',
	'リクエスト・モニター',
	'Mozilla ブラウザー',
	'JavaScript ビュー',
	'ブラウザーコンソール',

	'DOM インスペクター',
	'DOM ウォッチャー',
	'DOM 比較',
	'DOM ソース',
	'label="リファレンス"',

	'label="概要"',
	'label="コンセプト"',
	'label="ツール"',
	'label="タスク"',
	'label="リーガル"',
);

$ret = replaceTexts('atfToc', $search, $replace, 20);

echo '<BR>end';