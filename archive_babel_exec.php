<?php
require_once 'archive_var_define.php';
ini_set('max_execution_time', $maxExecutionTime);
ini_set('memory_limit', $memoryLimit);

global $db_con;
$db_con = mysql_connect($dbIp, $dbUser, $dbPassword);
if(!$db_con){
    echo 'connection error:', mysql_error();
    exit;
}

if(!mysql_select_db($dbName, $db_con)){
    echo 'selection error:', mysql_error();
    mysql_close($db_con);
    exit;
}

//mysql_set_charset($dbEncoding);

/**
 * @param int $f_id
 * @param boolean $move_inactive
 * @param array $minimum_project_version
 * @return boolean
 */
function is_older_file($f_id, $move_inactive, $minimum_project_version){

	$q = " select project_id, version, is_active " .
		" from files where file_id = '" . $f_id . "' ";
	$result = mysql_query($q);
	if(!$result){
		return false;
	}

	$row = mysql_fetch_row($result);
	if ($row === false) {
		return false;
	}

	$p_id = $row[0];
	$p_version = $row[1];
	$f_active  = $row[2];

	if ($f_active == 0 && $move_inactive == 1) {
		return true;
	}

    if (array_key_exists($p_id, $minimum_project_version) === false){
        return false;
    }

    $min_ver = explode('.', $minimum_project_version[$p_id], 3);
    $checked_ver = explode('.', $p_version, 3);
    if($checked_ver[2] === 'x'){//if 0.8.x, use as 0.8.999
        $checked_ver[2] = '999';
    }
    if       ((int)$checked_ver[0] < (int)$min_ver[0]){
        return true;
    } elseif ((int)$checked_ver[0] > (int)$min_ver[0]){
        return false;
    } elseif ((int)$checked_ver[1] < (int)$min_ver[1]){
        return true;
    } elseif ((int)$checked_ver[1] > (int)$min_ver[1]){
        return false;
    } elseif ((int)$checked_ver[2] < (int)$min_ver[2]){
        return true;
    }
    return true;//if $checked_ver[2] >= (int)$min_ver[2]
}

/* main */

$sql_main= " SELECT " .
" t.translation_id, t.string_id, s.file_id, " .
" t.is_active, s.is_active  " .
" FROM translations t inner join strings s " .
" ON   t.string_id = s.string_id " .
" ORDER BY 2 " .
" LIMIT " . $dbStart . " , " . $dbLimit . " ";

$result_main = mysql_query($sql_main);
if(!$result_main){
    echo 'main sql execution error:', mysql_error();
    mysql_close($db_con);
    exit;
}

$prev_s_id = -999;//dummy id at start
$prev_f_id = -999;//dummy id at start
$flg_move_file = 0;
$move_t_ids = array();
$move_s_ids = array();
$move_f_ids = array();

while($row_main = mysql_fetch_row($result_main)){
    $t_id = $row_main[0];
    $s_id = $row_main[1];
    $f_id = $row_main[2];
    $t_active = $row_main[3];
    $s_active = $row_main[4];
    $flg_move_trans = 0;
    $flg_move_str = 0;
    if ($t_active == 0 && $move_inactive == 1) {
        $flg_move_trans = 1;
    }
    if ($s_active == 0 && $move_inactive == 1) {
    	$flg_move_trans = 1;
    	$flg_move_str   = 1;
    }
    if ($prev_f_id !== $f_id) {
        $prev_f_id   = $f_id;
        if (is_older_file($f_id, $move_inactive, $minimum_project_version)) {
        	$flg_move_file = 1;
        	$move_f_ids[] = $f_id;
        } else {
        	$flg_move_file = 0;
        }
    }
    if ($flg_move_file == 1) {
    	$flg_move_trans = 1;
    	$flg_move_str   = 1;
    }

    if ($flg_move_trans === 1){
        $move_t_ids[] = $t_id;
    }

    /** under consideration because of foreign key when deleting
    if ($flg_move_str   === 1){
    	if ($prev_s_id  !== $s_id) {
    		$prev_s_id    = $s_id;
    		$move_s_ids[] = $s_id;
    	}
    }
    * under consideration */

}

$move_t_id_list = implode(',', $move_t_ids);

$q_ins = " INSERT INTO `old_translations` " .
		" (`translation_id`, `string_id`, `language_id`, `version`, `value`, `possibly_incorrect`, `is_active`, `userid`, `created_on`) " .
  " select `translation_id`, `string_id`, `language_id`, `version`, `value`, `possibly_incorrect`, `is_active`, `userid`, `created_on` " .
	" from `translations` where `translation_id` in (" . $move_t_id_list . ") ";
$result_q_ins = mysql_query($q_ins);
if(!$result_q_ins){
	echo "error coping to old_translations:", mysql_error(), "<BR>";
} else {
	$q_del = " DELETE FROM `translations` where `translation_id` in (" . $move_t_id_list . ") ";
	$result_q_del = mysql_query($q_del);
	if(!$result_q_del){
		echo "error deleting translations:", mysql_error(), "<BR>";
	}
}

/** under consideration because of foreign key when deleting
$move_s_id_list = implode(',', array_unique($move_s_ids));
$move_f_id_list = implode(',', $move_f_ids);

$q_ins = " INSERT INTO `old_strings` " .
		" (`string_id`, `file_id`, `name`, `value`, `userid`, `created_on`, `is_active`, `non_translatable`) " .
  " select `string_id`, `file_id`, `name`, `value`, `userid`, `created_on`, `is_active`, `non_translatable` " .
	" from `strings` where `string_id` in (" . $move_s_id_list . ") ";
$result_q_ins = mysql_query($q_ins);
if(!$result_q_ins){
	echo "error coping to old_strings:", mysql_error(), "<BR>";
} else {
	$q_del = " DELETE FROM `strings` where `string_id` in (" . $move_s_id_list . ") ";
	$result_q_del = mysql_query($q_del);
	if(!$result_q_del){
		echo "error deleting strings:", mysql_error(), "<BR>";
	}
}

$q_ins = " INSERT INTO `old_files` " .
		" (`file_id`, `project_id`, `plugin_id`, `version`, `name`, `is_active`) " .
  " select `file_id`, `project_id`, `plugin_id`, `version`, `name`, `is_active` " .
	" from `files` where `file_id` in (" . $move_f_id_list . ") ";
$result_q_ins = mysql_query($q_ins);

$q_ins_p = " INSERT INTO `old_file_progress` " .
		" (`file_id`, `language_id`, `pct_complete`) " .
  " select `file_id`, `language_id`, `pct_complete` " .
	" from `file_progress` where `file_id` in (" . $move_f_id_list . ") ";
$result_q_ins_p = mysql_query($q_ins_p);

if(!$result_q_ins || !$result_q_ins_p){
	echo "error coping to old_files:", mysql_error(), "<BR>";
} else {
	$q_del_p = " DELETE FROM `file_progress` where `file_id` in (" . $move_f_id_list . ") ";
	$result_q_del_p = mysql_query($q_del_p);

	$q_del   = " DELETE FROM `files` where `file_id` in (" . $move_f_id_list . ") ";
	$result_q_del = mysql_query($q_del);
	if(!$result_q_del || !$result_q_del_p ){
		echo "error deleting files:", mysql_error(), "<BR>";
	}
}
* under consideration */

mysql_close($db_con);
echo '*end*  memory peak:', memory_get_peak_usage();