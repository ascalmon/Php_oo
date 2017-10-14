<?php

namespace Classes\Controllers;                                          // Usado pelo use em index.php

use \Psr\Http\Message\ServerRequestInterface;    // Interfaces
use \Psr\Http\Message\ResponseInterface;

class ComprasController
{
  //public $compras;
  public function index(ServerRequestInterface $request, ResponseInterface $response)
  {
    $compras = [                                                            // Model
      ["titulo"=>"Carvão","descricao"=>"5Kg"],
      ["titulo"=>"Arroz","descricao" =>"1Kg"],
      ["titulo"=>"Cerveja","descricao" =>"Latão"],
    ];

    $this->lista = $compras;
    $listaHTML = "";
    foreach($compras as $key => $value){
      $listaHTML .='<li>'.$value["titulo"].' - '.$value["descricao"].'</li>';
    }
                                                                              // Cpntroller
    //$pagina = include '../classes/views/home.php';

      //$response->getBody()->getContents($pagina);             // Documentacao do SLIM
      //return $response;
      return $this->view('home', $response);
  }

  private function view($view, ResponseInterface $response)
  {
    $pagina = include '../classes/views/'.$view.'.php';
    $response->getBody()->getContents($pagina);
    return $response;
  }
}
 ?>
