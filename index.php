<?php 
        include "./db.php";    

        //Inserindo dados.

        if (isset($_POST['titulo'])) {
                    
            
            $title = $_POST['titulo'];
            $description = $_POST['descricao'];
            $created = date('Y-m-d H:i:s');
            $completed = 0;

            $sql = $bd->prepare("INSERT INTO tasks  VALUES (null,?,?,?,?)");


            $sql->execute(array($title,$description,$completed,$created));


            echo('Cliente cadastrado com sucesso !'); 
        }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>

    <main>
        <h1>Lista</h1>

        <section>
        <form method="POST" >
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br><br>
        
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" required><br><br>
    
        
        <input type="submit" name="submit" value="Enviar">
    </form>
        <div>
             <?php 

                //Deletando os Dados.
                if (isset($_GET['delete'])) {
                    $id = (int)$_GET['delete'];
                    $bd->exec("DELETE FROM tasks WHERE id=$id");
                    echo 'Deletado com sucesso o id: '.$id;
                }

                //Mostrando a lista dos dados.

                $sql = $bd->prepare("SELECT * FROM tasks ");

                $sql->execute();

                $info = $sql->fetchAll();

                for ($i=0; $i < count($info); $i++) { 
                    echo '<hr>';
                    echo 'Título: '.$info[$i]['title'];
                    echo '<br>';
                    echo 'Conteudo: '.$info[$i]['description'];
                    echo '<br>';
                    echo 'Status: '.$info[$i]['completed'];
                    echo '<br>';
                    echo '<a href="?delete='.$info[$i]['id'].'">Apagar</a>';
                    echo '<hr>';
                } 
            ?>
            </div>
        </section>
    </main>
    
    <script>
    </script>
</body>
</html>