<?php
require 'upd_common.php';

//WST Doc 1.2
$search = array(
		"Web Tools Platform reference information",
		"Web Tools Platform User Guide",
		"Creating Web applications",
//		"Creating Java EE and enterprise applications",
		"Editing markup language files",
		"Developing Web service applications",
		"Using the server tools",
//		"Limitations and Known Issues",
		'label="Reference"', 'label="Legal"',
);

$replace = array(
		"Web ツール・プラットフォーム・リファレンス情報",
		"Web ツール・プラットフォーム・ユーザーガイド",
		"Web アプリケーションを作成",
//		"Creating Java EE and enterprise applications",
		"マークアップ言語のファイルを編集",
		"Web サービス・アプリケーションを開発",
		"サーバー・ツールを使用",
//		"Limitations and Known Issues",
		'label="リファレンス"', 'label="リーガル"',
);

$ret = replaceTexts('reference_toc', $search, $replace, 1);
$ret = replaceTexts('toc', $search, $replace, 7);

echo '<BR>end';