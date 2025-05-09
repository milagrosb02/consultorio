 # 🦷 Consultorio 🦷

> Esta api fue creada con el fin de poder ayudar a un consultorio odontológico.

# Build With
## Laravel

# Requisites
- PHP >= 7.4 (Para esta api utilice la 8.1.6)
- Composer
- MySQL
- Laravel version 8

# Install
1. Clona este repositorio en tu máquina local.
2. Instala las dependencias del proyecto ejecutando `composer install`.
3. Crea una copia del archivo `.env.example` y renómbralo a `.env`. Luego, configura las variables de entorno, especialmente la conexión a la base de datos.
4. Genera una nueva clave de aplicación ejecutando `php artisan key:generate`.
5. Ejecuta las migraciones de la base de datos para crear las tablas necesarias con el comando `php artisan migrate`.
6. Opcionalmente, puedes ejecutar los seeders para poblar la base de datos con datos de ejemplo ejecutando `php artisan db:seed`.


# Usage
- Para ejecutar la aplicación en tu servidor local, utiliza el comando `php artisan serve`.
- La API estará disponible en la URL `http://localhost:8000`.

# Resources
- Administrador
- Doctoras
- Pacientes
- Turnos
- Odontograma
- Historial Clínico
  

# Endpoints
## Los endpoints principales de la api:
> Para autentificacion
- Route::post('register', [RegisterController::class, 'register']);
- Route::post('login',[LoginPacienteController::class, 'login']);


> Para dar de alta un turno, poder verlo y cancelarlo
- Route::post('turnos/create', [TurnoController::class, 'store']);
- Route::get('turnos/show/{paciente_id}', [TurnoController::class, 'show']);
- Route::get('turnos/cancelar/{turno_id}', [TurnoController::class, 'cancelar_turno']);

> Para ver el historial clínico
-  Route::get('legajo/show/{paciente_id}', [LegajoController::class, 'show']);

> Para ver el odontograma
-  Route::get('odontograma/show/{paciente_id}', [OdontogramaController::class, 'show']);


# Usage
## Auth
### Login
```
{
  "email": "usuario@example.com",
  "password": "contraseña"
};
```
### Registro (Paciente)
```
{
  "first_name": "First Name",
  "last_name": "Last Name",
  "email": "email@email.com",
  "password": "password",
  "password_confirmation": "password",
  "phone": "1234",
  "obra_social_id": 2
}
```
### Crear turno
> Se puede tener un motivo de consulta o elegir una especialidad, pero ambos no, un campo debe estar nulo.
```
{
  "user_id": "2",
 'especialidad_id': 2, // ejemplo especialidad
 'motivo_consulta': 'Dolor de muela', // emeplo motivo consulta
 'fecha': 2024-5-10,
 'hora': 10:00,
'paciente_id': 2
}
```
### Para probar la API
> Cualquier herramienta disponible para enviar peticiones a servicios web y ver respuestasfound in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
