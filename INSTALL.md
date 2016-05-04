# The Squire Project

[![Build Status](https://travis-ci.org/uidaho/squireproject.svg?branch=master)](https://travis-ci.org/uidaho/squireproject)
[![Total Downloads](https://poser.pugx.org/uidaho/squireproject/d/total.svg)](https://packagist.org/packages/uidaho/squireproject)
[![Latest Stable Version](https://poser.pugx.org/uidaho/squireproject/v/stable.svg)](https://packagist.org/packages/uidaho/squireproject)
[![Latest Unstable Version](https://poser.pugx.org/uidaho/squireproject/v/unstable.svg)](https://packagist.org/packages/uidaho/squireproject)
[![License](https://poser.pugx.org/uidaho/squireproject/license.svg)](https://packagist.org/packages/uidaho/squireproject).

Squire is a web-based collaborative software development environment with a project development center. Squire will allow multiple users to edit files and communicate in real time. Projects can be stubbed out and then other users can join and/or vote to support for their favorite projects. After a certain amount of support, planning, and documentation is reached for a project, the project becomes a fully fledged project and then community development can start. Think "kickstarter for code" where people pledge their help with the project and not just financial support.

<!-- START doctoc -->
<!-- END doctoc -->

## Squire Requirements
Squire is easy to install if you have a webserver with the following pre-requises available you can skip ahead to [Squire Installation](#squire-installation).
- Apache/NGINX Webserver pointing to the squireproject/public folder
- PHP 5.6 or greater
- Composer v1.0.0 or greater

Otherwise, start with [Obtaining a VPS](#obtaining-a-vps) to create your hosting envionment.

### Obtaining a VPS
### Securing your VPS
```
root@www:~# passwd
root@www:~# ufw allow ssh
root@www:~# ufw allow http
root@www:~# ufw allow https
root@www:~# ufw allow mail
root@www:~# ufw enable
root@www:~# ufw status
```
You should then see:
```
Status: active

To                         Action      From
--                         ------      ----
22                         ALLOW       Anywhere
80                         ALLOW       Anywhere
443                        ALLOW       Anywhere
25/tcp                     ALLOW       Anywhere
22 (v6)                    ALLOW       Anywhere (v6)
80 (v6)                    ALLOW       Anywhere (v6)
443 (v6)                   ALLOW       Anywhere (v6)
25/tcp (v6)                ALLOW       Anywhere (v6)
```

### Create User
Create a user for squire and give it the ability to use sudo:
```
adduser squire
adduser squire admin
su squire
```

### Install Composer
```
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install curl php5-cli git
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

### Install Java
The squire project needs the java jre and jdk in order to compile java code:
```
sudo apt-get install default-jre
sudo apt-get install default-jdk
```

### Install MySQL, Nginx and PHP5-FPM
```
sudo mysql_secure_installation
sudo apt-get install nginx php5-fpm php5-cli php5-mcrypt git lrzsz unzip zip
```

## Configuration
### Create Self-Signed SSL Certificate
```
sudo mkdir /etc/nginx/ssl
openssl dhparam -out /etc/nginx/ssl/dhparam.pem 2048
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/nginx.key -out /etc/nginx/ssl/nginx.crt
```
Do not enter a password, just press enter twice. Follow the prompts to look something like this:
```
Country Name (2 letter code) [AU]:US
State or Province Name (full name) [Some-State]:Idaho
Locality Name (eg, city) []:Moscow
Organization Name (eg, company) [Internet Widgits Pty Ltd]:University of Idaho
Organizational Unit Name (eg, section) []:CS383
Common Name (e.g. server FQDN or YOUR name) []:*.your_domain.com
Email Address []:admin@your_domain.com
```

### Configure Nginx
Edit `/etc/nginx/sites-available/your_domain.com` and put this in it:
```
server { 
listen 80; 
listen [::]:80; 
listen 443 default ssl;
server_name www.your_domain.com your_domain.com;

ssl_certificate      /etc/nginx/ssl/nginx.crt;
ssl_certificate_key  /etc/nginx/ssl/nginx.key;
ssl_dhparam          /etc/nginx/ssl/dhparam.pem;
ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
ssl_prefer_server_ciphers on;
ssl_ciphers "EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH";
ssl_ecdh_curve secp384r1; # Requires nginx >= 1.1.0
ssl_session_cache shared:SSL:10m;
ssl_stapling on; # Requires nginx >= 1.3.7
ssl_stapling_verify on; # Requires nginx => 1.3.7
resolver 8.8.8.8 8.8.4.4 valid=300s;
resolver_timeout 5s;
add_header Strict-Transport-Security "max-age=63072000; includeSubdomains; preload";
add_header X-Frame-Options DENY;
add_header X-Content-Type-Options nosniff;

if ($ssl_protocol = "") {
   rewrite ^   https://$server_name$request_uri? permanent;
}

root /home/squire/squireproject/public;
index index.php index.html index.htm;

location / {
    try_files $uri $uri/ =404;
}

error_page 404 /404.html;
error_page 500 502 503 504 /50x.html;
location = /50x.html {
    root /usr/share/nginx/html;
}

location ~ \.php$ {
    try_files $uri =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
}
```
Next lets create a symlink to enable the new domain:
```
sudo rm /etc/nginx/sites-enabled/default
sudo ln -s /etc/nginx/sites-available/your_domain.com /etc/nginx/sites-enabled/your_domain.com
sudo service nginx restart
```

### Configure PHP5-FPM
Edit `/etc/php5/fpm/php.ini` and then find cgi.fix_pathinfo and uncomment and set it like: 
```
cgi.fix_pathinfo=0
```
Edit `/etc/php5/fpm/pool.d/sites.conf` and then add the following to it:
```
[squire]
user = squire
group = squire
listen = /var/run/php5-fpm-squire.sock
listen.owner = www-data
listen.group = www-data
pm = dynamic
pm.max_children = 5
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3
chdir = /
```
Edit `/etc/php5/fpm/conf.d/05-opcache.ini` and set:
```
opcache.enable=0
```
Then restart the service:
```
sudo service php5-fpm restart
```

## Squire Installation
SSH into the server using the credentials for the squire user you created earlier.

### Create MySQL Database and User
Open a mysql session as root and then execute the following:
```
mysql -u root
CREATE DATABASE IF NOT EXISTS squire_squire
CREATE USER 'squire_squire'@'localhost' IDENTIFIED BY 'secret_password';
GRANT ALL ON squire_squire.* TO 'squire_squire'@'localhost';
FLUSH PRIVILEGES;
exit
```

### Create Firebase Database
Visit https://www.firebase.com/signup/ and create a database, make note of the url for the firebase, you'll need it later.

### Install Squire
1. Generate ssh key on the server:
    * `squire@www:~$ ssh-keygen -t rsa -b 4096 -C "CHANGE_ME@vandals.uidaho.edu"`
    * If you enter a password, you will have to provide it each time you use the key (often).
1. Add your new public key to github.com:
    * `squire@www:~$ cat ~/.ssh/id_rsa.pub`
    * copy and paste this string into github key management https://github.com/settings/keys
1. Clone the Squire Project files into your home directory:
    * `squire@www:~$ cd`
    * `squire@www:~$ git config --global push.default simple`
    * `squire@www:~$ git clone git@github.com:uidaho/squireproject.git`
1. Change directory to the project folder:
    * `squire@www:~$ cd ~/squireproject`
1. Install the project's library pre-reqs with composer:
    * `squire@www:~/squireproject$ composer install`
1. Edit your individual .env environment file to include your username and mysql db password:
    * `squire@www:~/squireproject$ cp .env.example .env`
    * `squire@www:~/squireproject$ nano .env`
    * The .env should look like this:
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:9pv1k6+4+VIB32j666666aek1/Nn/1N9V0Z2WbfDU=
APP_URL=http://your_domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=squire_squire
DB_USERNAME=squire_squire
DB_PASSWORD=secret_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=sendmail
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

FIREBASE_URL=https://radiant-torch-8044.firebaseio.com/
FIREBASE_TOKEN=
```
1. Generate application key for encrypting protected data:
    - `squire@www:~/squireproject$ php artisan key:generate`
1. Set permissions on the storage folder:
    - `squire@www:~/squireproject$ find ~/squireproject/storage -type d -exec chmod 775 {} +`
    - `squire@www:~/squireproject$ find ~/squireproject/storage -type f -exec chmod 664 {} +`
1. Navigate to https://your_domain.com/ and bask in the awesomeness that is the Squire Project.

### Install phpMyAdmin (optional)
```
squire@www:~$ cd squireproject/public
squire@www:~/squireproject/public$ wget https://files.phpmyadmin.net/phpMyAdmin/4.6.0/phpMyAdmin-4.6.0-all-languages.zip
squire@www:~/squireproject/public$ unzip phpMyAdmin-4.6.0-all-languages.zip
squire@www:~/squireproject/public$ mv phpMyAdmin-4.6.0-all-languages phpmyadmin
squire@www:~/squireproject/public$ rm phpMyAdmin-4.6.0-all-languages.zip
```
