##Laratrell
<p>Laratrell is a <a href="https://trello.com/" class="underline text-gray-900 dark:text-white">Trello</a> inspired project, part of <a href="https://devplay.com.br/" class="underline text-gray-900 dark:text-white">Devplay</a>'s software developer training program. </p>
<p>It is a kanban style task manager created using <a href="https://laravel.com/" class="underline text-gray-900 dark:text-white">Laravel</a> + <a href="https://jetstream.laravel.com/2.x/introduction.html" class="underline text-gray-900 dark:text-white">Jetstream </a>
    (<a href="https://inertiajs.com/" class="underline text-gray-900 dark:text-white">Inertia </a>
    /<a href="https://vuejs.org/" class="underline text-gray-900 dark:text-white">Vue</a>).</p>

##Technologies<br/>
PHP 8.1.6<br/>
Node 16.17.0<br/>
npm 8.2.0<br/>
composer 2.4.2<br/>


##Instructions - Docker<br/>
Build the containers<br/>
-> docker compose -f "docker-compose.yml" up -d --build <br/>
Run the setup script<br/>
-> docker exec -it laratrell_web sh ./setup.sh <br/>

##Instructions - Manual setup<br/>

Get the repo <br/>
-> Clone<br/>
Setup database info (.env.example provided)<br/>
-> edit /.env file<br/>

Install node dependencies<br/>
-> npm install<br/>
Install jetstream dependencies<br/>
-> composer install<br/>

Create database structure<br/>
->php artisan migrate<br/>
(optional) seed database with test data<br/>
-->php db:seed<br/>

Generate application key<br/>
-> php artisan key:generate<br/>
Run dev script to keep vite building your scripts<br/>
-> npm run dev <br/>
Run laravel backend<br/>
-> php artisan serve<br/>
