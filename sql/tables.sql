CREATE TABLE IF NOT EXISTS `games` (
  `name` varchar(255) NOT NULL,
  `rows` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `moves` (
  `name` varchar(255) NOT NULL,
  `move_id` varchar(255) NOT NULL,
  `player` int(11) NOT NULL,
  PRIMARY KEY (`name`, `move_id`, `player`)
) ENGINE=InnoDB;