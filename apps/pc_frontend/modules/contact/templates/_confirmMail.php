<?php echo __('Thank you for your request. This is confirmation.'); ?>


<?php foreach($form as $name => $field): ?>
<?php if($name!='_csrf_token'): ?>
<?php echo $field->renderLabelName(); ?>:
<?php echo $form->getValue($name)."\r\r"; ?>
<?php endif; ?>
<?php endforeach; ?>