<?php
require 'upd_common.php';

//EGit 2.1 Doc
$search = array(
'Pushing to another Git Repository','Replace with File in Git Index',
'Destination Git Repository','Wizard for project import',
'Compare with Working Tree','Repository configuration',
'Fetch Ref Specifications','Cloning a Git Repository',
'Push Ref Specifications','Compare with each other',
'Gerrit Configuration','Committing changes',
'Link with Selection','Working Directory','Working directory',
'Push Confirmation','Local Destination','Label Decorations',
'Create Repository','Synchronize View',
'Link with Editor','Show in History','Filter Settings',
'Create Branch...','Branch Selection','Create Patch...',
'Aborting Rebase','Project import','Commit Message',
'Getting Started','Local Branches',
//意図的に空白にする
'Working with ',
'Wrap Comments',
'Revert Commit','Delete branch','Create Tag...',
'label="Configuration"','Commit Dialog','label="Installation"',
'History View','Command Line',
'Compare Mode','label="Repository"','label="Navigation"',
'label="Committing"','label="Reference"','label="Branching"',
'User Guide',
'label="Snippets"','Push URI','label="Concepts"',
'label="Overview"','label="Features"',
'label="Checkout"','label="Branches"','label="Remotes"',
'label="Refresh"','label="Merging"','label="Models"',
'label="Tasks "',
'label="Tasks"','label="Reset"','label="Merge"',
'label="Menus"','label="Index"',
'label="Copy "','label="Open "','label="Open"',
'label="Mode"','label="Find"','label="Copy"',
);

$replace = array(
'他の Git リポジトリーにプッシュ','Git インデックスのファイルと置換',
'宛先の Git リポジトリー','プロジェクトのインポート用ウィザード',
'作業用ツリーと置換','リポジトリー構成',
'参照仕様をフェッチ','Git リポジトリーを複製',
'参照仕様をプッシュ','相互比較',
'Gerrit 構成','変更をコミット',
'選択内容にリンク','作業ディレクトリー','作業ディレクトリー',
'プッシュの確認','ローカルの宛先','ラベル装飾',
'リポジトリーを作成','同期化ビュー',
'エディターにリンク','ヒストリーに表示','フィルター設定',
'ブランチを作成...','ブランチ選択','パッチを作成...',
'リベースを中止','プロジェクト・インポート','コミット・メッセージ',
'はじめに','ローカル・ブランチ',
//意図的に空白にする
'',
'コメントを折り返す',
'コミットを元に戻す','ブランチを削除','タグを作成...',
'label="構成"','コミット・ダイアログ','label="インストール"',
'履歴ビュー','コマンド行',
'比較モード','label="リポジトリー"','label="ナビゲーション"',
'label="コミット中"','label="参照"','label="ブランチ"',
'ユーザーガイド',
'label="スニペット"','URI をプッシュ','label="コンセプト"',
'label="概要"','label="フィーチャー"',
'label="チェックアウト"','label="ブランチ"','label="リモート"',
'label="更新"','label="マージ"','label="モデル"',
'label="タスク"',
'label="タスク"','label="リセット"','label="マージ"',
'label="メニュー"','label="インデックス"',
'label="コピー"','label="開く"','label="開く"',
'label="モード"','label="検索"','label="コピー"',
);

$ret = replaceTexts('contexts', $search, $replace, 4);
$ret = replaceTexts('cheatsheets/clone', $search, $replace, 4);
$ret = replaceTexts('cheatsheets/push', $search, $replace, 5);
$ret = replaceTexts('help/toc', $search, $replace, 98);
$ret = replaceTexts('intro/overviewExtensionContent', $search, $replace, 1);
$ret = replaceTexts('intro/tutorialsExtensionContent', $search, $replace, 1);
//$ret = replaceTexts('intro/whatsnewExtensionContent', $search, $replace, 0);

echo '<BR>end';