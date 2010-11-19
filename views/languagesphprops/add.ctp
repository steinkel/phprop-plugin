<div id="phprop-box">
<?php 
echo $form->create('Languagesphprop');?>
<fieldset>
<table>

<?php echo $form->input('key',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'));?>
<?php echo $form->input('locale',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'));?>
<?php echo $form->input('hash',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'));?>
<?php echo $form->input('text',array('before' => '<tr><td>',    'after' => '</td></tr>',    'between' => '</td><td>'));?>

<tr><td>ACTIVE ?</td><td>
<?php echo $form->checkbox('active');?></td></tr>
</table>
<?php echo $form->end('Add');

?>

</fieldset>

</div>
	