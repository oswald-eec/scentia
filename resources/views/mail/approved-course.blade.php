<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>¡Felicitaciones, {{ $course->teacher->name }}!</h1>
    <p>Tu curso <strong>{{ $course->title }}</strong> ha sido publicado con éxito en nuestra plataforma.</p>
    <p>Gracias por tu esfuerzo y dedicación.</p>
    <p>Atentamente,</p>
    <p>El equipo de Scientia Courses</p>
</body>
</html>