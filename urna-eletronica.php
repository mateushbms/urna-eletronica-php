<?php

/*  Matéria de Técnicas de Programação I.
    Mateus Henrique e Jordan Willian.
    Urna eletrônica em linguagem PHP. 
    Data de finalização: 09/03/2022*/

    $voto=0;//inicialização de variáveis em zero
    $senha=0;
    $vseiya=0;
    $vash=0;
    $vgoku=0;
    $vbranco=0;
    $vnulo=0;
    $vtotal=0;
    $vvalidos=0;
    $aux=0;
    $aux1=0;
    $pcanduniverso=0;
    $pcandvalidos=0;
    
    //inserindo o id dos candidatos, valores branco e nulos na primeira coluna da matriz
    $M[0][0]="Seiya";
    $M[1][0]="Ash";
    $M[2][0]="Goku";
    $M[3][0]="Brancos";
    $M[4][0]="Nulos";
    
    $M[0][1]=0;//iniciando os valores em zero para a coluna dos valores de votos que será necessário iniciar em 0 para computar
    $M[1][1]=0;
    $M[2][1]=0;
    $M[3][1]=0;
    $M[4][1]=0;
    
    do
    {
        echo("Bem-vindo, eleitor, ao algoritmo em linguagem PHP de uma urna eletronica!\n");
        $senha = readline("Informe a senha para proseguir: ");
        
        while($senha!=1234)//solicitação da senha com laço de repetição
        {
            $senha = readline("Senha incorreta. Informe a senha: ");
        }
        system("clear");//limpar a tela da senha
        echo("Votação iniciada:\n");
        echo("Para votar no candidato 'Seiya', digite: '13'\nPara votar no candidato 'Ash Ketchum', digite: '10'\nPara votar no candidato 'Goku' digite: '8000'\n");//apresentar os candidatos e seus id' de votação
        echo("Para votar em branco digite '0', quaisquer outros valores serão considerados nulo.\n");
        $voto = readline("Informe seu voto: ");
        switch ($voto)//Contabilizar cada voto dos candidatos, votos brancos e votos nulos
        {
            case 13://voto para o seiya
                echo("Você votou no Seiya!");
                $vseiya=$vseiya+1;
                $M[0][1]=$M[0][1]+1;
            break;
            case 10://voto para o ash
                echo("Você votou no Ash!");
                $vash=$vash+1;
                $M[1][1]=$M[1][1]+1;
            break;
            case 8000://voto para o goku
                echo("Você votou no Goku!");
                $vgoku=$vgoku+1;
                $M[2][1]=$M[2][1]+1;
            break;
            case 0://voto em branco
                echo("Você votou branco!");
                $vbranco=$vbranco+1;
                $M[3][1]=$M[3][1]+1;
            break;
            default://voto nulo
                echo("Você votou nulo!");
                $vnulo=$vnulo+1;
                $M[4][1]=$M[4][1]+1;
        }
        
        //limpar a tela de voto
        sleep(2.5);
        system("clear");
        
        //computação de votos totais e votos válidos
        $vtotal=$vseiya+$vash+$vgoku+$vbranco+$vnulo;
        $vvalidos=$vseiya+$vash+$vgoku;
        
        //opção de realizar outro voto ou terminar a votação
        $resposta = readline("\nGostaria de realizar outro voto? Digite '1' para continuar ou '0' para parar? ");

        //Verificar se a resposta é 1 ou 0, além de garantir que o 0 será o valor de parada
        if($resposta != 1 && $resposta != 0)
        {
            while($resposta!=1 && $resposta!=0)
            {
                $resposta = readline("\nAviso: digite 1 para realizar mais um voto ou 0 para encerrar a votação: ");
            }
        }
        system("clear");
    }while($resposta==1 && $resposta!=0);
    
    
    //solicitação de senha para encerrar a votação
    $senha = readline("Informe a senha para encerrar a votação: ");
    
    //validação da senha
    while($senha!=1234)
    {
        $senha = readline("Senha incorreta. Informe a senha: ");
    }
    
    //ordenação por seleção decrescente dos candidatos com maiores votos
    for($i=0; $i<=3; $i++)
    {
        for($j=$i+1; $j<=4; $j++)
        {
            if($M[$i][1]<$M[$j][1])
            {
                $aux=$M[$i][0];
                $aux1=$M[$i][1];
                $M[$i][0]=$M[$j][0];
                $M[$i][1]=$M[$j][1];
                $M[$j][0]=$aux;
                $M[$j][1]=$aux1;
            }
        }
    }
    system("clear");
    //se o único voto for nulo, alterar o valor da variável para que não seja feito a tentativa de dividir por zero
    if($vtotal == 0 || $vvalidos == 0){
        if($vtotal == 0){
            $vtotal = 1;
        }
        else{
            $vvalidos = 1;
        }
    }
    for($i=0; $i<=4; $i++)
    {
        //cálculo da porcentagem de universo de votos, votos válidos e armazenamento na coluna 3 e 4
        $pcanduniverso=($M[$i][1]*100)/$vtotal;
        $pcandvalidos=($M[$i][1]*100)/$vvalidos;
        $M[$i][2]=$pcanduniverso;
        $M[$i][3]=$pcandvalidos;
    }
    
    //correção da porcentagem de votos válidos, zerando as posições de votos brancos e nulos
    for($i=0; $i<=4; $i++)
    {
        if($M[$i][0]=="Nulos" || $M[$i][0]=="Brancos")
        {
            $M[$i][3]=0;
        }
    }
    
    //exibição dos nomes das colunas
    echo("candidato - votos absolutos - porcentagem do universo de votos - porcentagem de votos validos (sem brancos e nulos)\n");
    
    //exibição ordenada dos candidatos - votos
    echo $M[0][0]."  -  ".$M[0][1]."  -  ".number_format($M[0][2], 2)."%  -  ".number_format($M[0][3], 2)."%\n";
    echo $M[1][0]."  -  ".$M[1][1]."  -  ".number_format($M[1][2], 2)."%  -  ".number_format($M[1][3], 2)."%\n";
    echo $M[2][0]."  -  ".$M[2][1]."  -  ".number_format($M[2][2], 2)."%  -  ".number_format($M[2][3], 2)."%\n";
    echo $M[3][0]."  -  ".$M[3][1]."  -  ".number_format($M[3][2], 2)."%  -  ".number_format($M[3][3], 2)."%\n";
    echo $M[4][0]."  -  ".$M[4][1]."  -  ".number_format($M[4][2], 2)."%  -  ".number_format($M[4][3], 2)."%\n";
    

?>
