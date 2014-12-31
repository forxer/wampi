wampi
===============

Convenient replacement for the default Wampserver index.

Installation
------------

First, you must have installed [WampServer](http://www.wampserver.com/en/) 2.5 or later.

We assume you installed it in the default directory : `c:/wamp/`

Enable wampserver virtualhost by editing `c:\wamp\bin\apache\apache2.4.9\conf\httpd.conf`, at the end of this file, uncomment this line : `IncludeOptional "c:/wamp/vhosts/*"`

So you can now create a new virtualhost by making a new file `c:/wamp/vhosts/wampi.conf` with this content :
```
<VirtualHost *:80>
  ServerName wampi.local
  DocumentRoot "c:\wamp\www\wampi"
  <Directory "c:\wamp\www\wampi">
    Options Indexes FollowSymLinks MultiViews
    AllowOverride all
    Require local
  </Directory>
</VirtualHost>
```

Next, download the [lastest release of Wampi](https://github.com/Tao-php/wampi/releases/latest) and put it in `c:\wamp\www\wampi`.

You can now browse to http://wampi.local to use your new localhost homepage for wampserver.


Developpment
------------

Clone the project.

Install PHP dependancies with:
```
composer install
```

Install assets dependancies with:
```
bower install
```

Install node module to use Grunt:
```
npm install
```

Run Grunt:
```
grunt
```
