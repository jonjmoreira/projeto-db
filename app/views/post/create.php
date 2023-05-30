<!-- create_post.php -->

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
    <h2>Crie uma postagem</h2>

    <form method="POST" action="/post/create">
        <div>
            <textarea id="conteudo" name="conteudo" rows="5" required></textarea>
        </div>

        <button type="submit">Postar</button>
    </form>
</div>
