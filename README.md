## Geo localized register form

### Requirements
  - PHP > 5.6+
  - mysql
  - apache
  - phpunit
  - php mcrypt: sudo apt-get install php5-mcrypt && sudo php5enmod mcrypt

### How to install

  - **Setup data base:**

    - Import *login.sql* file to create the DB

    - Create a new mysql user: *CREATE USER 'dbuser'@'localhost' IDENTIFIED BY 'notasecurepassword';*

    - Grant permissions GRANT ALL PRIVILEGES ON login . * TO 'dbuser'@'localhost';

  - **Clone the repo repo**
  - **Get fun!**

## Functionality

  - **/index.php**: register a user
  - **/login.php**: login with user password
  - **/user.php**: see user location

## Run tests
  - go to server: cd server
  - run tests: phpunit --bootstrap autoload.php tests

## TODOs
  - automate data base setup with a bash script
  - improve unit tests