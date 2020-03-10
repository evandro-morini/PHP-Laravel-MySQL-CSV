**Laravel Test Application**

1. Run `composer install` on project root folder to get all dependencies;
2. Update .env file with your database info;
3. Import SQL dumps on dumps directory;

Routes: 
- http://127.0.0.1:8000/active-austrian-users (GET);
- http://127.0.0.1:8000/user-details/id (PUT);
- http://127.0.0.1:8000/delete-user/id (DELETE);
- http://127.0.0.1:8000/transactions/(csv, db or all) (GET);

PHPUnit Tests:
- tests/Feature/ApiTest.php

RUN Tests:
- `vendor/bin/phpunit tests/Feature/ApiTest`


