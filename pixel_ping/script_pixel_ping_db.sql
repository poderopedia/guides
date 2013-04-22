delimiter $$

CREATE TABLE  `pixel_test`.`pixel_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_key` varchar(255) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `datetime_ts` datetime DEFAULT NULL,
  `day_of_the_month` int(11) DEFAULT NULL,
  `month_of_the_year` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `week_of_the_year` int(11) DEFAULT NULL,
  `date_day` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_day` (`day_of_the_month`),
  KEY `idx_month` (`month_of_the_year`),
  KEY `idx_year` (`year`),
  KEY `idx_week` (`week_of_the_year`),
  KEY `idx_date` (`date_day`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8$$

