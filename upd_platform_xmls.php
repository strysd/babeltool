<?php
require 'upd_common.php';

//Platform 4.2 Doc help
$search = array(
'Delete the selected item.',
'Available Software Sites','Show Disabled Features','Editing Ant Buildfiles',
'Uninstalling Software','Startup and Shutdown','Installation Details',
'Workbench User Guide',
'Password Management','Override and Update','Override and Commit',
'Network Connections','Deleting resources','Project Explorer ',
'Password Recovery','Label Decorations','File Associations',
'Copying Resources','Automatic Updates','Resource Filters',
'Editors and views','External editors',
'Project Explorer','Linked Resources','CVS Repositories',
'Colors and Fonts','Virtual Folders',
'Exporting files','Importing files',
'Tips and Tricks','Properties view','Getting Started',
'New File Wizard','Somewhat quiet','Secure Storage',
'The Search view',
'Basic tutorial',
'Path Variables','label="Install/Update"','External Tools',
'Bookmarks View','Opening files',
'Local History','Import Wizard',
'Help Contents','Export Wizard','Content Types',
'label="Compare/Patch"','label="Accessibility"','Working Sets',
'The Workbench',
//意図的に空白に変換
'Working with ',
'Problems view',
'cheat sheets',
'Text Editors','label="Perspectives"',
'Outline view','Help Content',
'Get Contents','CVS Annotate','label="Capabilities"',
'Web Browser','label="Preferences"','File searching','File Search',
'Search view',
'Editor Area','CVS Console','Build Order',
'Ant Support','Tasks View',
'label="Annotations"','label="Workspaces"',"What's New",
'label="Watch/Edit"','Very quiet','Quick Diff',
'Fast Views',
'label="Committing"','label="Appearance"','Ant Editor',
'label="Workspace"','label="Workbench"','label="Searching"',
'label="Resources"','label="Replacing"','label="Reference"',
'Quick Fix','File Menu','label="Exporting"',
'Edit Menu','label="Comparing"','label="Branching"',
'label="Bookmarks"','label="Versions"','label="Updating"',
'label="Spelling"','label="Renaming"','label="renaming"',
'label="Platform"','label="Features"','label="Branches"',
'label="Concepts"','label="Copying"',
'label="Welcome"','label="Markers"','label="General"',
'label="Editors"','label="Editing"','label="Update"',
'label="Search"','label="Finish"','label="Editor"',
'label="Commit"','label="Anchor"','label="views"',
'label="Tasks "','label="Moving"',
'label="Tasks"','label="Legal"','Go to',
'label="Files"','label="Debug"','label="Team"',
'label="Keys"','label="Help"',
);

$replace = array(
'選択した要素を削除。',
'利用できるソフトウェア・サイト','使用できないフィーチャーを表示','Ant ビルド・ファイルを編集',
'ソフトウェアをアンインストール','開始およびシャットダウン','インストール詳細',
'ワークベンチ・ユーザーガイド',
'パスワード管理','上書きおよび更新','上書きおよびコミット',
'ネットワーク接続','リソースを削除','プロジェクト・エクスプローラー',
'パスワードを復元','ラベル装飾','ファイルを関連付け',
'リソースをコピー','自動更新','リソース・フィルター',
'エディターとビュー','外部エディター',
'プロジェクト・エクスプローラー','リンクされたリソース','CVS リポジトリー',
'色とフォント','仮想フォルダー',
'ファイルをエクスポート','ファイルをインポート',
'ヒント','プロパティービュー','はじめに',
'新規ファイルウィザード','警告とエラー','セキュリティで保護されたストレージ',
'検索ビュー','基本チュートリアル',
'パス変数','label="インストール/更新"','外部ツール',
'ブックマーク・ビュー','ファイルをオープン',
'ローカル履歴','インポート・ウィザード',
'ヘルプ目次','エクスポート・ウィザード','コンテンツ・タイプ',
'label="比較/パッチ"','label="アクセシビリティ"','ワーキング・セット',
'ワークベンチ',
//意図的に空白に変換
'',
'問題ビュー',
'虎の巻',
'テキスト ・ エディタ','label="パースペクティブ"',
'アウトライン・ビュー','ヘルプ目次',
'コンテンツを取得','CVS 注釈','label="機能"',
'Web ブラウザー','label="設定"','ファイル検索','ファイル検索',
'検索ビュー',
'エディターエリア','CVS コンソール','ビルド順序',
'Ant サポート','タスク・ビュー',
'label="注釈"','label="ワークスペース"','新機能',
'label="監視/編集"','重大エラー','クイック Diff',
'高速ビュー',
'label="コミット"','label="外観"','Ant エディター',
'label="ワークスペース"','label="ワークベンチ"','label="検索"',
'label="リソース"','label="置換"','label="リファレンス"',
'クイック・フィックス','ファイル・メニュー','label="エクスポート"',
'編集メニュー','label="比較"','label="ブランチ"',
'label="ブックマーク"','label="バージョン"','label="更新"',
'label="スペル"','label="名前を変更"','label="名前を変更"',
'label="プラットフォーム"','label="フィーチャー"','label="ブランチ"',
'label="コンセプト"','label="コピー"',
'label="ようこそ"','label="マーカー"','label="全般"',
'label="エディター"','label="編集"','label="更新"',
'label="検索"','label="終了"','label="エディター"',
'label="コミット"','label="アンカー"','label="ビュー"',
'label="タスク"','label="移動"',
'label="タスク"','label="リーガル"','ジャンプ',
'label="ファイル"','label="デバッグ"','label="チーム"',
'label="キー"','label="ヘルプ"',
);

$ret = replaceTexts('contexts_AntUI', $search, $replace, 88);
$ret = replaceTexts('contexts_CommonNavigator', $search, $replace, 4);
$ret = replaceTexts('contexts_Compare', $search, $replace, 27);
$ret = replaceTexts('contexts_ExternalTools', $search, $replace, 13);
//$ret = replaceTexts('contexts_JSch', $search, $replace, 0);
$ret = replaceTexts('contexts_Net', $search, $replace, 1);
$ret = replaceTexts('contexts_P2', $search, $replace, 6);
$ret = replaceTexts('contexts_Search', $search, $replace, 16);
$ret = replaceTexts('contexts_SecureStorage', $search, $replace, 6);
$ret = replaceTexts('contexts_Team', $search, $replace, 7);
$ret = replaceTexts('contexts_Team_CVS', $search, $replace, 42);
$ret = replaceTexts('contexts_UserAssistance', $search, $replace, 8);
$ret = replaceTexts('contexts_Workbench', $search, $replace, 280);
$ret = replaceTexts('toc', $search, $replace, 8);
$ret = replaceTexts('topics_Concepts', $search, $replace, 34);
$ret = replaceTexts('topics_GettingStarted', $search, $replace, 36);
$ret = replaceTexts('topics_Reference', $search, $replace, 74);
$ret = replaceTexts('topics_Tasks', $search, $replace, 47);
$ret = replaceTexts('topics_Tips', $search, $replace, 5);
$ret = replaceTexts('topics_WhatsNew', $search, $replace, 5);

echo '<BR>end';