<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2004 by Greg Gay, Joel Kronenberg & Heidi Hazelton*/
/* Adaptive Technology Resource Centre / University of Toronto			*/
/* http://atutor.ca														*/
/*																		*/
/* This program is free software. You can redistribute it and/or		*/
/* modify it under the terms of the GNU General Public License			*/
/* as published by the Free Software Foundation.						*/
/************************************************************************/
// $Id: course_footer.tmpl.php,v 1.14 2004/05/03 13:28:35 heidi Exp $


if (!defined('AT_INCLUDE_PATH')) { exit; }
	echo $tmpl_next_prev_links; ?>

	<div align="right" id="top">
		<small><br />
		<?php echo $tmpl_help_link; ?>

		<?php if ($tmpl_show_imgs): ?>
			<a href="<?php echo $_SERVER['REQUEST_URI']; ?>#course-content" title="<?php _AT('back_to_top'); ?> ALT-c"><img src="<?php echo $tmpl_base_path; ?>images/top.gif" alt="<?php _AT('back_to_top'); ?>" border="0" class="menuimage4" height="25" width="28"  /></a><br />
		<?php endif; ?>
		<?php if ($tmpl_show_seq_icons): ?>
			<a href="<?php echo $_SERVER['REQUEST_URI']; ?>#course-content" title="<?php _AT('back_to_top'); ?> ALT-c"><?php echo _AT('top'); ?></a>
		<?php endif; ?>
		&nbsp;&nbsp;</small>
	</div>

	</td>
	<?php if ($tmpl_right_menu_open): ?>
		<td width="20%" valign="top" rowspan="2" style="padding:5px">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" summary="">
			<tr>
				<td valign="top" class="dropdown-heading closed"><?php print_popup_help($tmpl_popup_help); 
				echo $tmpl_menu_url; ?>
				<small><a href="<?php echo $tmpl_close_menu_url; ?>" accesskey="6" title="<?php echo $tmpl_close_menus; ?> ALT-6"><?php echo $tmpl_close_menus; ?></a></small></td>
			</tr>
			<?php if(show_pen()): ?>
				<tr><td height="5"></td></tr>
				<tr>
					<td class="pen" valign="top">
						<?php print_popup_help(AT_HELP_EDITOR); ?><small><img src="<?php echo $tmpl_pen_image; ?>" alt="<?php echo _AT('editor'); ?>" /> <?php echo $tmpl_pen_link; ?></small>
					</td>
				</tr>
			<?php endif; ?>
			</table>
			<!-- dropdown menus -->
			<?php require(AT_INCLUDE_PATH.'html/dropdowns.inc.php'); ?>
			<!-- end dropdown menus -->
		</td>
	<?php endif; ?>
</tr>
</table>
<?php echo $tmpl_custom_copyright; ?>

<script src="<?php echo $tmpl_base_href; ?>jscripts/typetool/quickbuild.js" type="text/javascript"></script>

<?php
	if (isset($_POST[current_tab]) && ($_POST[current_tab] == 0) && $_POST['visual'] == 1) {
?>
	<script type="text/javascript"><!--
		myFunction();
		VISUAL=10;
	--></script>
<?php } ?>
