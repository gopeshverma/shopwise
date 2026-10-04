CREATE DATABASE IF NOT EXISTS shopwise CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopwise;

-- USERS
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PRODUCTS
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  category VARCHAR(60) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image VARCHAR(255) DEFAULT 'assets/placeholder.png',
  short_desc VARCHAR(255) DEFAULT '',
  featured TINYINT(1) DEFAULT 0
);

-- seed sample products (add as many as you like)
INSERT INTO products (name, category, price, image, short_desc, featured) VALUES
('Wireless Headphones', 'Audio', 1999, 'assets/product1.jpg', 'Noise-cancelling, 24h battery', 1),
('Smartwatch', 'Wearables', 3499, 'assets/product2.jpg', 'Fitness tracking + HR monitor', 1),
('Bluetooth Speaker', 'Audio', 999, 'assets/product3.jpg', 'Deep bass, 10h playtime', 1),
('Power Bank 10k', 'Accessories', 1499, 'assets/product4.jpg', 'Fast charging, dual USB', 0),
('USB Type-C Cable', 'Accessories', 299, 'assets/product5.jpg', 'Durable, 1m braided', 0),
('Wireless Mouse', 'Accessories', 799, 'assets/product6.jpg', 'Ergonomic, 2.4GHz', 0),
('Laptop Backpack', 'Bags', 1799, 'assets/product7.jpg', 'Water resistant, 15.6"', 0),
('Gaming Keyboard', 'Accessories', 2199, 'assets/product8.jpg', 'Mechanical, RGB', 0),
('4K TV 43"', 'TV', 28999, 'assets/product9.jpg', 'Ultra HD, HDR10', 0),
('Smartphone Stand', 'Accessories', 199, 'assets/product10.jpg', 'Adjustable aluminium', 0);
