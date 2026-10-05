-- Um banco e um usuário para cada serviço
CREATE DATABASE IF NOT EXISTS orders;
CREATE DATABASE IF NOT EXISTS payments;
CREATE DATABASE IF NOT EXISTS notifications;

CREATE USER IF NOT EXISTS 'orders'@'%' IDENTIFIED BY 'secret';
CREATE USER IF NOT EXISTS 'payments'@'%' IDENTIFIED BY 'secret';
CREATE USER IF NOT EXISTS 'notifications'@'%' IDENTIFIED BY 'secret';

-- Cada usuário só acessa o próprio banco
GRANT ALL PRIVILEGES ON orders.* TO 'orders'@'%';
GRANT ALL PRIVILEGES ON payments.* TO 'payments'@'%';
GRANT ALL PRIVILEGES ON notifications.* TO 'notifications'@'%';

FLUSH PRIVILEGES;