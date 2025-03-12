-> composer create-project codeigniter4/appstarter ciuser26122024
-> env to .env
	-> CI_ENVIRONMENT = development
    -> db create
	-> Update DB username,password,database name
-> php spark make:model UserModel 
	-> allowedFields
    -> date and time
	-> validationRules
-> php spark make:migration AddUser 
	-> up and down methods implement
-> php spark migrate
-> php spark make:controller Login
-> php spark make:controller Register
-> php spark make:controller Dashboard
-> php spark make:filter AuthFilter 
-> php spark make:filter GuestFilter
-> Filter file in Config
-> $routes
-> View Files
        layout.php
        login.php
        register.php
        dashboard.php
-> php spark serve

-------------

-> php spark make:model OwnerModel
-> php spark make:migration AddOwner
-> php spark migrate
-> composer require firebase/php-jwt
-> php spark make:controller OLogin
-> php spark make:controller ORegister
-> php spark make:controller OUser