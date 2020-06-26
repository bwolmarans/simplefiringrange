# simplefiringrange aka 80s firing range

18.04

root@ip-10-0-4-89:~/docker-lamp# docker run -p "80:80" -v ${PWD}/app:/app mattrayner/lamp:latest-1804
Updating for 7.4
=> An empty or uninitialized MySQL volume is detected in /var/lib/mysql
=> Installing MySQL ...
=> Done!
=> Waiting for confirmation of MySQL service startup
=> Creating MySQL admin user with random password
ERROR 1133 (42000) at line 1: Can't find any matching row in the user table
=> Done!
========================================================================
You can now connect to this MySQL Server with 94FUwhm2la0S

    mysql -uadmin -p94FUwhm2la0S -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections

enjoy!
========================================================================
/usr/lib/python2.7/dist-packages/supervisor/options.py:298: UserWarning: Supervisord is running as root and it is searching for its configuration file in default locations (including its current working directory); you probably want to specify a "-c" argument specifying an absolute path to a configuration file for improved security.
  'Supervisord is running as root and it is searching '
2020-06-26 15:22:50,215 CRIT Supervisor running as root (no user in config file)
2020-06-26 15:22:50,215 INFO Included extra file "/etc/supervisor/conf.d/supervisord-apache2.conf" during parsing
2020-06-26 15:22:50,215 INFO Included extra file "/etc/supervisor/conf.d/supervisord-mysqld.conf" during parsing
2020-06-26 15:22:50,224 INFO RPC interface 'supervisor' initialized
2020-06-26 15:22:50,224 CRIT Server 'unix_http_server' running without any HTTP authentication checking
2020-06-26 15:22:50,224 INFO supervisord started with pid 1
2020-06-26 15:22:51,227 INFO spawned: 'mysqld' with pid 503
2020-06-26 15:22:51,228 INFO spawned: 'apache2' with pid 504
2020-06-26 15:22:52,570 INFO success: mysqld entered RUNNING state, process has stayed up for > than 1 seconds (startsecs)
2020-06-26 15:22:52,571 INFO success: apache2 entered RUNNING state, process has stayed up for > than 1 seconds (startsecs)

root@ip-10-0-4-89:~# docker ps
CONTAINER ID        IMAGE                         COMMAND             CREATED             STATUS              PORTS                          NAMES
da4fc5b552bd        mattrayner/lamp:latest-1804   "/run.sh"           About an hour ago   Up About an hour    0.0.0.0:80->80/tcp, 3306/tcp   condescending_hoover
wget https://raw.githubusercontent.com/bwolmarans/simplefiringrange/master/brett.mysql
cat brett.mysql | docker exec -i da4fc5b552bd mysql


for Ubuntu 16
mysqli has fixed the classic owasp top 10 attacks against mysql.  
so in this firing range, for whatever reason, we're not using mysqli.

First become root on your linux box.
my examples below use ubuntu 16.

`apt install apache2 mysql-server php php-mysqli php-gd libapache2-mod-php git`

During this fun process, mysql should pop up a big purple screen asking for root password do your thang make that password hello123 do it!  

`apt-get install phpmyadmin php-mbstring php-gettext`

phpmyadmin will likewise ask you to input a password, using a purple page.


systemctl restart apache2

  
###### TESTING
```
mysql --user=root --password=hello123 -e "SELECT 1+1"

+-----+
| 1+1 |
+-----+
|   2 |
+-----+
```
###### TROUBLESHOOTING

change mysql root password: `mysqladmin --user=root password "hello123"`

give phpmyadmin full rights: 

mysql

`FLUSH PRIVILEGES; GRANT ALL PRIVILEGES ON *.* TO phpmyadmin@localhost; quit;`

give root all rights:

mysql

`FLUSH PRIVILEGES; GRANT ALL PRIVILEGES ON *.* TO root@localhost; quit;`
  
# got gui? 

<site>/phpmyadmin, login as phpmyadmin and the password from the purple page

click and make a database named brett

click and make a table ( NOT manually, copy and paste the SQL below into the SQL box in phpmyadmin ) named users with this structure:

username: varchar 111

password: varchar  111

email: varchar  111

creditcard: varchar  111

animal: varchar 111

```
CREATE TABLE `brett`.`users` ( `username` VARCHAR(111) NOT NULL , `password` VARCHAR(111) NOT NULL , `email` VARCHAR(111) NOT NULL , `creditcard` VARCHAR(111) NOT NULL , `animal` VARCHAR(111) NOT NULL ) ENGINE = InnoDB;
```

then click insert and put some users in. don't forget to click go!

you get stuff like this going on:
```
INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('miyuki', 'hello', 'm@m.com', '3533497685860304', '');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('admin', 'password', 'admin@app.com', '4024007183948511', '');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('brett', 'Hello123!', 'brett@app.com', '349256618723322', '');

INSERT INTO users (username, password, email, creditcard, animal) VALUES ('itsbrett@gmail.com', 'hello123', 'brett@app.com', '349256618723322', '');
```

now on your ubuntu 16 box:
```
cd /var/www
git clone https://github.com/bwolmarans/simplefiringrange.git
mv html html_original
mv simplefiringrange html
```

now you should be able to browser and get stuff going

try this: enter ' or 1=1;## for the password

you want to get to this point:

sql: SELECT * FROM users WHERE username = 'brett' and password = '' or 1=1;-- '

Select returned 3 rows.

Animal:, Email: admin@app.com, CreditCard: 4024007183948511, Password: password

Animal:, Email: brett@app.com, CreditCard: 349256618723322, Password: Hello123! 

Animal:, Email:m@m.com, CreditCard: 3533497685860304, Password: hello 

When you login, you can add an animal.  Here is where you can add in some reflected and stored XSS

Try naming your animal <script>alert('hacked!');</script>





