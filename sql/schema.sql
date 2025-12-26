CREATE DATABASE IF NOT EXISTS museo_prehistorico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE museo_prehistorico;

CREATE TABLE IF NOT EXISTS reservations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    visit_date DATE NOT NULL,
    num_people VARCHAR(50) NOT NULL,
    tour_type VARCHAR(100) NOT NULL,
    payment_method VARCHAR(20) NOT NULL,
    accessibility_wheelchair TINYINT(1) NOT NULL DEFAULT 0,
    accessibility_sign_language TINYINT(1) NOT NULL DEFAULT 0,
    accessibility_visual_impairment TINYINT(1) NOT NULL DEFAULT 0,
    accessibility_autism TINYINT(1) NOT NULL DEFAULT 0,
    accessibility_senior TINYINT(1) NOT NULL DEFAULT 0,
    accessibility_cognitive TINYINT(1) NOT NULL DEFAULT 0,
    special_notes TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
