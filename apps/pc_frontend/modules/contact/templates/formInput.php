<?php

$options = array();
$options['url'] = url_for('contact/form');
$options['button'] = __('Confirm');
$options['title'] = __('Contact form');

op_include_form('ContactForm', $form, $options);