<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Aktywacja konta</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 15px; color: #000;">
    <p>Witaj, {{ $user->name }}!</p>

    <p>Dziękujemy za rejestrację w sklepie RowerOwo.</p>

    <p>Aby aktywować konto, kliknij poniższy link:</p>

    <p>
        <a href="{{ url('/activate/' . $user->activation_token) }}">
            {{ url('/activate/' . $user->activation_token) }}
        </a>
    </p>

    <p>Jeśli nie zakładałeś konta w naszym sklepie, zignoruj tę wiadomość.</p>

    <p>Pozdrawiamy,<br>RowerOwo</p>
</body>
</html>
