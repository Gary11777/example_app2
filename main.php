<?php

declare(strict_types=1);

// Autoload classes
spl_autoload_register('autoloader');
function autoloader(string $class_name): void
{
    require_once('class/' . $class_name . '.class.php');
}

$template_object = new Template();
$mysql_object = new MySQL();

// Load config file
require_once('config.php');

// Set template of page
$template_object->setMainTemplate('templates/main.tpl');


// +++++ MAIN LOGIC HERE +++++
// +++++++++++++++++++++++++++

// +++ If button "Submit" was tapped, send data to the Data Base
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['name']) && isset($_POST['email']) && isset
    ($_POST['message'])) {

    // If values of each form's row are correct, send these values to the Data Base
    if (!preg_match('/[[:alpha:]]{1,30}/is', $_POST['name'])) {
        $error_message = $mysql_object->getErrorMessage(1);
        $template_object->putErrorMessage($error_message);
        } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                    $error_message = $mysql_object->getErrorMessage(2);
                    $template_object->putErrorMessage($error_message);
            } elseif (!preg_match('/[[:alnum:]]*?[[:punct:]]*?[[:space:]]*?/im', $_POST['message'])) {
                        $error_message = $mysql_object->getErrorMessage(3);
                        $template_object->putErrorMessage($error_message);
                } else {
                        // Prepare array with data from our form
                        $form_data['name'] = $_POST['name'];
                        $form_data['email'] = $_POST['email'];
                        $form_data['message'] = $_POST['message'];

                        // Call method for sending Data from our Form to Data Base
                        $mysql_object->putFormData($form_data);

                        // Prevent double sending data from our Form
                        header('Location: index.php', true, 303);
                    }
    }
// --- If button "Submit" was tapped, send data to the Data Base
// -------------------------------------------------------------


// Get data from the Data Base
$formData = $mysql_object->getFormData();
$template_object->putFormData($formData);

// Prepare tamplate of page
$template_object->processTemplate();