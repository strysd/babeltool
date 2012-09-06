<?php
require_once 'chk_var.php';
require_once 'chk_common.php';
require_once 'db_con.php';

$basePath = $targetPath;
$files = scanFile($basePath);
$engTexts = array();

foreach ($files as $file) {
	$retTexts = parseFile($file);
	$engTexts = array_merge($engTexts, $retTexts);
}

sort($engTexts, SORT_STRING);
$engTexts = array_unique($engTexts, SORT_STRING);

printCandidate($engTexts, $languageId);
mysql_close();

/**
 * @param string $file
 * @return array translatable texts in the file
 * @see chk_xmltexts.php
 */
function parseFile($file){
	$contents = file_get_contents($file);
	$xml = simplexml_load_string( $contents , 'SimpleXMLElement', LIBXML_NOBLANKS );
	$texts = array();

	$isPlugin = $xml->xpath('/plugin');
	if(count($isPlugin) > 0){
		return array();
	}

	$isProject = $xml->xpath('/project');
	if(count($isProject) > 0){
		return array();
	}

	$isToc = $xml->xpath('/toc');
	if(count($isToc) > 0){
		//toc title
		$texts[] = $isToc['0']['label'];
		//various levels exist for topic
		foreach ($xml->xpath('//topic') as $topic){
			$texts[] = $topic['label'];
		}
		return $texts;
	}

	$isContextHelp = $xml->xpath('/contexts');
	if(count($isContextHelp) > 0){

		foreach ($xml->xpath('/contexts/context') as $context){
			$texts[] = (string)$context->description;
		}

		foreach ($xml->xpath('/contexts/context/topic') as $topic){
			$texts[] = $topic['label'];
		}
		return $texts;
	}

	$isCheatsheet = $xml->xpath('/cheatsheet');
	if(count($isCheatsheet) > 0){

		foreach ($xml->xpath('/cheatsheet') as $cheatsheet){
			$texts[] = $cheatsheet['title'];
		}

		foreach ($xml->xpath('/cheatsheet/item') as $item){
			$texts[] = $item['title'];
		}

		return $texts;
	}

	$isComposite = $xml->xpath('/compositeCheatsheet');
	if(count($isComposite) > 0){
		$texts[] = $isComposite['0']['name'];

		foreach ($xml->xpath('/compositeCheatsheet/taskGroup') as $taskGroup){
			$texts[] = $taskGroup['name'];
		}

		foreach ($xml->xpath('/compositeCheatsheet/taskGroup/task') as $task){
			$texts[] = $task['name'];
		}

		return $texts;
	}

	return array();
}

/**
 * @param array $engTexts
 * @param integer $languageId
 * @return void
 */
function printCandidate($engTexts, $languageId) {
	$in_param = implode('","', $engTexts);

	$sql= ' SELECT distinct s.value as s_val, t.value as t_val '
		. ' from strings As s inner join translations AS t '
		. ' on s.string_id = t.string_id '
		. ' where s.value IN ("' . $in_param . '") '
	//in my dev.
	//  . ' and t.language_id = "' . $languageId . '" and t.is_active ';
		. ' and s.value <> BINARY t.value '
		. ' order by 1, 2';
	$result = mysql_query($sql);
	if(!$result){
		echo 'sql execution error:', mysql_error();
		return;
	}

	printTableHeader('English', 'length', 'Translation candidate');
	while($row = mysql_fetch_row($result)){
		//if not contains space, adds attribute name.
		if(strpos($row[0], ' ') === false){
			$text = 'label="' . $row[0] . '"';
			$candidate = 'label="' . $row[1] . '"';
		} else {
			$text = $row[0];
			$candidate = $row[1];
		}
		printTableRow($text, strlen($row[0]), $candidate);
	}
	printTableEnd();
}