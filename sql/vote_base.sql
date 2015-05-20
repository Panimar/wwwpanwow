CREATE TABLE  `imwcp`.`game_top` (
`id` INT( 3 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`link` VARCHAR( 250 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`cost` INT NOT NULL DEFAULT  '1'
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `imwcp`.`vote_var` (
`topid` INT NOT NULL ,
`accid` INT NOT NULL ,
`votetime` TIMESTAMP NOT NULL ,
UNIQUE (`topid` ,`accid`)
) ENGINE = MYISAM ;

CREATE TABLE `imwcp`.`log` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `uid` int(3) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `eventtime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE  `imwcp`.`ticket` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`topic` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`message` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`author` INT NOT NULL ,
`time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`read` TINYINT( 1 ) NOT NULL DEFAULT  '0'
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `imwcp`.`item_list` (
`item_id` INT NOT NULL ,
`name` VARCHAR( 50 ) NULL ,
`price` INT NOT NULL ,
PRIMARY KEY ( `item_id` )
) ENGINE = MYISAM ;
