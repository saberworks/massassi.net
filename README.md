# Massassi

This folder is required and holds the massassi-web nginx config file.

* massassi-web - nginx server that reverse proxies to all the apps below

Each sub-project of massassi must be checked out individually in this 
directory.

* massassi-static - massassi static site generator
* massassi-django - massassi dynamic app server

These projects will eventually have their own docker containers as well.

* massassi-forums - massassi forums
* jkarena - jkarena
* tacc - admirals command chamber

## Current Instructions

(designed for Brian importing the database and releasing
the site)

Check out the above repos, make sure the directory structure looks like this:

```
(env) brian@oree:~/sites/massassi$ ls -l
total 28
-rw-rw-r--  1 brian brian 2967 Dec  1 22:04 docker-compose.yml
drwxrwxr-x 16 brian brian 4096 Nov 30 23:15 massassi-django
drwxrwxr-x  3 brian brian 4096 Nov 29 09:58 massassi-mysql-import
drwxrwxr-x 10 brian brian 4096 Nov 30 11:40 massassi-static
drwxrwxr-x  2 brian brian 4096 Dec  1 22:02 massassi-web
-rw-rw-r--  1 brian brian  546 Dec  1 22:07 README.md
```

Notes:

* massassi-mysql-import must have the .sql file to import the old database
  * Example: `massassi-mysql-import/docker-entrypoint-initdb.d/db-massassi-2021-03-16.sql`
* `.env-default` must be renamed to `.env` and secrets filled out
* TODO: specify where to put the downloaded level/screenshot files for import
* `docker-compose build && docker-compose up`
* wait for mysql data import to happen
* import old data into new systems:
  * `docker-compose run massassi-django /bin/bash`
  * `cd massassi-django/bin`
  * `./wipedb.sh`
  * `./import_all.sh`
  * verify everything completed with no errors!
  * `ctrl-d` to exit
* docker-compose down massassi-mysql-import
* if final import, remove massassi-mysql-import from docker-compose.yml so it
  never comes back
