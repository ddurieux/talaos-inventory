# Talaos-inventory


# Install

*NOTE*: This project is Python > 3.2 only.

*TOBEDONE* You can install it directly from Pypi:

```
pip install talaos_inventory
```

You can install it from source once you cloned successfully the
repository:

```
pip install .
```

If you want to hack into the codebase (e.g for future contribution),
just install like this:

```
pip install -e .
```

## DEBIAN Jessie

* prerequisites

```
apt-get -y install python3 python3-dev python3-pip git
```

* get the project sources

```
git clone https://github.com/talaos/talaos-inventory
```

* python prerequisites

```
pip3 install -r talaos-inventory/requirements.txt
```

* install 

```
cd talaos-inventory
python3 setup.py install
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
