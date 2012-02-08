<?php foreach($form as $name => $field): ?>
<?php if($name!='_csrf_token'): ?>
<?php echo $field->renderLabelName(); ?>:
<?php echo $form->getValue($name)."\r\r"; ?>
<?php endif; ?>
<?php endforeach; ?>

--------------------------------------------------------------------------------
<?php echo __('Sent at'); ?>: <?php echo date('Y-m-d H:i:s'); ?>

<?php if((bool)opConfig::get('opContactPlugin_save_remote_addr', false)): ?>
<?php echo __('Remote host'); ?>: <?php echo gethostbyaddr($sf_request->getRemoteAddress()); ?>
<?php endif; ?>