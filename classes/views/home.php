<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Principal</title>
  </head>
  <body>
    <h2>Essa e a página principal</h2>
    <p>Lista de Compras</p>
    <ul>
      <?php foreach($this->lista as $key => $value): ?>
        <li><?php echo $value['titulo'];?> - <?php echo $value['descricao'];?></li>
      <?php endforeach ?>
    </ul>

  </body>
</html>
