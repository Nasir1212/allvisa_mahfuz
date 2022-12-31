CREATE TABLE `create_page`(
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `heading` VARCHAR(255),
    `ref_no` VARCHAR(255),
    `date` VARCHAR(255),
    `text_field` text,
    `right_title` VARCHAR(255),
    `left_title` VARCHAR(255),
     `page__id` VARCHAR(255),

);

ALTER TABLE `create_page` ADD `heading_bottom`  VARCHAR(255);
ALTER TABLE `create_page` ADD `left_title_top`  VARCHAR(255), `right_title_top`  VARCHAR(255);
ALTER TABLE `create_page` ADD `right_title_top`  VARCHAR(255);