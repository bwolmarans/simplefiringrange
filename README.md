# simplefiringrange aka 80s firing range

for Ubuntu 16
mysqli has fixed the classic owasp top 10 attacks against mysql.  
so in this firing range, for whatever reason, we're not using mysqli.

First become root on your linux box.
my examples below use ubuntu 16.

apt install apache2 mysql-server php php-mysqli php-gd libapache2-mod-php git

During this fun process, mysql should pop up a big purple screen asking for root password do your thang make that password hello123 do it!  

apt-get install phpmyadmin php-mbstring php-gettext
phpmyadmin will likewise ask you to input a password, using a purple page.

systemctl restart apache2

<site>/phpmyadmin, login as root and the password from the purple page
  
# got gui? 

click and make a database named brett

click and make a table named users with this structure:

username: varchar 111

password: varchar  111

email: varchar  111

creditcard: varchar  111

animal: varchar 111

CREATE TABLE `brett`.`users` ( `username` VARCHAR(111) NOT NULL , `password` VARCHAR(111) NOT NULL , `email` VARCHAR(111) NOT NULL , `creditcard` VARCHAR(111) NOT NULL , `animal` VARCHAR(111) NOT NULL ) ENGINE = InnoDB;

then click insert and put some users in. don't forget to click go!

you get stuff like this going on:

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('miyuki', 'hello', 'm@m.com', '3533497685860304', '');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('admin', 'password', 'admin@app.com', '4024007183948511', '');

INSERT INTO `users` (`username`, `password`, `email`, `creditcard`, `animal`) VALUES ('brett', 'Hello123!', 'brett@app.com', '349256618723322', '');

INSERT INTO users (username, password, email, creditcard, animal) VALUES ('itsbrett@gmail.com', 'hello123', 'brett@app.com', '349256618723322', '');

now on your ubuntu 16 box:
cd /var/www
git clone https://github.com/bwolmarans/simplefiringrange.git
mv html html_original
mv simplefiringrange html

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





