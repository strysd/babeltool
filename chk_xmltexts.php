<?php
require_once 'chk_var.php';

$basePath = $target_path;
$files = scan_file($basePath);

foreach ($files as $file) {
	$labels = parseFile($file);
	if ($labels === false) {
		printFileAttribute($file, 'unsupported');
	} else {
		printLabels($labels);
	}
	echo '<hr>', "\n";
}

/**
 * @param string $dir target path
 * @return array xml files
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
 * @param string $file
 * @return false|array labels if supported, false if not.
 */
function parseFile($file){
	$contents = file_get_contents($file);
	$xml = simplexml_load_string( $contents , 'SimpleXMLElement', LIBXML_NOBLANKS );
	$labels = array();

	//judges as unsupported file by root element
	$isPlugin = $xml->xpath('/plugin');
	if(count($isPlugin) > 0){
		return false;
	}

	$isProject = $xml->xpath('/project');
	if(count($isProject) > 0){
		return false;
	}

	//judges as Table of Contents if root element is toc
	$isToc = $xml->xpath('/toc');
	if(count($isToc) > 0){
		printFileAttribute($file, 'Table of Contents');
		//toc title
		$labels[] = $isToc['0']['label'];
		//various levels exist for topic
		foreach ($xml->xpath('//topic') as $topic){
			$labels[] = $topic['label'];
		}
		return $labels;
	}

	//judges as Context Help if contexts element is in root
	$isContextHelp = $xml->xpath('/contexts');
	if(count($isContextHelp) > 0){
		printFileAttribute($file, 'Context Help');

		printTableHeader('id', 'desc.');
		foreach ($xml->xpath('/contexts/context') as $context){
			printTableRow($context['id'], $context->description);
		}
		printTableEnd();

		foreach ($xml->xpath('/contexts/context/topic') as $topic){
			$labels[] = $topic['label'];
		}
		return $labels;
	}

	//judges as Simple Cheat Sheet if cheatsheet element is in root
	$isCheatsheet = $xml->xpath('/cheatsheet');
	if(count($isCheatsheet) > 0){
		printFileAttribute($file, 'Cheat Sheet');

		printTableHeader('title', 'intro desc.');
		foreach ($xml->xpath('/cheatsheet') as $cheatsheet){
			$desc = (string)$cheatsheet->intro->description->b;
			if (strlen($desc) == 0 ) {
				$desc = (string)$cheatsheet->intro->description;
			}
			printTableRow($cheatsheet['title'], $desc);
		}
		printTableEnd();

		printTableHeader('title', 'desc.');
		foreach ($xml->xpath('/cheatsheet/item') as $item){
			$desc = $item->description;
			printTableRow($item['title'], $desc);
		}
		printTableEnd();

		return $labels;
	}

	//judges as Composite Cheat Sheet if compositecheatsheet element is in root
	$isComposite = $xml->xpath('/compositeCheatsheet');
	if(count($isComposite) > 0){
		printFileAttribute($file, 'Composite Cheat Sheet');
		//sheet name
		$labels[] = $isComposite['0']['name'];

		printTableHeader('group name', 'intro', 'compl.');
		foreach ($xml->xpath('/compositeCheatsheet/taskGroup') as $taskGroup){
			$intro = (string)$taskGroup->intro->b;
			if (strlen($intro) == 0 ) {
				$intro = (string)$taskGroup->intro;
			}
			$compl = (string)$taskGroup->onCompletion->b;
			if (strlen($compl) == 0 ) {
				$compl = (string)$taskGroup->onCompletion;
			}
			printTableRow($taskGroup['name'], $intro, $compl);
		}
		printTableEnd();

		printTableHeader('name', 'intro', 'compl.');
		foreach ($xml->xpath('/compositeCheatsheet/taskGroup/task') as $task){
			$intro = (string)$task->intro->b;
			if (strlen($intro) == 0 ) {
				$intro = (string)$task->intro;
			}
			$compl = (string)$task->onCompletion->b;
			if (strlen($compl) == 0 ) {
				$compl = (string)$task->onCompletion;
			}
			printTableRow($task['name'], $intro, $compl);
		}
		printTableEnd();

		return $labels;
	}

	return false;
}

/**
 * @param string $file
 * @param string $type
 * @return void
 */
function printFileAttribute($file, $type) {
	echo 'file name: ', $file, '<BR>', "\n",
		 'file type: ', $type, '<BR>', "\n";
}

/**
 * @param string $col1
 * @param string $col2
 * @param string $col3
 * @return void
 */
function printTableHeader($col1, $col2, $col3 = null) {
	echo '<table border=1><tr>',
		 '<th>', $col1, '</th>', "\n",
		 '<th>', $col2, '</th>', "\n";
	if($col3 !== null){
	echo '<th>', $col3, '</th>';
	}
	echo '</tr>', "\n";
}

/**
 * @param string $col1
 * @param string $col2
 * @param string $col3
 * @return void
 */
function printTableRow($col1, $col2, $col3 = null) {
	echo '<tr>',
		 '<td>', $col1, '</td>', "\n",
		 '<td>', $col2, '</td>', "\n";
	if($col3 !== null){
	echo '<td>', $col3, '</td>';
	}
	echo '</tr>', "\n";
}

/**
 * @return void
 */
function printTableEnd() {
	echo '</table>',"\n";
}

/**
 * @param array $labels
 * @return void
 */
function printLabels($labels) {
	if(count($labels) === 0){
		return;
	}
	printTableHeader('topic/label', 'length');
	foreach ($labels as $label) {
		if(strpos($label, ' ') === false){
			$label_for_print = 'label="' . $label . '"';
		} else {
			$label_for_print = $label;
		}
		printTableRow($label_for_print, strlen($label));
	}
	printTableEnd();
}