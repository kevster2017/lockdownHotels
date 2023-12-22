# Lockdown Hotels Application
This web application uses CRUD functionality where a user can sign up, list a property/hotel to rent, book a hotel and send messages. A user can also edit their listed property/hotel. 

The system is designed using a Model View Controller (MVC) architecture.


## Description
The application will allow a user to register an account and create their user profile. 
The database also contains a column called ‘is_admin’. By changing is_admin to 1, the user becomes an administrator, unlocking the administrator features. 

## Build
The application was developed using Laravel 10 and Bootstrap 5.3
* Docker Desktop used to run the application
* TablePlus used to display the MySQL database


## Features
* Authentication - Registration and Login
* Data Input Validation - Frontend and Backend
* Error messages
* Image Upload
* Middleware
* Stripe Payment integration
* PayPal integration


### Standard User Features
Once registered/logged in, a standard user can avail of the following features:
* Book a hotel
* Add extras to their booking - JavaScript provides dynamic price updating based on the feature selected
* List a property for rent
* Send messages to the hotel admin
* Hotel administrators can view messages
* View all hotels listed
* View the hotel categories


### Administrator Features
In addition to standard user features, an administrator is provided with the following features:
* Ability to edit their listed hotel
* View messages sent to them

### Payment features
Users can select between Stripe Payment or PayPal payment


## Licence
Copyright 2023 Kevin O'Kane

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
