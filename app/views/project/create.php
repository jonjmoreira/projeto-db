<style>
    /* CSS styles for the form elements */
    .form-container {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
    }

    .form-container input[type="text"],
    .form-container textarea,
    .form-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .form-container textarea {
        resize: vertical;
    }

    .form-container button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-container button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<div class="form-container">
<form action="/projects/create" method="POST">
    <label for="nome_projeto">Nome do Projeto:</label>
    <input type="text" id="nome_projeto" name="nome_projeto" required>

    <label for="conteudo">Conteúdo do Projeto:</label>
    <textarea id="conteudo" name="conteudo" required></textarea>

    <label for="estado_atual">Estado atual do Projeto:</label>
    <select id="estado_atual" name="estado_atual" required>
        <option value="Ativo">Ativo</option>
        <option value="Pausado">Pausado</option>
        <option value="Completo">Completo</option>
        <option value="Abandonado">Abandonado</option>
    </select>

    <input type="submit" value="Criar Projeto">
</form>
</div>

