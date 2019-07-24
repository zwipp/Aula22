<?php

    define('J','contatos.json'); //defindo uma constante para o nome do arquivo

    //carregando o conteudo do arquivo para uma variavel
    
    function getContatos(){ //coloca em uma função pois será usados diversas vezes

        $json = file_get_contents(J); //pegando o conteudo do arquivo e jogando em uma variavel
        $contatos = json_decode($json,true); //transformando o arquivo em um array
        return $contatos;
    }

    //função que add contato ao json
    function addContato($nome,$email){
        //carregando os contatos
        $contatos = getContatos();

        //add um novo contato ao array de contatos
        $contatos[] = [
            'nome'=> $nome,
            'email' => $email
        ];
        //transformar o array contatos em uma string json
        $json = json_encode($contatos);

        //salvar a string json no arquivo
        file_put_contents(J,$json);
    }

    if($_POST){ //ver se tem conteudo
        //adicionar contato ao arquivo json
        addContato($_POST['nome'],$_POST['email']);
    }

    $contatos = getContatos();

?>


<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <ul>
        <?php foreach($contatos as $c): ?>
            <li>
                <span><?= $c['nome'];?></span> :
                <span><?= $c['email'];?></span>
            </li>
        <?php endforeach?>
    </ul>
    
    <form action="index.php" method="post">
        <input required type="text" name="nome" id="nome" placeholder="digite um nome">
        <input required type="email" name="email" id="email" placeholder="digite um email">
        <button type="submit">Salvar</button>
    </form>

</body>
</html>