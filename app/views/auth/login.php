<!-- login.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Entrar</title>
</head>
<body>
    <h2>Faça o login</h2>

    <form action="/login" method="POST">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Login">
    </form>
    <p>ou</p>
    <a href="/register"><button>Cadastre-se</button></a>
</body>
</html>
