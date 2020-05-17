# bw_wordpress

This wordpress contains an example of three different widgets using a foreign exchange API.


## Prerequisites
PHP Version 7.3.17
MySQL



## Installation

1.. Go to the folder where you want to install the folder

```bash
git clone https://github.com/jonaber/bw_wordpress.git
```

2. We need to create a databse bw_wordpress, assign a user to it.
The following is an example of how to do it in the command line (using root user to access database):

```bash
mysql -uroot -p -hlocalhost 
mysql> CREATE DATABASE bw_wordpress;
mysql> CREATE USER 'bwuser'@'localhost' IDENTIFIED BY '123456';
mysql> GRANT ALL PRIVILEGES ON bw_wordpress.* TO 'bwuser'@'localhost';
```

3. In the Project there is a file named bw_wordpress.sql which contains the script for the migration of the database tables used in this example.

```bash
mysql> USE bw_wordpress;
mysql> source bw_wordpress.sql
```

4. Check that in the wp_config you have the following configured:

```php
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bw_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'bwuser' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );
```


## Usage

1. Go into the browser and load the project

```
http://localhost/bw_wordpress
```


## Notes

1. I have done the three columns which are shown in the homepage.

2. The columns can be added and removed (maximum of three). The width of each coulumn adjusts to fill in the width of the page according to the number of columns.

3. The columns are responsive to mobile.

4. I have created a Widget which shows the Foreign Exchange Currencies in a table, calling a Foreign Exchange API.


Extra: 
- Created another widget which is a currency conversion tool using the same Foreign Exchange API and javascript to calculate the currency amount.
- Created another widget that shows the foreign exchange values scrolling. It uses the same Foreign Exchange API, and uses HTML 5 to do the scrolling of text. 





