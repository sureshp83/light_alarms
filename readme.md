Thomas and Betts
================

* [Project Overview](#project-overview)
* [User test accounts](#user-test-accounts)
* [User Roles](#user-roles)
    * [Administrators](#administrators)
    * [Agency Admins](#agency-admins)
    * [Agencies](#agencies)
    * [Teams](#teams)
* [Installation](#installation)
* [Package Dependencies](#package-dependencies)


## Project Overview
Write project overview here...


### User Test Accounts
User accounts have been provisioned for each account level.

- Administrator:  `admintest@designshopp.com`
- Agency Admin:  `agencyadmintest@designshopp.com`
- Agent:  `agenttest@designshopp.com`

Password: `Sdf423jlJH`
(use the same password for all accounts)


### User Roles
Users roles handles site Administrators, Agency Admins and Agencies, with the
following permissions.

##### Administrators:
- can view/update Agencies, Teams and Users.
- can invite Users to join a Team.
- full access to the administration system.

##### Agency Administrators:
- can view/change Teams.
- can view/change Users related to their teams.
- can invite a Users to join a Team.


##### Agencies:
- Agencies can have many Teams.
- Agencies have one agency administrator.
- Agencies have at least one Team, owned by admin.

##### Teams:
- Teams have many Users.
- Teams have a team owner.



### Installation
Install ImageMagik and Ghostscript required for Medialibrary.
```bash
sudo apt install ghostscript
sudo apt install php-imagick

service php7.2-fpm restart
service nginx restart
```


Pull project from git and install composer packages.
```bash
git pull
composer install
```

Install the application (short version follows bellow)
```bash
art migrate && art voyager:install && art make:teamwork && art db:seed && art search:index
```

Install the application (long version)
```bash
php artisan migrate
php artisan voyager:install
php artisan make:teamwork
php artisan db:seed
php artisan search:index
```

Install npm packages and build Front-end assets
```bash
npm install
npm run prod
```


### Package Dependencies
- Image preview vuejs package: [vue-picture-input](https://github.com/alessiomaffeis/vue-picture-input)
- Team / multitenancy package: [mpociot/teamwork](https://github.com/mpociot/teamwork)
