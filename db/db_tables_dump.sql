/* Drop Tables */

DROP TABLE IF EXISTS `form_data` CASCADE;
DROP TABLE IF EXISTS `log_error` CASCADE;

/* Create Tables */

CREATE TABLE `form_data`
(
	`fd_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`fd_name` VARCHAR(150) NULL,
	`fd_email` VARCHAR(150) NULL,
	`fd_message` VARCHAR(250) NULL,
	`fd_create_date` DATE,
	PRIMARY KEY (`fd_id` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log_error`
(
	`le_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`le_message` VARCHAR(150) NULL,
	PRIMARY KEY (`le_id` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `log_error` (le_message) VALUES
        ('Имя должно содержать только буквы.'),
        ('Введите корректный адрес E-mail. Спасибо!'),
        ('Текст должен содержать только буквы, цифры и знаки препинания.');