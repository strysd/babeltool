<?php
require_once 'chk_var.php';
require_once 'chk_common.php';

$basePath = $targetPath;
$files = scanFile($basePath);
if($files === false){
	echo 'invalid path: ', $basePath;
	return;
}

foreach ($files as $file) {
	parseFile($file);
	echo '<hr>', "\n";
}

/**
 * @param string $file
 * @return void
 */
function parseFile($file){
	$contents = file_get_contents($file);
	$xml = simplexml_load_string( $contents , 'SimpleXMLElement', LIBXML_NOBLANKS );

	//judges as unsupported file by root element
	$isPlugin = $xml->xpath('/plugin');
	if(count($isPlugin) > 0){
		printFileAttribute($file, 'plugin definition file is not supported');
		return;
	}

	$isProject = $xml->xpath('/project');
	if(count($isProject) > 0){
		printFileAttribute($file, 'Ant build file is not supported');
		return;
	}

	//judges as Table of Contents if root element is toc
	$isToc = $xml->xpath('/toc');
	if(count($isToc) > 0){
		printFileAttribute($file, 'Table of Contents');
		//toc title
		printLabel($isToc['0']['label']);
		//various levels exist for topic
		foreach ($xml->xpath('//topic') as $topic){
			printLabel($topic['label']);
		}
		return;
	}

	//judges as index if root element is index
	$isIndex = $xml->xpath('/index');
	if(count($isIndex) > 0){
		printFileAttribute($file, 'Index');
		foreach ($xml->xpath('//topic') as $topic){
			printLabel($topic['title']);
		}
		return;
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
			printLabel($topic['label']);
		}
		return;
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

		return;
	}

	//judges as Composite Cheat Sheet if compositecheatsheet element is in root
	$isComposite = $xml->xpath('/compositeCheatsheet');
	if(count($isComposite) > 0){
		printFileAttribute($file, 'Composite Cheat Sheet');

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

		//sheet name
		printLabel($isComposite['0']['name']);

		return;
	}

	//TODO introContent (in Git)

	printFileAttribute($file, 'unsupported');
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
 * @param string $label
 * @return void
 */
function printLabel($label) {
	echo '"', $label, '",', "\n";
}