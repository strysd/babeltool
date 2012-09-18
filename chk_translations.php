<?php
require_once 'chk_var.php';
require_once 'chk_common.php';

$basePath = $targetPath;
$myLanguage = $languageId;
$files = scanFile($basePath);
if($files === false){
	echo 'invalid path: ', $basePath;
	return;
}

$engTexts = array();

foreach ($files as $file) {
	$retTexts = parseFile($file);
	$engTexts = array_merge($engTexts, $retTexts);
}

$engTexts = array_unique($engTexts, SORT_STRING);

require_once 'db_con.php';
printCandidate($engTexts, $myLanguage);
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

	$isIndex = $xml->xpath('/index');
	if(count($isIndex) > 0){
		foreach ($xml->xpath('//topic') as $topic){
			$texts[] = $topic['title'];
		}
		return array();
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

	$sql= ' SELECT distinct length(s.value) as slen, s.value as sval, t.value as tval'
		. ' from strings As s inner join translations AS t'
		. ' on s.string_id = t.string_id'
		. ' where s.value IN ("' . getList($engTexts) . '")'
	//in my dev.
	//  . ' and t.language_id = "' . $languageId . '" and t.is_active';
		. ' and s.value <> BINARY t.value'
		. ' order by 1 DESC, 2 DESC, 3';//this order designed for replacing texts.
	$result = mysql_query($sql);
	if(!$result){
		echo 'sql execution error:', mysql_error();
		return;
	}

	$replaceBefore = array();
	$replaceAfter = array();

	printTableHeader('length', 'English', 'Translation candidate');
	while($row = mysql_fetch_row($result)){
		//if not contains space, adds attribute name.
		if(strpos($row[1], ' ') === false){
			$text = 'label="' . $row[1] . '"';
			$candidate = 'label="' . $row[2] . '"';
		} else {
			$text = $row[1];
			$candidate = $row[2];
		}
		printTableRow($row[0], $text, $candidate);

		$replaceBefore[] = $text;
		$replaceAfter[]  = $candidate;
	}
	printTableEnd();

	echo '<BR>', "\n",
		 'sample for str_replace()<BR>', "\n",
		 "'", implode("','", $replaceBefore), "'", '<BR><BR>', "\n\n",
		 "'", implode("','", $replaceAfter),  "'", '<BR>', "\n";
}

/**
 * @param array $values
 * @return string listed values.
 */
function getList($values) {
	$temp1 = array();
	$replace1 = array("\r\n" => '","', "\r" => '","', "\n" => '","',
					  '"'  => '","');
	$replace2 = array(',"",' => ',');

	foreach ($values as $value) {
		$temp1[] = strtr($value, $replace1);
	}
	$temp2 = implode('","', $temp1);
	$ret = strtr($temp2, $replace2);

	return $ret;
}