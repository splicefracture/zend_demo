
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- restaurant
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `restaurant`;

CREATE TABLE `restaurant`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `cuisine_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`,`cuisine_id`),
    UNIQUE INDEX `restaurant_index` (`id`, `name`),
    INDEX `restaurant_FI_1` (`cuisine_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- cuisine
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cuisine`;

CREATE TABLE `cuisine`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `cuisine_index` (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
