-- Active: 1717792307461@@127.0.0.1@3307@arcadia_zoo


CREATE TABLE `alimentation_jour` (
  `id` int(11) NOT NULL,
  `nourriture` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `quantite` varchar(255) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `commentaire` longtext NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `habitat` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `habitat_animal` (
  `habitat_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `rapport_animal` (
  `id` int(11) NOT NULL,
  `etat` longtext NOT NULL,
  `nourriturepropose` varchar(255) NOT NULL,
  `grammage_nourriture` varchar(255) NOT NULL,
  `date_passage` date NOT NULL,
  `detail_etat_animal` longtext DEFAULT NULL,
  `animal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `rapport_habitat` (
  `id` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `alimentation_jour`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_623E23898E962C16` (`animal_id`),
  ADD KEY `IDX_623E2389A76ED395` (`user_id`);

ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AAB231FAFFE2D26` (`habitat_id`);

ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F91ABF0A76ED395` (`user_id`),
  ADD KEY `IDX_8F91ABF08E962C16` (`animal_id`);

ALTER TABLE `habitat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `habitat_animal`
  ADD PRIMARY KEY (`habitat_id`,`animal_id`),
  ADD KEY `IDX_C0FE85A4AFFE2D26` (`habitat_id`),
  ADD KEY `IDX_C0FE85A48E962C16` (`animal_id`);

ALTER TABLE `rapport_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE0EED58E962C16` (`animal_id`),
  ADD KEY `IDX_BE0EED5A76ED395` (`user_id`);

ALTER TABLE `rapport_habitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_40E7D28BAFFE2D26` (`habitat_id`),
  ADD KEY `IDX_40E7D28BA76ED395` (`user_id`);

ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);


ALTER TABLE `alimentation_jour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `habitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `rapport_animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `rapport_habitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `alimentation_jour`
  ADD CONSTRAINT `FK_623E23898E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_623E2389A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6AAB231FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`);

ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF08E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `habitat_animal`
  ADD CONSTRAINT `FK_C0FE85A48E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C0FE85A4AFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`) ON DELETE CASCADE;

ALTER TABLE `rapport_animal`
  ADD CONSTRAINT `FK_BE0EED58E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_BE0EED5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `rapport_habitat`
  ADD CONSTRAINT `FK_40E7D28BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_40E7D28BAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`);
COMMIT;