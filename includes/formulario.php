<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos PHP</title>
</head>

<body>

    <h1>Upload de Arquvios PHP</h1>

    <form action="../index.php" method="POST" enctype="multipart/form-data">

        <label>Arquivo</label>
        <input type="file" name="arquivo">
        <br><br>

        <button type="submit">Enviar</button>
    </form>

</body>

</html>