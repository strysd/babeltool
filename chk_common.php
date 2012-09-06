<?php
/**
 * lists xml files in the target path
 * @param string $dir target path
 * @return array xml files
 */
function scanFile($dir) {
	$dir = rtrim($dir, '/') . '/';
	$list = $tmp = array();
	foreach(glob($dir . '*', GLOB_ONLYDIR) as $childDir) {
		if ($tmp = scanFile($childDir)) {
			$list = array_merge($list, $tmp);
		}
	}

	foreach(glob($dir . '{*.xml}', GLOB_BRACE) as $xmlfiles) {
		$list[] = $xmlfiles;
	}

	return $list;
}

/**
 * prints table header
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
 * prints table row
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
 * prints table footer
 * @return void
 */
function printTableEnd() {
	echo '</table>',"\n";
}

