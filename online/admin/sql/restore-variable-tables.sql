-- Online-ordering tables missing after sharma_kama recovery (tvariable exists; variable* did not).

CREATE TABLE IF NOT EXISTS `variable` (
  `variable_id` int(11) NOT NULL AUTO_INCREMENT,
  `variable_name_en` varchar(255) NOT NULL,
  `variable_name_nl` varchar(255) NOT NULL,
  `variable_description_en` text NOT NULL,
  `variable_description_nl` text NOT NULL,
  `variable_attrb_list` varchar(255) NOT NULL,
  `variable_status` varchar(9) NOT NULL DEFAULT 'Active',
  `type` int(11) NOT NULL DEFAULT 1,
  `option_type` int(11) NOT NULL,
  `required` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`variable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `variable`
SELECT * FROM `tvariable`
WHERE NOT EXISTS (SELECT 1 FROM `variable` LIMIT 1);

CREATE TABLE IF NOT EXISTS `variable-orde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varialbe_order` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `variable-orde` (`id`, `varialbe_order`)
SELECT 1, GROUP_CONCAT(`variable_id` ORDER BY `variable_id` SEPARATOR ',')
FROM `variable`
WHERE NOT EXISTS (SELECT 1 FROM `variable-orde` LIMIT 1);
