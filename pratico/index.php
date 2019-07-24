<?php

    define('J','contatos.json'); //defindo uma constante para o nome do arquivo

   //função para validar dados do post
   function errosDoPost(){
       $erros =[];
       if (!isset($_POST['nome']) || $_POST['nome'] == '') {
           $erros[] = 'errNome';
       }

       if (!isset($_POST['email']) || $_POST['email'] == '') {
        $erros[] = 'errEmail';
        }

        return $erros;
   }
    
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

    //verificando o post
    $erros = errosDoPost();

    if($_POST){ //ver se tem conteudo

        if(count($erros) == 0){ //só vai executar se a quantidades de erros for 0
            //adicionar contato ao arquivo json
            addContato($_POST['nome'],$_POST['email']);
        }
    }

    else{
        $erros = [];
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
        <input <?= (in_array('errNome', $erros)? 'style="border:red 1px solid"' : ''); ?> type="text" name="nome" id="nome" placeholder="digite um nome">
        <input  type="email" name="email" id="email" placeholder="digite um email">
        <button type="submit">Salvar</button>
    </form>

</body>
</html>