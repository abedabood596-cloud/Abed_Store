CREATE DATABASE IF NOT EXISTS electronics_store;
USE electronics_store;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category_id INT NOT NULL,
    image VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('Pending', 'Processing', 'Completed', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO roles (role_name) VALUES ('Admin'), ('Customer');

INSERT INTO users (full_name, email, password, role_id) VALUES 
('Admin User', 'admin', '$2y$10$tkvmUaVRaa0UcejRCc0ED.hxCEhWouZXf6lB6qQdFWIuzK.oB2W.C', 1),
('Customer One', 'user', '$2y$10$ApFleufPJu2ARLpUCG.CZuHRvwJeNQ4.lpm1v2z/H4ASaZG8ZVX46', 2);


INSERT INTO categories (name, description) VALUES 
('Laptops', 'High performance laptops'),
('Smartphones', 'Latest mobile devices'),
('Accessories', 'Gadgets and accessories');

INSERT INTO products (name, description, price, stock, category_id, image) VALUES 
('MacBook Pro 14"', 'M2 Pro chip, 16GB RAM, 512GB SSD', 1999.99, 10, 1, 'macbook.png'),
('Dell XPS 13', 'Intel Core i7, 16GB RAM, 512GB SSD', 1299.99, 15, 1, 'dell.png'),
('iPhone 15 Pro', 'A17 Pro chip, Titanium build', 999.99, 20, 2, 'iphone.png'),
('Samsung Galaxy S24', 'AI features, excellent camera', 899.99, 25, 2, 'samsung.png'),
('AirPods Pro', 'Active Noise Cancellation', 249.99, 50, 3, 'airpods.png');
