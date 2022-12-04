<?php

declare(strict_types=1);

class MySQL
{

    public function putFormData(array $form_data) {
        try {
            $connection = new PDO('mysql:host=' . CONFIG_DB_HOST . '; dbname=' . CONFIG_DB_NAME . '; charset=' . CONFIG_DB_CHAR,
                CONFIG_DB_USER,
                CONFIG_DB_PASS,
                array( PDO::ATTR_PERSISTENT => false));

            $connection->exec("set names utf8");

            $query = $connection->prepare("INSERT INTO `form_data` (fd_name, fd_email, fd_message, fd_create_date) values (:name, :email, :message, CURRENT_DATE())");

            // Make request with Data of our Form
            $query->execute($form_data);

            // Close connection
            $connection = null;
        } catch (PDOException $e) {
            // If there is an error of connection or
            // request's  processing, show it
            print "Error: " . $e->getMessage() . "<br/>";
        }
    }

    public function getFormData() {
        try {
            $connection = new PDO('mysql:host=' . CONFIG_DB_HOST . '; dbname=' . CONFIG_DB_NAME . '; charset=' . CONFIG_DB_CHAR,
                CONFIG_DB_USER,
                CONFIG_DB_PASS,
                array( PDO::ATTR_PERSISTENT => false));

            $formData = [];

            foreach($connection->query('SELECT `fd_id`, `fd_name`, `fd_email`, `fd_message`, `fd_create_date` FROM form_data') as $row) {
                $formData[] = $row;
            }

            return $formData;

            // Close connection
            $connection = null;
        } catch (PDOException $e) {
            // If there is an error of connection or
            // request's  processing, show it
            print "Error (Data Base): " . $e->getMessage() .
                "<br/>";
        }
    }

    public function getErrorMessage(int $error_number) : string {
        try {
            $connection = new PDO('mysql:host=' . CONFIG_DB_HOST . '; dbname=' . CONFIG_DB_NAME . '; charset=' . CONFIG_DB_CHAR,
                CONFIG_DB_USER,
                CONFIG_DB_PASS,
                array( PDO::ATTR_PERSISTENT => false));
            $i=1;
            foreach($connection->query('SELECT `le_id`, `le_message` FROM log_error') as $row) {

                $error_message[$i] = $row;
                $i++;
            }

            return $error_message[$error_number][1];

            // Close connection
            $connection = null;
        } catch (PDOException $e) {
            // If there is an error of connection or
            // request's  processing, show it
            print "Error (Data Base): " . $e->getMessage() .
                "<br/>";
        }
    }
}