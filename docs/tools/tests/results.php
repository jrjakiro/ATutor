<?php
/****************************************************************/
/* ATutor														*/
/****************************************************************/
/* Copyright (c) 2002-2004 by Greg Gay & Joel Kronenberg        */
/* Adaptive Technology Resource Centre / University of Toronto  */
/* http://atutor.ca												*/
/*                                                              */
/* This program is free software. You can redistribute it and/or*/
/* modify it under the terms of the GNU General Public License  */
/* as published by the Free Software Foundation.				*/
/****************************************************************/

	define('AT_INCLUDE_PATH', '../../include/');
	require(AT_INCLUDE_PATH.'vitals.inc.php');
	$_section[0][0] = _AT('tools');
	$_section[0][1] = 'tools/';
	$_section[1][0] = _AT('test_manager');
	$_section[1][1] = 'tools/tests';
	$_section[2][0] = _AT('results');

	authenticate(AT_PRIV_TEST_MARK);

	require(AT_INCLUDE_PATH.'header.inc.php');

echo '<h2>';
	if ($_SESSION['prefs'][PREF_CONTENT_ICONS] != 2) {
		echo '<a href="tools/" class="hide"><img src="images/icons/default/square-large-tools.gif"  class="menuimageh2" border="0" vspace="2" width="42" height="40" alt="" /></a>';
	}
	if ($_SESSION['prefs'][PREF_CONTENT_ICONS] != 1) {
		echo ' <a href="tools/" class="hide">'._AT('tools').'</a>';
	}
echo '</h2>';

echo '<h3>';
	if ($_SESSION['prefs'][PREF_CONTENT_ICONS] != 2) {
		echo '&nbsp;<img src="images/icons/default/test-manager-large.gif"  class="menuimageh3" width="42" height="38" alt="" /> ';
	}
	if ($_SESSION['prefs'][PREF_CONTENT_ICONS] != 1) {
		echo '<a href="tools/tests/">'._AT('test_manager').'</a>';
	}
echo '</h3>';


	echo '<h3>'._AT('results_for').' '.$_GET['tt'].'</h3>';
	echo '<p><small>';
	if (isset($_GET['m'])) {
		echo '<a href="'.$PHP_SELF.'?tid='.$_GET['tid'].SEP.'tt='.$_GET['tt'].'">'._AT('show_marked_unmarked').'</a>';		
	} else {
		echo _AT('show_marked_unmarked');
	}

	echo ' | ';
	if ($_GET['m'] != 1) {
		echo '<a href="'.$PHP_SELF.'?tid='.$_GET['tid'].SEP.'tt='.$_GET['tt'].SEP.'m=1">'._AT('show_unmarked').'</a>';
	} else {
		echo _AT('show_unmarked');
	}
	echo ' | ';
	if ($_GET['m'] != 2){
		echo '<a href="'.$PHP_SELF.'?tid='.$_GET['tid'].SEP.'tt='.$_GET['tt'].SEP.'m=2">'._AT('show_marked').'</a>';
	} else {
		echo _AT('show_marked');
	}
	
	echo '</small></p>';
	
	$tid = intval($_GET['tid']);
	if ($_GET['m'] == 1) {
		$show = ' AND R.final_score=\'\'';
	} else if ($_GET['m'] == 2) {
		$show = ' AND R.final_score<>\'\'';
	} else {
		$show = '';
	}

	$sql	= "SELECT R.*, M.login FROM ".TABLE_PREFIX."tests_results R, ".TABLE_PREFIX."members M WHERE R.test_id=$tid AND R.member_id=M.member_id $show";
 	$result	= mysql_query($sql, $db);
	$num_results = mysql_num_rows($result);

	echo '<table cellspacing="1" cellpadding="0" border="0" class="bodyline" summary="" align="center" width="90%">';
	echo '<tr>';
	echo '<th scope="col"><small>'._AT('username').'</small></th>';
	echo '<th scope="col"><small>'._AT('date_taken').'</small></th>';
	echo '<th scope="col"><small>'._AT('mark').'</small></th>';
	echo '<th scope="col"><small>'._AT('view_mark_test').'</small></th>';
	echo '<th scope="col"><small>'._AT('delete').'</small></th>';
	echo '</tr>';

	if ($row = mysql_fetch_array($result)) {
		$count		 = 0;
		$total_score = 0;
		do {
			echo '<tr>';
			echo '<td class="row1"><small><strong>'.$row['login'].'</strong></small></td>';
			echo '<td class="row1"><small>'.AT_date('%j/%n/%y %G:%i', $row['date_taken'], AT_DATE_MYSQL_DATETIME).'</small></td>';

			echo '<td class="row1" align="center"><small>';
			if ($row['final_score'] != '') {
				echo $row['final_score'];
			} else {
				echo _AT('unmarked');
			}
			echo '</small></td>';


			echo '<td class="row1" align="center"><small><a href="tools/tests/view_results.php?tid='.$tid.SEP.'rid='.$row['result_id'].SEP.'tt='.$row['login'].SEP.'tt2='.$_GET['tt'].SEP.'m='.$_GET['m'].'">'._AT('view_mark_test').'</a></small></td>';

			echo '<td class="row1" align="center"><small><a href="tools/tests/delete_result.php?tid='.$tid.SEP.'tt2='.$_GET['tt'].SEP.'rid='.$row['result_id'].SEP.'tt='.$row['login'].SEP.'m='.$_GET['m'].'">'._AT('delete').'</a></small></td>';

			echo '</tr>';
			$count++;
			if ($count < $num_results) {
				echo '<tr><td height="1" class="row2" colspan="5"></td></tr>';
			}
		} while ($row = mysql_fetch_array($result));

	} else {
		echo '<tr><td colspan="5" class="row1"><small><em>'._AT('no_unmarked_results').'</em></small></td></tr>';
	}

	echo '</table>';

	require(AT_INCLUDE_PATH.'footer.inc.php');
?>
