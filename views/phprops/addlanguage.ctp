<div id="phprop-box">
<?php 
echo $form->create('Phprop');?>
<fieldset>
<table><tr><td>
<?php echo $form->input('id',array('before' => '<tr><td>',    'after' => '</td><td><p>For Example : en_UK</p></td></tr>',    'between' => '</td><td>'));?>
<?php 
echo $form->input('Value',array('before' => '<tr><td>',    'after' => '</td><td><p>For Example : English</p></td></tr>',    'between' => '</td><td>'));?>
</table>
<?php echo $form->end('Addlanguage');

?>

</fieldset>

</div>