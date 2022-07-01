QUICK INSTRUCTION TO GET THE APP 
1. Install or config apache that can run PHP like XAMP, MAMP or apache.
2. Install composer https://getcomposer.org/
3. Clone project and cd to the root folder run composer install
4. To migrate database run: php artisan migrate:fresh --seed
5. Create file .env and copy content from .env.example from the root folder
6. Config virtual host or access the app directly by url from htdocs folder
7. Get api documentation via /api/documentation will show the api documentation
8. Run: php artisan make:model [ModelName] --all to create controller, model, migrate, seed files