-- create_tables.sql
-- Jalankan ini di MySQL untuk membuat tabel yang diperlukan.

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS remember_tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  selector VARCHAR(32) NOT NULL UNIQUE,
  token_hash VARCHAR(255) NOT NULL,
  user_id INT NOT NULL,
  expires DATETIME NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- NOTE:
-- Untuk menambahkan user uji, gunakan `create_user.php` (direkomendasikan),
-- atau masukkan manual dengan password hash dari PHP:
-- php -r "echo password_hash('secret123', PASSWORD_DEFAULT).PHP_EOL;"
