<?php
require 'upd_common.php';

//wst.wsdl.ui.doc.user_1.0.800
$search = array(
//"Exploring WSDL using the Web Services Explorer",
"Editing WSDL files with the WSDL Editor",
"Creating a new type for your WSDL file",
"Creating an import statement",
"Adding a port to a service",
"Adding a part to a message",
"Creating a new WSDL file",
"Importing a WSDL file",
//"Setting a port type",
"Adding an operation",
"Editing WSDL files",
"Setting a binding",
"Adding a service",
"Adding a message",
);

$replace = array(
//"Web サービス・エクスプローラーを使用して WSDL を Exploring",
"WSDL エディターで WSDL ファイルを編集",
"WSDL ファイルに対して型を新規作成",
"import 文を作成",
"サービスにポートを追加",
"メッセージにパートを追加",
"WSDL ファイルを新規作成",
"WSDL ファイルをインポート",
//"Setting a port type",
"操作を追加",
"WSDL ファイルを編集",
"バインティングを設定",
"サービスを追加",
"メッセージを追加",
);

$ret = replaceTexts('org.eclipse.wst.wsdl.ui.doc.userindex', $search, $replace, 24);
$ret = replaceTexts('wswsdleditorc_toc', $search, $replace, 1);
$ret = replaceTexts('wswsdleditort_toc', $search, $replace, 12);

echo '<BR>end';