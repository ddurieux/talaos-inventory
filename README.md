# POC in python 3 (not work on python 2.x)

# install python modules

```
pip install flask
pip install Flask-SQLAlchemy
pip install Flask-Restless
pip install simplejson
pip install sqlalchemy-migrate
```

# Configuration of webserser

## Nginx and uwsgi 

For example, my folder is in /www

### nginx 

- add in config:

```
    server {
        listen       80;

        server_tokens off;

        location / {
            include uwsgi_params;
            uwsgi_pass unix:/tmp/uwsgi.sock;
            uwsgi_read_timeout 500;
        }
    }
```

### uwsgi 

- update the chdir if not use /www in uwsgi.ini file
- run uwsgi with: 

```
uwsgi /www/uwsgi.ini
```

## Apache and mod_wsgi

```
<VirtualHost *>

    WSGIDaemonProcess glpingpy user=www group=www threads=5
    WSGIScriptAlias / /www/glpingpy/wsgi_apache.py

    <Directory /www/glping_py>
        WSGIProcessGroup glpingpy
        WSGIApplicationGroup %{GLOBAL}
        Order deny,allow
        Allow from all
    </Directory>
</VirtualHost>
```
