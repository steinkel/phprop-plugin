<div id="phprop-box">
<?php 
echo $form->create('Phprop');?>
<fieldset>
<table>
<?php echo $form->input('key',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'),array('class'=>'required'));?>
<tr><td>is HTML</td><td>
<?php echo $form->checkbox('isHTML');?></td></tr>

<tr><td>isTranslated</td><td><?php 
echo $form->checkbox('isTranslated');?></td></tr>
<?php 
echo $form->input('defaultValue',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'),array('class'=>'required'));?>
</table>
<?php echo $form->end('Add');

?>

</fieldset>

</div>
	