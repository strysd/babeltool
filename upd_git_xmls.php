<?php
require 'upd_common.php';

//EGit 1.3 Doc
$search = array(
'Link with Selection','Working Directory','Label Decorations',
'Link with Editor','Show in History','Filter Settings',
'Wrap Comments','label="Configuration"','label="Installation"',
'Compare Mode','label="Repository"','label="Navigation"',
'label="Committing"','label="Reference"','label="Branching"',
'label="Snippets"','label="Overview"','label="Features"',
'label="Refresh"','label="Merging"','label="Models"',
'label="Tasks"','label="Reset"','label="Merge"',
'label="Menus"','label="Index"','label="Open"',
'label="Mode"','label="Find"','label="Copy"',
);

$replace = array(
'選択内容にリンク','作業ディレクトリー','ラベル装飾',
'エディターにリンク','ヒストリーに表示','フィルター設定',
'コメントを折り返す','label="構成"','label="インストール"',
'比較モード','label="リポジトリー"','label="ナビゲーション"',
'label="コミット中"','label="参照"','label="ブランチ"',
'label="スニペット"','label="概要"','label="フィーチャー"',
'label="更新"','label="マージ"','label="モデル"',
'label="タスク"','label="リセット"','label="マージ"',
'label="メニュー"','label="インデックス"','label="開く"',
'label="モード"','label="検索"','label="コピー"',
);

$ret = replaceTexts('toc', $search, $replace, 37);

echo '<BR>end';