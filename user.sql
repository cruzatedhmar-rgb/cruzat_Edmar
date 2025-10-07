-- Step 1: Create the user table with correct structure
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step 2: Insert the default admin user with properly hashed password
-- Username: admin, Password: admin123
INSERT INTO `user` (`username`, `email`, `password`, `created_at`, `updated_at`) VALUES 
('admin', 'admin@example.com', '$2y$10$lLCpKshZHybh.dtHkdijlefPM/jNofrpgVCUrwjKfhwB6H/brnBB.', NOW(), NOW());
