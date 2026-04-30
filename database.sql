-- ============================================================
-- CI4 Student System — Database Setup
-- Run this in phpMyAdmin or MySQL CLI
-- ============================================================

CREATE DATABASE IF NOT EXISTS ci4_students
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE ci4_students;

-- ── Students table (with soft deletes) ──────────────────────
CREATE TABLE IF NOT EXISTS `students` (
    `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name`  VARCHAR(100)     NOT NULL,
    `last_name`   VARCHAR(100)     NOT NULL,
    `email`       VARCHAR(150)     NOT NULL,
    `course`      VARCHAR(100)     NOT NULL,
    `year_level`  TINYINT(1)       NOT NULL,
    `created_at`  DATETIME         DEFAULT NULL,
    `updated_at`  DATETIME         DEFAULT NULL,
    `deleted_at`  DATETIME         DEFAULT NULL,   -- soft delete column
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Sample Data ─────────────────────────────────────────────
INSERT INTO `students` (`first_name`, `last_name`, `email`, `course`, `year_level`, `created_at`, `updated_at`) VALUES
('Juan',      'dela Cruz',  'juan.delacruz@school.edu.ph',  'BSIT', 2, NOW(), NOW()),
('Maria',     'Santos',     'maria.santos@school.edu.ph',   'BSCS', 1, NOW(), NOW()),
('Jose',      'Reyes',      'jose.reyes@school.edu.ph',     'BSIS', 3, NOW(), NOW()),
('Ana',       'Garcia',     'ana.garcia@school.edu.ph',     'BSIT', 4, NOW(), NOW()),
('Pedro',     'Mendoza',    'pedro.mendoza@school.edu.ph',  'BSCpE',2, NOW(), NOW()),
('Rosa',      'Villanueva', 'rosa.v@school.edu.ph',         'BSBA', 1, NOW(), NOW()),
('Carlo',     'Aquino',     'carlo.aquino@school.edu.ph',   'BSIT', 3, NOW(), NOW()),
('Liza',      'Flores',     'liza.flores@school.edu.ph',    'BSED', 2, NOW(), NOW()),
('Miguel',    'Torres',     'miguel.torres@school.edu.ph',  'BSCE', 1, NOW(), NOW()),
('Carla',     'Bautista',   'carla.b@school.edu.ph',        'BSN',  4, NOW(), NOW()),
('Mark',      'Castillo',   'mark.castillo@school.edu.ph',  'BSIT', 2, NOW(), NOW()),
('Jenny',     'Lopez',      'jenny.lopez@school.edu.ph',    'BSCS', 3, NOW(), NOW());
