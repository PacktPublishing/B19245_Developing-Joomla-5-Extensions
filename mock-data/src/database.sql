CREATE TABLE IF NOT EXISTS `#__spm_projects` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) NOT NULL,
	`description` TEXT,
	`deadline` DATETIME,
	`category` INT(11),
    `id_customer` INT(11),
	`created` Timestamp DEFAULT NOW(),
	`modified` Timestamp DEFAULT NOW(),
	`created_by` INT(11)  NOT NULL ,
	`modified_by` INT(11)  NOT NULL ,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__spm_tasks` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL,
	`alias` VARCHAR(255) NOT NULL,
	`description` TEXT,
	`deadline` DATETIME,
	`state` INT(3) NOT NULL,
	`project` INT(11),
	`created` Timestamp DEFAULT NOW(),
	`modified` Timestamp DEFAULT NOW(),
	`created_by` INT(11)  NOT NULL ,
	`modified_by` INT(11)  NOT NULL ,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__spm_customers` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`firstname` VARCHAR(255) NOT NULL,
	`lastname` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`company_name` VARCHAR(255) NOT NULL,
	`company_id` VARCHAR(255) NOT NULL,
	`company_address` VARCHAR(255) NOT NULL,
	`phone` VARCHAR(25) NOT NULL,
	`user` INT(11),
	`created` Timestamp DEFAULT NOW(),
	`modified` Timestamp DEFAULT NOW(),
	`created_by` INT(11)  NOT NULL ,
	`modified_by` INT(11)  NOT NULL ,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__spm_invoices` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`items` TEXT NOT NULL,
	`number` VARCHAR(25) NOT NULL,
	`amount` FLOAT DEFAULT 0.0,
	`customer` INT(11),
	`created` Timestamp DEFAULT NOW(),
	`modified` Timestamp DEFAULT NOW(),
	`created_by` INT(11)  NOT NULL ,
	`modified_by` INT(11)  NOT NULL ,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB;

