<?php slot('confirm'); ?>
<table>
<?php foreach($form as $name => $field): ?>
  <?php if($name!='_csrf_token'): ?>
    <tr>
      <th><?php echo $field->renderLabel(); ?></th>
      <td><?php echo $form->getValue($name); ?></td>
    </tr>
  <?php endif; ?>
<?php endforeach; ?>
</table>
<?php end_slot(); ?>

<?php

$options = array();
$options['yes_url'] = url_for('contact/send');
$options['no_url'] = url_for('contact/form');
$options['yes_button'] = __('Send');
$options['no_button'] = __('Back');
$options['body'] = get_slot('confirm');
$options['title'] = __('Confirmation to send request');

op_include_yesno('ContactConfirmForm', $csrfForm, $csrfForm, $options);