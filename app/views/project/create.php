<style>
    /* CSS styles for the form elements */
    .form-container textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    .form-container button[type="submit"] {
        display: block;
        margin-top: 10px;
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
        <option value="1">Ativo</option>
        <option value="2">Pausado</option>
        <option value="3">Completo</option>
        <option value="4">Abandonado</option>
    </select>

    <input type="submit" value="Criar Projeto">
</form>
</div>

