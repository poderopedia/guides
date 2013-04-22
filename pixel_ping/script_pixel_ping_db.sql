delimiter $$

CREATE TABLE `pixel_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_key` varchar(255) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `datetime_ts` datetime DEFAULT NULL,
  `day_of_the_month` int(11) DEFAULT NULL,
  `month_of_the_year` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `week_of_the_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1$$

