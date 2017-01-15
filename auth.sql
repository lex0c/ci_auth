CREATE TABLE users (
    id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP

)ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO users(name, lastname, email, password, updated_at) VALUES ('Léo', 'Castro', 'leonardo_carvalho@outlook.com', '5JjVR9SSxMDRwcGTFFXZONGdRVHNSRmNO9kcWdlMkITYkADOk0kaBJjTUVFNNRVW08ERVRjTyUkMNV2L', '2017-01-14 15:41:23');

SELECT id, name, lastname, password FROM users where email = 'leonardo_carvalho@outlook.com';
