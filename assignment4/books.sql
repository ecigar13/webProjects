CREATE TABLE `HW4`.`Book` ( `Book_id` INT NOT NULL , `Title` VARCHAR(40) NOT NULL , `Year` INT NOT NULL , `Price` INT NOT NULL , `Category` VARCHAR(20) NOT NULL , PRIMARY KEY (`Book_id`)) ENGINE = InnoDB;

CREATE TABLE `HW4`.`Authors` ( `Author_id` INT NOT NULL , `Author_Name` VARCHAR(40) NOT NULL , PRIMARY KEY (`Author_id`)) ENGINE = InnoDB;

CREATE TABLE `HW4`.`Book_Authors` ( `Book_id` INT NOT NULL , `Author_id` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `Book` ADD INDEX(`Book_id`);
ALTER TABLE `Authors` ADD INDEX(`Author_id`);

ALTER TABLE `Book_Authors` ADD FOREIGN KEY (`Book_id`) REFERENCES `Book`(`Book_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `Book_Authors` ADD FOREIGN KEY (`Author_id`) REFERENCES `Authors`(`Author_id`) ON DELETE CASCADE ON UPDATE CASCADE;