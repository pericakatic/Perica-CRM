## UPUTE
## kloniranje repozitorija i pokretanje Perica CRM aplikacije 

git clone git@github.com:pericakatic/Perica-CRM.git
cd Perica-CRM
composer install
npm install
cp .env.example .env
(podesite DB_ sekciju u .env konfiguracijskom fajlu, u ovom slučaju MySQL ili Postgres)
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
