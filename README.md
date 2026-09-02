## Video/screencast aplikacije:

https://photos.app.goo.gl/NEqFohhqp3PVyRzv8

## Screenshot-ovi aplikacije:

<a href="https://ibb.co/3YkvvbGv"><img src="https://i.ibb.co/bR7FFVqF/Screenshot-from-2026-09-02-22-30-05.png" alt="Screenshot-from-2026-09-02-22-30-05" border="0"></a>
<a href="https://ibb.co/zTs80dx6"><img src="https://i.ibb.co/dwBbzZMm/Screenshot-from-2026-09-02-22-29-58.png" alt="Screenshot-from-2026-09-02-22-29-58" border="0"></a>
<a href="https://ibb.co/7d9y30br"><img src="https://i.ibb.co/q3Z1H2xm/Screenshot-from-2026-09-02-22-29-43.png" alt="Screenshot-from-2026-09-02-22-29-43" border="0"></a>
<a href="https://ibb.co/TMmTT0Kq"><img src="https://i.ibb.co/xqJssgm8/Screenshot-from-2026-09-02-22-29-36.png" alt="Screenshot-from-2026-09-02-22-29-36" border="0"></a>
<a href="https://ibb.co/TqqykLgK"><img src="https://i.ibb.co/sJJ72HV5/Screenshot-from-2026-09-02-22-29-08.png" alt="Screenshot-from-2026-09-02-22-29-08" border="0"></a>
<a href="https://ibb.co/4ZZ0P5Gm"><img src="https://i.ibb.co/rGGX41S7/Screenshot-from-2026-09-02-22-28-59.png" alt="Screenshot-from-2026-09-02-22-28-59" border="0"></a>
<a href="https://ibb.co/YFBDKhCZ"><img src="https://i.ibb.co/C3KJXQc2/Screenshot-from-2026-09-02-22-28-31.png" alt="Screenshot-from-2026-09-02-22-28-31" border="0"></a>
<a href="https://ibb.co/dsrTSXrb"><img src="https://i.ibb.co/5X60dC6Y/Screenshot-from-2026-09-02-22-28-25.png" alt="Screenshot-from-2026-09-02-22-28-25" border="0"></a>
<a href="https://ibb.co/60p4zKXL"><img src="https://i.ibb.co/HTMr6ch3/Screenshot-from-2026-09-02-22-28-16.png" alt="Screenshot-from-2026-09-02-22-28-16" border="0"></a>

## UPUTE ZA INSTALACIJU
### kloniranje repozitorija i pokretanje Perica CRM aplikacije 


git clone git@github.com:pericakatic/Perica-CRM.git

cd Perica-CRM

composer install

cp .env.example .env

### (kreirajte MySQL bazu, podesite DB_ sekciju u .env konfiguracijskom fajlu, u ovom slučaju MySQL ili Postgres
### Za produkciju podesiti APP_ sekciju + key ostaviti prazno, debug=false)

php artisan key:generate

php artisan migrate --seed

php artisan db:seed --force

# default user:
email:demo@pericacrm.webkatic.com

password:demo
