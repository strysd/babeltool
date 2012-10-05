<?php
require 'upd_common.php';

//Mylyn 1.6.1 Doc
$search = array(
		'Editor Preferences',
		'Table of contents',
		'Project Settings',
		'Markup Languages',
		'Markup Language',
		'Word Completion',

		'Tips and Tricks',
		'Getting Started',
		'Content Assist',
		'Active folding',
		'Quick Outline',

		'label="Preferences"',
		'label="Whitespace"',
		'label="Spelling"',
		'label="Overview"',
		'label="Examples"',

		'label="Outline"',
		'label="Folding"'
);

$replace = array(
    'エディター設定',
		'目次',
		'プロジェクト設定',
		'マークアップ言語',
		'マークアップ言語',
		'単語補完',

		'ヒント',
		'はじめに',
		'コンテンツ・アシスト',
		'アクティブな折りたたみ',
		'クイック・アウトライン',

		'label="設定"',
		'label="スペース"',
		'label="スペル"',
		'label="概要"',
		'label="サンプル"',

		'label="アウトライン"',
		'label="折りたたみ"'
);


$ret = replaceTexts('help/devguide/WikiText Developer Guide-toc', $search, $replace, 7);
$ret = replaceTexts('help/Mylyn WikiText User Guide-toc', $search, $replace, 21);
$ret = replaceTexts('contextHelp', $search, $replace, 2);

echo '<BR>end';