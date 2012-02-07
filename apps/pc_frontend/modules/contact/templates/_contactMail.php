<?php foreach($form as $name => $field): ?>
<?php if($name!='_csrf_token'): ?>
<?php echo $field->renderLabelName(); ?>:

<?php echo $form->getValue($name); ?>

<?php endif; ?>
<?php endforeach; ?>