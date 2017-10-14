<?php
/*
spl_autoload_register(function ($class_name) {              // Carrega todas as referencias de classe que nao estiverem presentes
if (file_exists($class_name. '.php')){
  include $class_name. '.php';
}elseif(file_exists('class/'. $class_name. '.php')){
  include 'class/'. $class_name. '.php';
}
});
*/

require __DIR__ . '/vendor/autoload.php';                   // gerado pelo composer modelo psr-4
use Classes\Util;
use Classes\SiteInfo;

interface IUsuario
{
  public function alteraSenha($senha);
  public function getNome();
}

abstract class Usuario implements IUsuario                    // Usada como modelo - Class abstrata - Nao cria objetos
{
  public $id;
  public $nome;
  public $email;
  //private $senha;             // So esta classe tem acesso a este atributo
  protected $senha;
  public $assinante;

  public function alteraSenha($senha)
  {
    $this->senha = sha1($senha);
  }

  public function getTelefone()
  {
    return $this->telefone;
  }

  abstract public function getNome();       // Forca as classes que herdam a implementar este metodo
}

class Admin extends Usuario implements IUsuario
{
  public function setSenha($senha)
  {
    $senha = $senha.$this->email;
    //Usuario::alteraSenha($senha);               // Pode se usar o nome da classe herdada
    parent::alteraSenha($senha);                  // ou pode se usar o <parent> no lugar do nome da class
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function getNome()                                   // Obrigada a implementacao pelo abstract em Usuario
  {
    return $this->nome;
  }

}

class Gerente extends Usuario implements IUsuario
{
  public function getNome()                                   // Obrigada a implementacao pelo abstract em Usuario
  {
    return $this->nome;
  }

  public function alteraSenha($senha)
  {
    $this->senha = sha1($senha);
  }
}

class Vendedor extends Usuario implements IUsuario
{
  public function getNome()                                   // Obrigada a implementacao pelo abstract em Usuario
  {
    return $this->nome;
  }

  public function alteraSenha($senha)
  {
    $this->senha = sha1($senha);
  }
}


class Cliente extends Usuario implements IUsuario
{
  /* Heranca de usuarios
  public $id;
  public $nome;
  public $email;
  private $senha;
  public $assinante;
  */
  public function exibeNome()
  {
    return 'Nome: ' . $this->nome;
  }

  public function getNome()                                   // Obrigada a implementacao pelo abstract em Usuario
  {
    return $this->nome;
  }

  public function alteraSenha($senha)
  {
    $this->senha = sha1($senha);
  }
  /* Movida para a class Usuario por ter variavel privada $senha
  public function AlteraSenha($senha)
  {
    $this->senha = sha1($senha);
  }
  */
}

class Assinatura
{
  private $id;
  private $id_cliente;
  private $titulo;
  private $valor;

  public function __construct($id = null,$id_cliente = null,$titulo = null,$valor = null)
  {
    $this->id = $id;
    $this->id_cliente = $id_cliente;
    $this->titulo = $titulo;
    $this->valor = $valor;
  }

  public function exibeAssinatura()
  {
    $html = "<p>";
    $html .="<b>Id: </b>".$this->id;
    $html .= "</p>";

    $html .= "<p>";
    $html .="<b>Id Cliente: </b>".$this->id_cliente;
    $html .= "</p>";

    $html .= "<p>";
    $html .="<b>Titulo: </b>".$this->titulo;
    $html .= "</p>";

    $html .= "<p>";
    //$html .="<b>Valor: </b>".$this->trataValor($this->valor);
    $html .="<b>Valor: </b>".Util::trataValor($this->valor);
    $html .= "</p>";
    echo $html;
  }

  private function trataValor($valor)
  {
    return "R$ ".number_format($valor,2,',','.');
  }


  public function setId($valor)         // Setters
  {
    $this->id = $valor;
  }

  public function getId()         // Getters
  {
    return $this->id;
  }

  public function setId_cliente($valor)         // Setters
  {
    $this->id_cliente = $valor;
  }

  public function getId_cliente()         // Getters
  {
    return $this->id_cliente;
  }

  public function setTitulo($valor)         // Setters
  {
    $this->titulo = $valor;
  }

  public function getTitulo()         // Getters
  {
    return $this->titulo;
  }

  public function setValor($valor)         // Setters
  {
    $this->valor = $valor;
  }

  public function getValor()         // Getters
  {
    return $this->valor;
  }
}


$cl = new Cliente();
$cl->nome = 'Antonio Calmon';
$cl->id = 1;
$cl->email = 'teste@teste.com';
//$cl->senha = '123456';
$cl->alteraSenha('123456');
$cl->telefone = '3079043556';
$cl->assinante = true;

$assinaturaCl = new Assinatura(1,$cl->id,"Assinatura Vip",75.90);

/* Outro metodo alem do construct
$assinaturaCl->setId(1);
$assinaturaCl->setId_cliente($cl->id);
$assinaturaCl->setTitulo("Assinatura Vip");
$assinaturaCl->setValor(75.90);
*/
echo $assinaturaCl->getValor();
$assinaturaCl->exibeAssinatura();

$cl_admin = new Admin();
$cl_admin->nome = 'Vanessa';
$cl_admin->id = 1;
$cl_admin->email = 'vanessa@teste.com';
$cl_admin->setSenha('654321');
echo 'Senha: '.$cl_admin->getSenha();
$cl_admin->telefone = '999993556';
$cl_admin->assinante = true;
var_dump($cl_admin);

$vend = new Vendedor();
$vend->nome = 'Antonio';
$vend->id = 1;
$vend->email = 'antonio@teste.com';
$vend->alteraSenha('000000');
$vend->telefone = '0000003556';
$vend->assinante = true;
var_dump($vend);

echo 'Nome do site: '.SiteInfo::$nome;
echo "<br>";
echo 'Descricao do site: '.SiteInfo::$descricao;
echo "<br>";
 ?>
