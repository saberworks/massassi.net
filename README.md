# The Massassi Temple - devops type stuff

## How it works

The docker-compose.yml file specifies a number of containers that will be started when you run `docker-compose up`:

* web - the main web server (runs nginx)
* db - the main database server (initially empty, runs postgres)
* db-import - a mysql database that contains the contents of the old massassi database (used as a source to migrate into the new postgres database)
* massassi-static - nginx container that serves all the static content (plain html pages, images, etc.)
* massassi-django - gunicorn/django container that serves all the dynamic content (also contains scripts that can be used to migrate the old database content to the new database)

Once the data migration is done and the site is fully up and backed up, the db-import container and entries will be completely removed.

## How to set it up

Since you don't have the database dumps or even an empty schema, this probably won't be useful to make a "massassi clone" at this point.  However, I will upload an empty schema soon.  Once it's here, you will have to check out this repository, and then populate the following folders as described:

* massassi-web/ - nginx server that reverse proxies to all the apps below (provided in this repo)

Each sub-project of massassi must be checked out individually in this 
directory.

* [massassi-static/](https://github.com/saberworks/massassi-static) - massassi static site generator
* [massassi-django/](https://github.com/saberworks/massassi-django) - massassi dynamic app server

The following directories must also exist:

* `massassi-mysql-import/` - holds a db dump of the Massassi database.  When the `db-import` container is started, it will look in this directory for the sql dump, and it will import it all into a MySQL database.  This database is used to migrate all the dynamic data from the old system to the new postgres database (see the import scripts in the massassi-django project).
* `massassi-etc/` - this holds all the files that are currently on the massassi server but aren't reasonable to push to github.  Things like huge folders full of random images, large file repositories, personal junk from various staff members, etc.  This directory will be mounted in the `web` nginx instance so all files here will be made available to the public.  (This is just so we don't lose a whole bunch of massassi history that resides on the server but isn't really linked from anywhere, except maybe old forum posts, irc chats, and discord chats.)

Before you `docker-compose up` you should go into the massassi-static project, set up your env/venv, and run `python build.py` to convert all the various markdown and html content files to full HTML pages (which get written to the `massassi-static/output/` directory).

# BRIAN IMPORT INSTRUCTIONS

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
