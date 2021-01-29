
# App Market

  

It's an app market inspired by Play Store mostly created with Laravel v8.23.1, Bootstrap and some AJAX requests for a challenge that I found interesting.

  

## Requirements

  
* Git

* Composer

* Php >=7.3.11
  

## Installation


Get Composer: https://getcomposer.org/download/

 

## Clone repository

```
$ git clone https://github.com/JoseSulbaran/laravel-project.git
```

## Access route

```
$ cd laravel-proyecto
```

  

## Run the following command

  

```
$ composer install
```

  

## Rename the file __.env.example.__ to __.env__ and add our credentials

  
  

## Create a key

```
$ php artisan key:generate
```

  

## Finally, we can run the app

```
$ php artisan serve
```

  

## Routes

  

Important roles (middlewares): **guest**, **auth**, **client** and **developer**.

  

-  **Guest** can view the apps, access to their details and sort them by category.

-  **Auth** (developer and client) are the users who registered and logged in and then can access new features.

-  **Client** can buy apps, add them to the wishlist and access a page with all their purchased apps.

-  **Developer** can upload apps and access a page with all their uploaded apps.

  

**Guest can access to:**

- *GET* /apps

- *GET* /apps/{app}

- *GET* /apps/{category}

  

**Developers can access to:**

- Guest routes

- *GET* me/apps

- *GET* me/apps/create

- *POST* me/apps

- *GET* me/apps/{app}/edit

- *PUT* me/apps/{edit}

- *DELETE* me/apps/{app}

  

**Clients can access to:**

- Guest routes

- *GET* me/apps

- *GET* me/wishlist

- *POST* api/buy

- *DELETE* api/buy

  

## Seeders

  

To populate the Apps and Categories models with data, run the following command:

  

```
php artisan migrate --seed
```

## Database

  

Consists of a relational database with four models (tables): **Apps**, **Categories**, **ClientApps** and **Users**.

  

### Apps:

| app_id | name | price | photo | category | developer_id |
| --- | --- | --- | --- | --- | --- |
| key bigint | varchar | int | varchar | varchar | int |

### Categories:

| id | name |
| --- | --- |
| key bigint | varchar |

### ClientApps:
  
| purchase_id | user_id | app_id | has_bought |
| --- | --- | --- | --- |
| key bigint | int | int | tinyint |

### Users:

| Id | name | email | password | role |
| --- | --- | --- | --- | --- |
| key bigint | varchar | varchar | varchar | varchar |

  

#### Relationships are:

*  `Users.user_id` 1->n `ClientApps.user_id`

*  `Apps.app_id` 1->n `ClientApps.app_id`
