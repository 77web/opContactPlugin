<?php slot('submenu', get_partial('plugin/submenu')); ?>
<?php slot('title', __('opContactPlugin setting')); ?>

<form action="<?php echo url_for('opContactPlugin/setting'); ?>" method="post">
<table>
<?php echo $form; ?>
</table>
<input type="submit" value="<?php echo __('Save'); ?>" />
</form>