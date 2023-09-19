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
    <style>
        .editar-form{
            display: none;
        }
    </style>
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
                
                //Atualizando Dados.
                if (isset($_POST['tituloEdi'])) {
                    $id = $_POST['id']; // Obtém o ID do registro a ser atualizado
                    $tituloEdi = $_POST['tituloEdi'];
                    $descriEdi = $_POST['descriEdi'];
                
                    // Execute a atualização no banco de dados
                    $stmt = $bd->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
                    $stmt->bindParam(':title', $tituloEdi);
                    $stmt->bindParam(':description', $descriEdi);
                    $stmt->bindParam(':id', $id);
                
                    if ($stmt->execute()) {
                        echo 'Dados atualizados com sucesso!';
                    } else {
                        echo 'Erro ao atualizar dados.';
                    }
                }
                
                


                //Mostrando a lista dos dados.

                $sql = $bd->prepare("SELECT * FROM tasks ");

                $sql->execute();

                $info = $sql->fetchAll();

                foreach ($info as $key => $value) { 
                    echo '<hr>';
                    echo '<br>';
                    echo 'Id: '.$value['id'];
                    echo '<br>';
                    echo 'Título: '.$value['title'];
                    echo '<br>';
                    echo 'Conteudo: '.$value['description'];
                    echo '<br>';
                    echo 'Status: '.$value['completed'];
                    echo '<br>';
                    echo '<a href="?delete='.$value['id'].'">Apagar</a>';
                    echo ' | ';
                    echo '<a href="" class="editar-link">Editar</a>';
                    echo '<form class="editar-form" method="POST">
                            <input type="hidden" name"id" value="' . $value['id'] . '"></input>
                            <input type="text" name="tituloEdi" id="campo1" placeholder="Título">
                            <input type="text" name="descriEdi" id="campo1" placeholder="Descrição">
                            <button type="submit" name="submit">Enviar</button>
                        </form>';
                    echo '<hr>';
                } 
            ?>



            </div>
        </section>
    </main>
    
    <script>
        const editarLink = document.querySelectorAll(".editar-link");
        const editarForm = document.querySelectorAll(".editar-form");

        editarLink.forEach((link,index) => {
            link.addEventListener("click",function(event){
            event.preventDefault();

            editarForm[index].style.display = editarForm[index].style.display === "none" ? "block" : "none";
            
        });
        });
    </script>
</body>
</html>