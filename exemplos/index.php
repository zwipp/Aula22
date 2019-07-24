<?php

    //abrir um arquivo para escrita
    echo('tentando abrir arquivo <br>');

    $f = fopen('arquivo.txt','w');
    if(!$f){  //se ele não abrir o arquivo ele irá printar o texto na tela
        die('Falha!!!');
    }

    //escrever alguma coisa nele
    for($i = 0 ;$i < 5 ;$i++){
        fwrite($f,"\ntexto a ser escrito");
        echo('escreveu <br>');
    }

    //fechando o arquivo
    fclose($f);

    //escrevendo o conteudo do arquivo simplificado
    $lorem = "\napagou\n";
    file_put_contents('arquivo.txt',$lorem,FILE_APPEND); //FILE_APPEND - para nao sobreescrever o que já estava escrito


?>