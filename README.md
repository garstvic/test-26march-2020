# test-26march-2020

1. Create db __weather__
2. Restore data from dump file
3. Change __config.php__ file in root directory and console/ with db cridentials
4. Install packages with composer
5. Config apache2 for pretty url
```
                Options Indexes FollowSymLinks
                AllowOverride all
                Require all granted
                RewriteEngine On
                RewriteBase /
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]
```
6. To get data from API, run console application __$./tasks get_weather__
7. To update compared data, run console application __./tasks compare_weather_with_conditions__
