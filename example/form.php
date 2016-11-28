<?php
require('CForm.php');

$currentYear = date('Y');

$elements = array(
    'name' => array(
      'type'        => 'text',
      'label'       => 'Namn på kreditkort:',
      'required'    => true,
      'validation'  => array('not_empty')
    ),
    'address' => array(
      'type'        => 'text',
      'label'       => 'Adress:',
      'required'    => true,
      'validation'  => array('not_empty')
    ),
    'zip' => array(
      'type'        => 'text',
      'label'       => 'Postnummer (utan mellanslag):',
      'required'    => true,
      'validation'  => array('not_empty', 'numeric')
    ),
    'town' => array(
      'type'        => 'text',
      'label'       => 'Stad:',
      'required'    => true,
      'validation'  => array('not_empty')
    ),
    'country' => array(
        'type' => 'select',
        'label' => 'Land:',
        'options' => array(
            'se' => 'Sverige',
            'fi' => 'Finland',
            'dk' => 'Danmark',
            'no' => 'Norge',
            'ic' => 'Island',
        ),
        'validation' => array('not_empty')
    ),
    'cardtype' => array(
        'type' => 'select',
        'label' => 'Typ av kort:',
        'options' => array(
            'mastercard' => 'Mastercard',
            'visa' => 'VISA',
            'eurocard' => 'Eurocard',
            'amex' => 'American Express',
        ),
        'validation' => array('not_empty')
    ),
    'cardnumber' => array(
        'type' => 'text',
        'label' => 'Kortnummer:',
        'required' => true,
        'validation' => array('not_empty', 'numeric')
    ),
    'expmonth' => array(
        'type' => 'select',
        'label' => 'Månad:',
        'options' => array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12',
        ),
        'validation' => array('not_empty')
    ),
    'expyear' => array(
        'type' => 'select',
        'label' => 'År:',
        'options' => array(
            $currentYear    => $currentYear,
            ++$currentYear  => $currentYear,
            ++$currentYear  => $currentYear,
            ++$currentYear  => $currentYear,
            ++$currentYear  => $currentYear,
            ++$currentYear  => $currentYear,
        ),
        'validation' => array('not_empty')
    ),
    'cvc' => array(
        'type' => 'text',
        'label' => 'CVC:',
        'required' => true,
        'validation' => array('not_empty', 'numeric')
    ),
    'submit' => array(
        'type' => 'submit',
        'value' => 'Utför betalning',
        'callback' => function() {
            return true;
        }
    ),
);

$form = new CForm(array(), $elements);
