<?php
require 'upd_common.php';

//Mylyn 1.6.1 - 1.7.2 Doc
$search = array(
		'Adding CSS to HTML Output',
		'Repository configuration','Editor Preferences',
		'Creating A New File',
		'Table of contents','Project Settings',
		'Markup Conversion',
		'Markup Languages','Markup Language',
		'Font Preferences','Word Completion',

		'Tips and Tricks','Getting Started',
		'Developer Guide"',
		'Content Assist','Active folding',
		'Quick Outline','User Guide"',

		'label="Preferences"','label="Whitespace"',
		'label="Spelling"','label="Overview"',
		'label="Examples"',

		'label="Outline"',
		'label="Folding"'
);

$replace = array(
		'CSS を HTML 出力に追加',
		'リポジトリー構成','エディター設定',
'ファイルを新規作成',
		'目次','プロジェクト設定',
		'マークアップ変換',
		'マークアップ言語','マークアップ言語',
		'フォント設定','単語補完',

		'ヒント','はじめに',
		'開発者ガイド"',
		'コンテンツ・アシスト','アクティブな折りたたみ',
		'クイック・アウトライン','ユーザーガイド"',

		'label="設定"','label="スペース"',
		'label="スペル"','label="概要"',
		'label="サンプル"',

		'label="アウトライン"',
		'label="折りたたみ"'
);

$ret = replaceTexts('contextHelp', $search, $replace, 5);
$ret = replaceTexts('toc', $search, $replace, 1);
$ret = replaceTexts('toc-sdk', $search, $replace, 1);
$ret = replaceTexts('help/Mylyn WikiText User Guide-toc', $search, $replace, 26);
$ret = replaceTexts('help/devguide/WikiText Developer Guide-toc', $search, $replace, 9);
//Ant build file : help/examples/build-wikitext-to-dita

echo '<BR>end';