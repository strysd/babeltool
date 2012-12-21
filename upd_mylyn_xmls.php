<?php
require 'upd_common.php';

//Mylyn 1.6.1 - 1.7.2 Doc
$search = array(
		'Repository configuration','Editor Preferences',
		'Table of contents','Project Settings',
		'Markup Conversion',
		'Markup Languages','Markup Language',
		'Word Completion',

		'Tips and Tricks','Getting Started',
		'Content Assist','Active folding',
		'Quick Outline',

		'label="Preferences"','label="Whitespace"',
		'label="Spelling"','label="Overview"',
		'label="Examples"',

		'label="Outline"',
		'label="Folding"'
);

$replace = array(
		'リポジトリー構成','エディター設定',
		'目次','プロジェクト設定',
		'マークアップ変換',
		'マークアップ言語','マークアップ言語',
		'単語補完',

		'ヒント','はじめに',
		'コンテンツ・アシスト','アクティブな折りたたみ',
		'クイック・アウトライン',

		'label="設定"','label="スペース"',
		'label="スペル"','label="概要"',
		'label="サンプル"',

		'label="アウトライン"',
		'label="折りたたみ"'
);

$ret = replaceTexts('contextHelp', $search, $replace, 4);
//$ret = replaceTexts('toc', $search, $replace, 0);
//$ret = replaceTexts('toc-sdk', $search, $replace, 0);
$ret = replaceTexts('help/Mylyn WikiText User Guide-toc', $search, $replace, 23);
$ret = replaceTexts('help/devguide/WikiText Developer Guide-toc', $search, $replace, 7);
//$ret = replaceTexts('help/examples/build-wikitext-to-dita.xml', $search, $replace, 0);

echo '<BR>end';