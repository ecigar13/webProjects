CREATE TABLE `HW4`.`Book` ( `Book_id` INT NOT NULL , `Title` VARCHAR(40) NOT NULL , `Year` INT NOT NULL , `Price` INT NOT NULL , `Category` VARCHAR(20) NOT NULL , PRIMARY KEY (`Book_id`)) ENGINE = InnoDB;

CREATE TABLE `HW4`.`Authors` ( `Author_id` INT NOT NULL , `Author_Name` VARCHAR(40) NOT NULL , PRIMARY KEY (`Author_id`)) ENGINE = InnoDB;

CREATE TABLE `HW4`.`Book_Authors` ( `Book_id` INT NOT NULL , `Author_id` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `Book` ADD INDEX(`Book_id`);
ALTER TABLE `Authors` ADD INDEX(`Author_id`);

ALTER TABLE `Book_Authors` ADD FOREIGN KEY (`Book_id`) REFERENCES `Book`(`Book_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `Book_Authors` ADD FOREIGN KEY (`Author_id`) REFERENCES `Authors`(`Author_id`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `Book` (`Book_id`, `Title`, `Year`, `Price`, `Category`) VALUES ('1', 'Everyday Italian', '2005', '30.00', 'cooking');
INSERT INTO `Book` (`Book_id`, `Title`, `Year`, `Price`, `Category`) VALUES ('2', 'Harry Potter', '2005', '30.00', 'children');
INSERT INTO `Book` (`Book_id`, `Title`, `Year`, `Price`, `Category`) VALUES ('3', 'XQuery Kick Start', '2003', '49.99', 'web');
INSERT INTO `Book` (`Book_id`, `Title`, `Year`, `Price`, `Category`) VALUES ('4', 'Learning XML', '2003', '39.95', 'web');

INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('1', 'Giada De Laurentiis');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('2', 'J K. Rowling');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('3', 'James McGovern');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('4', 'Per Bothner');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('5', 'Kurt Cagle');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('6', 'James Linn');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('7', 'Vaidyanathan Nagarajan');
INSERT INTO `Authors` (`Author_id`, `Author_Name`) VALUES ('8', 'Erik T. Ray');

INSERT INTO `Book_Authors` (`Book_id`, `Author_id`) VALUES ('1', '1'), ('2', '2');
INSERT INTO `Book_Authors` (`Book_id`, `Author_id`) VALUES ('3', '3'), ('3', '4');
INSERT INTO `Book_Authors` (`Book_id`, `Author_id`) VALUES ('3', '5'), ('3', '6');
INSERT INTO `Book_Authors` (`Book_id`, `Author_id`) VALUES ('3', '7'), ('4', '8');
