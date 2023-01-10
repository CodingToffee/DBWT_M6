CREATE TABLE `newsletter` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(10) NOT NULL,
                              `email` varchar(50) NOT NULL,
                              `sprache` varchar(1) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `besucher` (
    `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

