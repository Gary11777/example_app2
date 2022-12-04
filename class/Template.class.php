<?php

declare(strict_types=1);

class Template
{
    private $template;
    private $form_data = "";
    private $error_message = "";

    public function setMainTemplate(string
                                    $main_template_filename):
    void
    {
        if (!is_file($main_template_filename)) {
            throw new Exception('Main template [' .
                $main_template_filename . '] not found.');
        }

        $this->template = file_get_contents
        ($main_template_filename);
    }

    public function putFormData(array $formData) : void
    {
        foreach ($formData as $row) {
                $this->form_data .= "<tr><td>{$row['fd_id']}</a></td><td>{$row['fd_name']}</a></td><td>{$row['fd_email']}</td><td>{$row['fd_message']}</td><td>{$row['fd_create_date']}</td></tr>";
        }
    }

    public function putErrorMessage(string $error_message) : void
    {
        $this->error_message = $error_message;
    }

    public function processTemplate(): void
    {
        while (preg_match("/{FORMDATA}/Ui", $this->template) || preg_match("/{LOGERROR}/Ui", $this->template)) {
            $this->template = preg_replace(
                "/{FORMDATA}/Ui",
                $this->form_data,
                $this->template
            );
            $this->template = preg_replace(
                "/{LOGERROR}/Ui",
                $this->error_message,
                $this->template
            );
        }
    }

    public function getFinalPage(bool $remove_comments = true, bool $compress = true): string
    {
        $temp = $this->template;
        if ($remove_comments == true) {
            $temp = preg_replace("/<!--.*-->/sU", "", $temp);
        }

        // TODO: Maybe change to regexes?
        if ($compress == true) {
            while (strpos($temp, '  ') !== false) {
                $temp = str_replace('  ', ' ', $temp);
            }

            while (strpos($temp, "\r\r") !== false) {
                $temp = str_replace("\r\r", "\r", $temp);
            }

            while (strpos($temp, "\n\n") !== false) {
                $temp = str_replace("\n\n", "\n", $temp);
            }

            while (strpos($temp, "\r\n\r\n") !== false) {
                $temp = str_replace("\r\n\r\n", "\r\n", $temp);
            }
        }

        return $temp;
    }

}