ALTER TABLE `mandator` ADD `offer_id` INT(1) NULL DEFAULT NULL AFTER `b_id`;
ALTER TABLE `mandator` CHANGE `b_id` `bill_id` TINYINT(1) NULL DEFAULT NULL COMMENT 'own bill id yes/no';

ALTER TABLE `mandator` CHANGE `bill_id` `own_bill_numbers` TINYINT(1) NULL DEFAULT NULL COMMENT 'own bill numbers yes/no', CHANGE `offer_id` `own_offer_numbers` TINYINT(1) NULL DEFAULT NULL COMMENT 'own offer numbers yes/no', CHANGE `c_id` `own_customer_numbers` TINYINT(1) NULL DEFAULT NULL COMMENT 'own customer numbers yes/no';


ALTER TABLE `bill` CHANGE `billing_number` `bill_number` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 
