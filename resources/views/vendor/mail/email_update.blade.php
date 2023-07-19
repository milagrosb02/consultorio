<!DOCTYPE html>
<html>
<head>
    <title>RESTABLECER EMAIL</title>
</head>
<body>
    <h1>Hola {{ $user->email }},</h1>
    <p>Gracias por actualizar tu correo electrónico. Por favor, confirma tu nuevo correo haciendo clic en el siguiente enlace:</p>
    <a href="{{ url('confirm-email/' . $user->id) }}">Confirmar correo electrónico</a>
</body>
</html>
