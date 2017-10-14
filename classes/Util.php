<?php
namespace Classes;                      // Usado pelo use em index.php

class Util
{
  public static function trataValor($valor)
  {
    return "R$ ".number_format($valor,2,',','.');
  }
}
