<?php
// setup.php - Run this once to create database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "unifest_db";

try {
    $conn = new mysqli($host, $user, $password);
    
    // Create database
    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
    $conn->select_db($dbname);
    
    // Create tables
    $tables = [
        "CREATE TABLE IF NOT EXISTS colleges (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            code VARCHAR(50) UNIQUE NOT NULL,
            username VARCHAR(100) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "CREATE TABLE IF NOT EXISTS competitions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            date DATE NOT NULL,
            time TIME NOT NULL,
            venue VARCHAR(255) NOT NULL,
            max_participants INT DEFAULT 50,
            status ENUM('open','closed') DEFAULT 'open',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            roll_number VARCHAR(100) NOT NULL,
            department VARCHAR(255),
            year VARCHAR(50),
            college_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (college_id) REFERENCES colleges(id) ON DELETE CASCADE
        )",
        
        "CREATE TABLE IF NOT EXISTS participants (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT NOT NULL,
            competition_id INT NOT NULL,
            status ENUM('pending','confirmed') DEFAULT 'pending',
            registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_participation (student_id, competition_id),
            FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
            FOREIGN KEY (competition_id) REFERENCES competitions(id) ON DELETE CASCADE
        )",
        
        "CREATE TABLE IF NOT EXISTS results (
            id INT AUTO_INCREMENT PRIMARY KEY,
            participant_id INT NOT NULL,
            marks DECIMAL(5,2),
            position INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (participant_id) REFERENCES participants(id) ON DELETE CASCADE
        )"
    ];
    
    foreach ($tables as $table) {
        $conn->query($table);
    }
    
    // Insert default data
    $conn->query("INSERT IGNORE INTO colleges (name, code, username, password_hash) VALUES 
        ('Admin College', 'ADMIN', 'admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "'),
        ('Saadiya Arts College', 'SAC', 'saadiya', '" . password_hash('college123', PASSWORD_DEFAULT) . "'),
        ('Mic College', 'MIC', 'mic', '" . password_hash('college123', PASSWORD_DEFAULT) . "')");
    
    $conn->query("INSERT IGNORE INTO competitions (name, description, date, time, venue, max_participants) VALUES 
        ('Battle of Bands', 'Music band competition', '2024-10-15', '16:00:00', 'Main Auditorium', 15),
        ('Code Marathon', 'Programming competition', '2024-10-16', '10:00:00', 'Computer Lab 3', 30),
        ('Drama Fest', 'Theatre competition', '2024-10-14', '18:00:00', 'Open Air Theatre', 10),
        ('Debate Championship', 'English Debate', '2024-10-15', '14:00:00', 'Seminar Hall 1', 20),
        ('Dance Off', 'Group Dance Competition', '2024-10-16', '19:00:00', 'Main Stage', 12)");
    
    echo "<div class='alert alert-success'>✅ Database setup completed successfully!</div>";
    echo "<p><strong>Admin Login:</strong> username: 'admin', password: 'admin123'</p>";
    echo "<a href='index.php' class='btn btn-primary'>Go to Website</a>";
    
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
?>
