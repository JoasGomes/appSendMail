<?php

    //print_r($_POST);

    class Mensagem {
        //variáveis que vão conter os dados do form
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($atributo){
            return $this->$atributo;
        }

        //função para setar os valores do form para as variáveis
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        //testando se a msg é valida 
        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }

            return true;
        }
    }

    $mensagem = new Mensagem();

    //setando os valores do form para as variáveis do doc php
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    //print_r($mensagem);

    if($mensagem->mensagemValida()){
        echo 'mensagem é valida';
    } else {
        echo 'mensagem inválida';
    }





?>