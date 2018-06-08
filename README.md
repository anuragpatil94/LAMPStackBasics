# LAMPStackBasics
Understanding the Software Developement process with LAMP Stack.

## Contents

<!-- TOC -->

- [LAMPStackBasics](#lampstackbasics)
    - [Contents](#contents)
    - [System Configuration](#system-configuration)
    - [LAMP Server Setup](#lamp-server-setup)
        - [Steps to install the required libraries and software for LAMP](#steps-to-install-the-required-libraries-and-software-for-lamp)
        - [Starting server on boot](#starting-server-on-boot)
        - [Run PHP server in another workspace](#run-php-server-in-another-workspace)

<!-- /TOC -->

## System Configuration
* Ubuntu 18.04
* RAM 16GB

## LAMP Server Setup

### Steps to install the required libraries and software for LAMP

* Install Apache - `sudo apt-get install apache2`
* Verify Apache Server using `localhost` on browser
* Install MySQL - `sudo apt-get install mysql-server`
* Install PHP - `sudo apt-get install php`
* Install PHP Extensions - `sudo apt-get install -y php-{bcmath,bz2,intl,gd,mbstring,mysql,zip} && sudo apt-get install libapache2-mod-php`

### Starting server on boot

* sudo systemctl enable apache2.service
* sudo systemctl enable mysql.service

### Run PHP server in another workspace

* In the required folder - `php -S localhost:<port>`