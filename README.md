# TestCognox
Prueba Tecnica Cognox

Paso a Paso Inicio Proyecto

Realizar Clone del repositorio con git clone https://github.com/hom669/TestCognox.git
Ingresar a la carpeta cd pruebaU2Soft/TestCognox
Editar archivo de .env con la conexion a base de datos escogida en mi caso Postgresql.
Cambiar las lines del 10 - 15:
DB_CONNECTION=pgsql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=test_cognox DB_USERNAME=root DB_PASSWORD=

con la informacion de su Base de Datos

Ejecutar Comando para realizar las migraciones y seeders especificas con php artisan migrate:refresh --seed
Ejecutar el comando php artisan serve y ejecutar url proporcionada

Al iniciar el Aplicativo nos encontramos el modulo de login para usuarios creados desde la migracion.

1094899623
1094899625
1094899622
1094899624
1094899621

Password: 2021 de todos

Dentro de la aplicacion desplegamos el menu a mano Izquierda en cual apareceran los modulos de Transacciones Bancarias, Estado de Cuenta.

![image](https://user-images.githubusercontent.com/78924776/133877689-1116b4d0-c654-490b-a3d2-6353bc12cd70.png)


MODELO BASE DE DATOS

Tablas:

users[id,name,identification,email,email_verified_at,password,two_factor_secret,two_factor_recovery_codes,remember_token,current_team_id,profile_photo_path,created_at,updated_at] 

accounts[id_account,code_account,balance,enabled,id_user,created_at,updated_at]

transactions[id_transactions,amount,id_account_from,id_account_up,created_at,updated_at]

![image](https://user-images.githubusercontent.com/78924776/133877822-f3093de1-0e6c-4f8a-ab68-1f1961a04e3d.png)
