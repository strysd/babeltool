<?php
require 'upd_common.php';

//SVN 0.7.9
$search = array(
'Main feature differences between SVN® and CVS',
'About Subversive and Subversive User Guide',
'Ignoring resources from Version Control',
'Comments and Input History Preferences',
'Adding resources to Version Control',

'New SVN Repository Location Wizard',
'Import/Export repository locations',
'Repository Exploring Perspective',
'Automatic Properties Preferences',

'Locking and unlocking resources',
'Switching project to a new URL',
'Working with conflict changes',
'Comment Templates Preferences',
'Label Decoration Preferences',

'Working with Compare Editor',
'Connectors Discovery Wizard',
'Revision Graph Preferences',
'Repository Location Wizard',

'Installation and migration',
'Comments and Input History',
'Workspace Synchronization',
'installation instructions',
'Edit Tree Conflict Dialog',
'Trunk, Branches and Tags',

'Properties Configuration',
'Find/Check Out As Wizard',
'Subversive architecture',
'Repository Browser View',
'Performance Preferences',

'Making your own changes',
'Diff Viewer Preferences',
'Buckminster integration',
'Team support with SVN®',
'Overriding operations',

'FastTrack integration',
'Note for Linux users',
'Connectors Discovery',
'Another user changes',
'Annotate Preferences',

'update instructions',
'supported protocols',
'Subversive overview',
'Password Management',
'Creating repository',

'Console Preferences',
'Subversive modules',
'Setting properties',
'Repository Layouts',
'Extracting changes',

'Sharing a project',
'Setting externals',
'Reverting changes',
'Repository Dialog',
'Mylyn integration',

'Label Decorations',
'Comment Templates',
'Setting keywords',
'extension points',
'unique features',

'SVN Preferences',
'Repository View',
'Properties View',
'More about SVN®',
'main menu group',

'Getting Started',
'Tree Conflicts',
'Special Thanks',
'Sharing Wizard',

'Revision Graph',
'Creating tags',
'label="Requirements"',
'Merge Dialog',
'History View',

'Checking out',
'SVN Toolbar',
'SVN Folders',
'SVN Console',
'label="Refactoring"',

'label="Preferences"',
'label="Performance"',
'Diff Viewer',
'User Guide',
'Locks View',

'label="Commiting"',
'label="Branching"',
'label="Updating"',
'SVN Info',
'label="Patching"',

'Hot Keys',
'label="Merging"',
'label="Console"',
'label="Actions"',
'label="Update"',

'label="Legal"',
);

$replace = array(
'SVN® と CVS との機能の主な差異',
'Subversive について、及びユーザーガイド',
'バージョン管理でリソースを無視',
'コメントおよび入力履歴設定',
'バージョン管理にリソースを追加',

'新規 SVN リポジトリーロケーション・ウィザード',
'リポジトリーロケーションをエクスポート・インポート',
'リポジトリー・エクスプローリング・パースペクティブ',
'自動プロパティー設定',

'リソースをロック・ロック解除',
'プロジェクトを新規 URL に切り替え',
'競合する変更箇所を作業',
'コメント・テンプレート設定',
'ラベル修飾設定',

'比較エディターで作業',
'コネクター検出ウィザード',
'リビジョン・グラフ設定',
'リポジトリーロケーションウィザード',

'インストール及びマイグレーション',
'コメントおよび入力履歴',
'ワークスペース同期',
'導入手順',
'ツリーの競合を編集ダイアログ',
'トランク、ブランチ及びタグ',

'プロパティー構成',
'検索/別名チェックアウト・ウィザード',
'Subversive アーキテクチャー',
'リポジトリーブラウザービュー',
'パフォーマンス設定',

'固有の変更を作成',
'Diff ビュアー設定',
'Buckminster 統合',
'SVN®によるチーム・サポート',
'上書き操作',

'FastTrack 統合',
'Linux ユーザーのための注意',
'コネクター検出',
'他のユーザーの変更',
'注釈設定',

'更新手順',
'サポートされるプロトコル',
'Subversive 概要',
'パスワード管理',
'リポジトリーを作成',

'コンソール設定',
'Subversive モジュール',
'プロパティーを設定',
'リポジトリーレイアウト',
'変更を抽出',

'プロジェクトを共用',
'外部プログラムを設定',
'変更を元に戻す',
'リポジトリーダイアログ',
'Mylyn 統合',

'ラベル修飾',
'コメント・テンプレート',
'キーワードを設定',
'拡張ポイント',
'固有の機能',

'SVN 設定',
'リポジトリービュー',
'プロパティービュー',
'SVN® の詳細',
'メイン・メニューグループ',

'はじめに',
'ツリー競合',
'謝辞',
'共用ウィザード',

'リビジョン・グラフ',
'タグを作成',
'label="必要条件"',
'マージ・ダイアログ',
'履歴ビュー',

'チェックアウト',
'SVN ツールバー',
'SVN フォルダー',
'SVN コンソール',
'label="リファクタリング"',

'label="設定"',
'label="パフォーマンス"',
'Diff ビュアー',
'ユーザーガイド',
'ロック・ビュー',

'label="コミット"',
'label="ブランチ"',
'label="更新"',
'SVN 情報',
'label="パッチ"',

'ホットキー',
'label="マージ"',
'label="コンソール"',
'label="アクション"',
'label="更新"',

'label="リーガル"',
);

$ret = replaceTexts('compare_editor', $search, $replace, 4);
$ret = replaceTexts('contexts', $search, $replace, 102);
$ret = replaceTexts('getting_started', $search, $replace, 2);
$ret = replaceTexts('preferences', $search, $replace, 9);
$ret = replaceTexts('subversion', $search, $replace, 3);
$ret = replaceTexts('subversive', $search, $replace, 13);
$ret = replaceTexts('svn_actions', $search, $replace, 20);
$ret = replaceTexts('svn_team', $search, $replace, 26);
$ret = replaceTexts('toc', $search, $replace, 8);

echo '<BR>end';