CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) UNIQUE NOT NULL,
  `password` varchar(60) NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `username`, `password`, `last_login`) VALUES
(1, 'Admin', '$2y$10$9X7LEGXVs9Cq8UeX69Y4BelCUI0cEBlUgyrBaCinQrVtea72VFblu', NULL),
(2, 'User 1', '$2y$10$9X7LEGXVs9Cq8UeX69Y4BelCUI0cEBlUgyrBaCinQrVtea72VFblu', NULL),
(3, 'User 2', '$2y$10$9X7LEGXVs9Cq8UeX69Y4BelCUI0cEBlUgyrBaCinQrVtea72VFblu', NULL),
(4, 'User 3', '$2y$10$9X7LEGXVs9Cq8UeX69Y4BelCUI0cEBlUgyrBaCinQrVtea72VFblu', NULL);


CREATE TABLE `groups`(
    `id` int AUTO_INCREMENT,
    `name` varchar(30) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `groups` VALUES
(1, 'Admin'),
(2, 'Szerkesztő'),
(3, 'Bejelentkezett felhasználó');

CREATE TABLE `users_groups` (
    `id` int AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `group_id` int NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);

INSERT INTO `users_groups` VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 2),
(5, 4, 3);


CREATE TABLE `login_attempts` (
  `id` int(11) AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
)