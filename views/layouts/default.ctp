<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<?php echo $html->charset('ISO-8859-1'); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php echo $html->css('/phprop/css/phprop');?>
	<?php echo $javascript->link(array('/phprop/js/ckeditor/ckeditor', '/phprop/js/nano-v1.0', '/phprop/js/nano.browser', '/phprop/js/nano.ajax', '/phprop/js/nano.tabs', '/phprop/js/nano.tooltip', '/phprop/js/nano.dialog', '/phprop/js/nano.ckeditor', '/phprop/js/nano.datatable', '/phprop/js/phprop')); ?>
	<?php echo $scripts_for_layout;	?>
</head>
<body>
	<?php $session->flash(); ?>
	<?php echo $content_for_layout; ?>
	<?php echo $cakeDebug; ?>
</body>
</html>