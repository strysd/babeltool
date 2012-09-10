<?php
/**
 * create new file that texts are replaced in "conv_in" directory
 * @param string $file name, not includes xml extension.
 * @param array $search texts
 * @param array $replace texts
 * @param integer $expected count. it will not create new file if 0.
 * @return boolean
 */
function replaceTexts($file, $search, $replace, $expected = 0) {
	$filepath = './conv_in/' . $file . '.xml';
	if (!is_file($filepath)){
		echo '<br>not exists :', $file;
		return false;
	}
	$writepath = './conv_out/' . $file . '.xml';
	if (is_file($writepath)){
		echo '<br>output already exists :', $file;
		return false;
	}
	try {
		$contents = file_get_contents ( $filepath );
	} catch ( Exception $e ) {
		echo '<br>read error :', $file;
		return false;
	}

	$count = 0;
	$contents = str_ireplace($search, $replace, $contents, &$count);

	if($expected === 0){
		echo '<br>count in :', $file, '<br>count    : ', $count;
	}
	if ($count === 0){
		echo '<br>no match in :', $file;
		return false;
	}
	if ($expected <> 0 && $count <> $expected) {
		echo '<br>different in :', $file, '<br>count    : ', $count;
		return false;
	}
	//Additional Changes
	$contents = str_replace (array('    '), array("\t"), $contents);

	try {
		file_put_contents ( $writepath, $contents );
	} catch (Exception $e) {
		echo '<br>write error :', $file;
		return false;
	}
	return true;
}