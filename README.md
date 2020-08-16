

make copy of '.env.example' and rename it to '.env'.

add details of the datatbase.

DB_CONNECTION=mysql,
DB_HOST=127.0.0.1,
DB_PORT=3306,
DB_DATABASE=**your database name**,
DB_USERNAME=root,
DB_PASSWORD=,

add details of mail.

MAIL_MAILER=smtp,
MAIL_HOST=smtp.mailtrap.io,
MAIL_PORT=2525,
MAIL_USERNAME=**mailtrap username**,
MAIL_PASSWORD=**mailtrap password**,
MAIL_ENCRYPTION=null,
MAIL_FROM_ADDRESS=**some random mail**,
MAIL_FROM_NAME="${APP_NAME}",


run migration ie php artisan migrate.

run php artisan queue:work 

run php artisan serve
