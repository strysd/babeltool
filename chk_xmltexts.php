<?php
//list up files
require_once 'chk_var.php';
$basePath = $target_path;
$files = scan_file($basePath);

foreach ($files as $file) {
	$a = parseFile($file);
}

/**
 * @param string $dir
 * @return array
 */
function scan_file($dir) {
	$dir = rtrim($dir, '/') . '/';
	$list = $tmp = array();
	foreach(glob($dir . '*', GLOB_ONLYDIR) as $child_dir) {
		if ($tmp = scan_file($child_dir)) {
			$list = array_merge($list, $tmp);
		}
	}

	foreach(glob($dir . '{*.xml}', GLOB_BRACE) as $xmlfiles) {
		$list[] = $xmlfiles;
	}

	return $list;
}

/**
 * @param array $param
 */
function sortAndList($param) {
	sort($param, SORT_STRING);
	foreach ($param as $value) {
		echo $value, '<BR>',"\n";
	}
	echo '<hr>',"\n";
	return;
}

/**
 * @param string $file
 * @return boolean|string Type
 */
function parseFile($file){
$contents = file_get_contents($file);
$xml = simplexml_load_string( $contents , 'SimpleXMLElement', LIBXML_NOBLANKS );

//judges as unsupported file by root element
$isPlugin = $xml->xpath('/plugin');
if(count($isPlugin) > 0){
	echo 'file name: ',"\n", $file,"\n", ' is unsupported.<BR>',"\n";
	return false;
}

$isProject = $xml->xpath('/project');
if(count($isProject) > 0){
	echo 'file name: ',"\n", $file,"\n", ' is unsupported.<BR>',"\n";
	return false;
}

//judges as Table of Contents if root element is toc
$isToc = $xml->xpath('/toc');
if(count($isToc) > 0){
	echo 'file name: ',"\n", $file,"\n", '<BR>',"\n",
		 'label attribute of toc: <br>',"\n", $isToc['0']['label'],"\n", '<br>',"\n",
		 'label attributes of topics:<BR>',"\n";
	//various levels exist for topic
	$topics = array();
	foreach ($xml->xpath('//topic') as $topic){
		$topics[] = $topic['label'];
	}
	sortAndList($topics);
	return true;
}

//judges as Context Help if contexts element is in root
$isContextHelp = $xml->xpath('/contexts');
if(count($isContextHelp) > 0){
	echo 'file name: ',"\n", $file,"\n", '<BR>',"\n",
		 'file type: Context Help',"\n",
		 '<table border=1>',
		 '<tr><th>id</th><th>desc.</th></tr>',"\n";
	foreach ($xml->xpath('/contexts/context') as $context){
		echo '<tr>',
			 '<td>', $context['id'], '</td>',"\n",
			 '<td>', $context->description, '</td>',
			 '</tr>',"\n";
	}
	echo '</table>',"\n";
	echo 'label attributes of topics:<BR>',"\n";
	$topics = array();
	foreach ($xml->xpath('/contexts/context/topic') as $topic){
		$topics[] = $topic['label'];
	}
	sortAndList($topics);
	return true;
}


//judges as Simple Cheat Sheet if cheatsheet element is in root
$isCheatsheet = $xml->xpath('/cheatsheet');
if(count($isCheatsheet) > 0){

	echo 'file name: ',"\n", $file,"\n", '<BR>',"\n",
		 'file type: Cheat Sheet',"\n",
		 '<table border=1>',
		 '<tr><th>title</th><th>intro desc.</th></tr>',"\n";
	foreach ($xml->xpath('/cheatsheet') as $cheatsheet){
		$desc = (string)$cheatsheet->intro->description->b;
		if (strlen($desc) == 0 ) {
			$desc = (string)$cheatsheet->intro->description;
		}
		echo '<tr><td>', $cheatsheet['title'], '</td>',"\n",
			 '<td>', $desc, '</td></tr>',"\n";
	}
	echo '</table>';

	echo '<table border=1>',
		 '<tr><th>title</th><th>desc.</th></tr>',"\n";
	foreach ($xml->xpath('/cheatsheet/item') as $item){
		$desc = $item->description;
		echo '<tr>',
			 '<td>', $item['title'], '</td>',"\n",
			 '<td>', $desc, '</td>',"\n",
			 '</tr>',"\n";
	}
	echo '</table>',"\n",
		 '<hr>',"\n";
	return true;
}

//judges as Composite Cheat Sheet if compositecheatsheet element is in root
$isComposite = $xml->xpath('/compositeCheatsheet');
if(count($isComposite) > 0){

	echo 'file name: ',"\n", $file,"\n", '<BR>',"\n",
		 'file type: Composite Cheat Sheet<BR>',"\n",
		 'name attribute of sheet: <br>',"\n", $isComposite['0']['name'],"\n", '<BR>',"\n",
		 '<table border=1>',
		 '<tr><th>group name</th>',
		 '<th>intro</th><th>compl.</th></tr>',"\n";
	foreach ($xml->xpath('/compositeCheatsheet/taskGroup') as $taskGroup){
		$intro = (string)$taskGroup->intro->b;
		if (strlen($intro) == 0 ) {
			$intro = (string)$taskGroup->intro;
		}
		$compl = (string)$taskGroup->onCompletion->b;
		if (strlen($compl) == 0 ) {
			$compl = (string)$taskGroup->onCompletion;
		}
		echo '<tr>',
			 '<td>', $taskGroup['name'], '</td>',"\n",
			 '<td>', $intro, '</td>',"\n",
			 '<td>', $compl, '</td>',
			 '</tr>',"\n";
	}
	echo '</table>',"\n";

	echo '<table border=1>',
		 '<tr><th>name</th>',
		 '<th>intro</th><th>compl.</th></tr>',"\n";
	foreach ($xml->xpath('/compositeCheatsheet/taskGroup/task') as $task){
		$intro = (string)$task->intro->b;
		if (strlen($intro) == 0 ) {
			$intro = (string)$task->intro;
		}
		$compl = (string)$task->onCompletion->b;
		if (strlen($compl) == 0 ) {
			$compl = (string)$task->onCompletion;
		}
		echo '<tr>',
			 '<td>', $task['name'], '</td>',"\n",
			 '<td>', $intro, '</td>',"\n",
			 '<td>', $compl, '</td>',"\n",
			 '</tr>',"\n";
	}
	echo '</table>',"\n",
		 '<hr>',"\n";
	return true;
}

echo 'file name: ',"\n", $file,"\n", ' is <b>unknown</b> type.<BR>',"\n";
return false;
}