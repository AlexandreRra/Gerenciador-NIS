This project was made to create and search the register of citizens and their respective NIS.

To run you need to install PHP, MySQL and Composer.

If you don't have any of above, install with the links below:

PHP:
https://www.php.net/downloads.php
Microsoft Visual C++ is needed too, but normally you already have it ( if not, link -> https://learn.microsoft.com/pt-br/cpp/windows/latest-supported-vc-redist?view=msvc-170)

1. Download PHP .zip in C:\php
2. Extract
3. Rename file "php.ini-development" to "php.ini"
4. Open Control Panel -> System -> Advanced options -> Environment Variables
5. Copy and add in PATH the path of your php folder
6. Open cmd and input 'php --version' just to check if it is ok
7. Run the notepad with admin and open the file "hosts" in C:\Windows\System32\drivers\etc
8. Uncomment the line with your localhost IP (just remove the "#" from line "127.0.0.1")
8.1. If you dont have that line, write "127.0.0.1 localhost" and save
9. Done

Use 'php -s localhost:8000' at the project folder to run. If you need to run in another port, change the URL in the .env file.
https://www.youtube.com/watch?v=HzIXZVctwI8 -> tutorial video


SQL:
https://dev.mysql.com/downloads/windows/installer/8.0.html

1. Download
2. Run .exe
3. In installer, select custom
4. Check MySQLServer and Applications->MySQLWorkbench (need to select and click the rigth arrow)
5. install and create your user/password for your DB
6. go next until ists finished
7. Open your 'php.ini'
8. Uncomment "extension_dir = 'ext'"
9. Uncomment "extension = pdo_mysql"
10. Create table in MYSQL Workbench

CREATE TABLE `nis` (
  `nis` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`nis`),
  UNIQUE KEY `nis_UNIQUE` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

https://www.youtube.com/watch?v=IeTbZOxEwGc -> tutorial video

Composer:
https://getcomposer.org/download/

1. Dowload composer-setup.exe
2. Install

-------------------------------------------------------------------------------------------------------------------------------------------

Project:

First of all you need to set de Environment Variables. For safety measures, the ".env.dev" is not used, its only a mirror so you can change with your infos.
After setting them, change the ".env.dev" to ".env"

Use 'php -s localhost:8000' to open. You can change in the .env file

Any questions, send me an email: alexandrerra08@gmail.com


