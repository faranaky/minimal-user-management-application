## Minimal User Management API (with Laravel)

This project shows basic methods for API authentication and user management.


### What we have 

- Domain model (UML) and use case diagram for these processes -> check /extra_files/diagrams
- Postman collection for testing all API routes -> check /extra_files/diagrams/postman_collection
- REST API
- API authentication base on Bearer token 
- CRUD for users and groups
- ManyToMany relation between users and groups model
- Migration for users, groups and admins table
- Seeder for admins table

## Installation

1. clone project in your desired destination
2. create database
3. rename .env.example file to .env
4. edit .env file and enter your environment variables here (like DB_DATABASE, DB_USERNAME etc)
5. on terminal run: ```php artisan key:generate``` --> generates your application key
6. run ```php artisan migrate``` --> creates admin, users, groups tables
7. run ```php artisan db:seed``` --> adds one admin (email: 'admin@admin.com', 'password': '12345678')
8. go to postman and import collection from extra_files/collection
9. on postman add host to your environment variables
<p align="center">
  <img src="extra_files/images/postman_manage_environment.png" width="700" title="environment management">
</p>

10. on postman run Get Token request under Login folder and copy token
11. add another variable called token and paste the value
12. start calling other requests according to examples


###### Help
If you need help please contact `yazdanfar.faranak@gmail.com`.



