<?php
  $receiving_email_address = 'service@wefixpoint.com';

  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = 'Request for a quote';

  // ✅ Zoho SMTP setup
  $contact->smtp = array(
    'host' => 'smtp.zoho.com',
    'username' => 'service@wefixpoint.com',
    'password' => 'Fixpoint@2025!!',
    'port' => '587'
  );

  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['phone'], 'Phone');
  isset($_POST['type']) && $contact->add_message($_POST['type'], 'Type');
  isset($_POST['timeline']) && $contact->add_message($_POST['timeline'], 'Timeline');
  isset($_POST['budget']) && $contact->add_message($_POST['budget'], 'Budget');
  $contact->add_message($_POST['message'], 'Message', 10);

  echo $contact->send();
?>

