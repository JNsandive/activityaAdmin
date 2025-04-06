-- Create database
CREATE DATABASE IF NOT EXISTS activehome;
USE activehome;

-- Create activities table
CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    benefits TEXT NOT NULL,
    price VARCHAR(100) NOT NULL
);

-- Create trainers table
CREATE TABLE IF NOT EXISTS trainers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    certifications VARCHAR(255) NOT NULL,
    years INT NOT NULL,
    specialization VARCHAR(255) NOT NULL
);

-- Insert sample activities data
INSERT INTO activities (name, description, benefits, price) VALUES
('Strength Training', 'Strength training involves using resistance to build muscle strength and endurance.', 'Builds muscle mass, improves bone density, boosts metabolism, enhances overall physical performance', 'From £50 per 45 minutes'),
('Yoga', 'Mind-body practice that combines physical postures, breathing exercises, and meditation.', 'Improves flexibility and balance, reduces stress', 'From £35 per 45 minutes'),
('Pilates', 'Low-impact exercise that focuses on strengthening muscles while improving postural alignment and flexibility.', 'Strengthens core muscles, improves posture, increases flexibility, aids in injury recovery', 'From £30 per 45 minutes');

-- Insert sample trainers data
INSERT INTO trainers (name, email, location, certifications, years, specialization) VALUES
('Mary Brown', 'mary@may.com', 'NW3 only', 'Level 3', 3, 'Fitness, Yoga'),
('James White', 'james@james.com', 'SW1 and online', 'Level 3', 5, 'Fitness, Strength Training'),
('Ann Blue', 'ann@ann.com', 'Online only', 'ISSA', 5, 'Pilates, Strength Training'),
('Peter Red', 'peter@peter.com', 'NW2, NW2, NW3', 'Level 3', 4, 'Pilates');


