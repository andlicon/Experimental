CREATE USER 'login'@'localhost' IDENTIFIED BY 'logger';
GRANT SELECT ON Experimental.usuario TO 'login'@'localhost';
SHOW GRANTS FOR 'login'@'localhost';

SELECT USER 
FROM mysql.user;