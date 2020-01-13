# tender List

### Installation

* Symfony 4.4
* AngularJS 1.7
* Bootstrap
* PHP ^7.2
* MySQL
* Apache

```bash
$ git clone https://github.com/AudriusBuika/Tender-List.git tenderlist
$ cd tenderlist
$ composer install
```

### Configuration mysql datebase `.env` from `.env.test`

```
DATABASE_URL=mysql://db_user:password@127.0.0.1:3306/db_name?serverVersion=10.4.6
DATABASE_CHARSET=utf8mb4
DATABASE_TABLE_OPTIONS_CHARSET=utf8mb4
DATABASE_TABLE_OPTIONS_COLLATE=utf8mb4_general_ci
DATABASE_TABLE_OPTIONS_ENGINE=MyISAM
```

### Create datebase
```bash
$ php bin/console doctrine:database:create
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

### Run project
```bash
$ symfony serve
```

and you can open <b>https://127.0.0.1:8000</b>

##### if you need tender more record you can generate 4000 faker record
```bash
$ php bin/console doctrine:fixtures:load
```

___
# Project task

Tender CRUD. You need to create list of tenders with ability to update, delete and create new tender.

Final solution must be a working web page with at least 4000 tenders (use any random generated fake data). It is enough to have these fields in tender: title, description. Code must be placed in repository (-ies) with Readme file how to install and run it.

#### Requirements:
1. Use PHP as backend programming language.

#### Bonuses:
1. Symfony framework in backend (any of 3/4/5 versions). (+1 point)
1. AngularJS (1.7 version) framework in frontend. (+1 point)
1. Bootstrap or Materialize framework in frontend. (+1 point)
1. Backend and frontend placed in separate repositories and launched on separate ports. (+2 points)
1. Frontend communicates with backend via API. (+2 points)
1. Navigating in frontend without full page reload. (+1 points)
1. Backend and frontend code is [PSR-2 compliant](https://www.php-fig.org/psr/psr-2/). (+1 points)
1. Web page should be compatible with these browsers: (+1 points)
	
	Internet Explorer 11
	
	Edge newest
	
	Mozilla Firefox newest
	
	Chrome newest
