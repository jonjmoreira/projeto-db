<!-- register.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Cadastre-se</title>
</head>
<body>
    <h2>Cadastre-se</h2>

    <form action="/register" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
    <p>ou</p>
    <a href="/login"><button>Faça o login</button></a>
</body>
</html>
