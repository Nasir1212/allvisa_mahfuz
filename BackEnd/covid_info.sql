CREATE TABLE `covid_info`(
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `certificate_no` varchar(255),
    `nid_no` varchar(255),
    `passport_no` varchar(255),
    `nationality` varchar(255),
    `name` varchar(255),
    `date_of_birth` varchar(255),
    `gender` varchar(255),
    `dose_first` varchar(255),
    `dose_first_date` varchar(255),
    `dose_second` varchar(255),
    `dose_second_date` varchar(255),
    `dose_third` varchar(255),
    `dose_third_date` varchar(255),
    `total_dose` varchar(255),
    `center` varchar(255),
    `vaccinated_by` varchar(255)

);

ALTER TABLE `covid_info` ADD `uniq_id`  varchar(255)