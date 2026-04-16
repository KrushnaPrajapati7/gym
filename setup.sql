CREATE DATABASE IF NOT EXISTS fitness_hub;
USE fitness_hub;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    membership_tier ENUM('None', 'Basic', 'Pro', 'Elite') DEFAULT 'None',
    height INT,
    weight DECIMAL(5,2),
    goal ENUM('Bulking', 'Cutting', 'Maintenance'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS equipment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    brand VARCHAR(100),
    total_count INT,
    in_use_count INT
);

CREATE TABLE IF NOT EXISTS diet_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category ENUM('Bulking', 'Cutting', 'Maintenance'),
    min_weight DECIMAL(5,2),
    max_weight DECIMAL(5,2),
    pdf_link VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    type ENUM('Whey', 'Creatine', 'Pre-workout', 'Other'),
    price DECIMAL(10,2),
    rating DECIMAL(3,1),
    reviews_count INT,
    image_url VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS trainers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    specialty VARCHAR(100),
    bio TEXT,
    image_url VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    trainer_id INT,
    start_time TIME,
    end_time TIME,
    day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
    FOREIGN KEY (trainer_id) REFERENCES trainers(id)
);

-- Clear existing seed data if any
DELETE FROM classes;
DELETE FROM trainers;
DELETE FROM products;
DELETE FROM diet_plans;
DELETE FROM equipment;

-- Seed Data
INSERT INTO equipment (name, brand, total_count, in_use_count) VALUES
('Squat Rack', 'Rogue Fitness', 4, 2),
('Bench Press', 'Hammer Strength', 5, 4),
('Treadmill', 'Life Fitness', 15, 12),
('Leg Press', 'Cybex', 2, 1),
('Cable Crossover', 'Life Fitness', 3, 3);

INSERT INTO diet_plans (category, min_weight, max_weight, pdf_link) VALUES
('Bulking', 50.0, 150.0, '/assets/pdfs/bulking_plan.pdf'),
('Cutting', 50.0, 150.0, '/assets/pdfs/cutting_plan.pdf'),
('Maintenance', 50.0, 150.0, '/assets/pdfs/maintenance_plan.pdf');

INSERT INTO products (name, type, price, rating, reviews_count, image_url) VALUES
('Gold Standard 100% Whey', 'Whey', 4999.00, 4.8, 1245, '/assets/images/whey.png'),
('C4 Pre-Workout Original', 'Pre-workout', 2499.00, 4.5, 876, '/assets/images/preworkout.png'),
('Platinum 100% Creatine', 'Creatine', 1699.00, 4.7, 543, '/assets/images/creatine.png');

INSERT INTO trainers (name, specialty, bio, image_url) VALUES
('John Doe', 'Powerlifting', '10 years of powerlifting experience. National record holder.', '/assets/images/trainer1.jpg'),
('Jane Smith', 'HIIT & Endurance', 'Certified crossfit coach and former marathon runner.', '/assets/images/trainer2.jpg');

INSERT INTO classes (name, trainer_id, start_time, end_time, day_of_week) VALUES
('Powerlifting 101', 1, '18:00', '19:00', 'Monday'),
('Morning HIIT', 2, '07:00', '08:00', 'Wednesday'),
('Advanced Lifters', 1, '19:00', '20:00', 'Friday');
