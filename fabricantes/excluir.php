<?php
use ExemploCrudPoo\Fabricante;

require_once "../vendor/autoload.php";

$fabricante = new Fabricante();
$fabricante->setId($_GET['id']);
$fabricante->excluir();
header("location:visualizar.php");