<?php
namespace App\State;

use Spatie\ModelStates\State;

class Validated extends LendState
{
  public static $name = 'validated';

   public static function title(): string
   {
       return 'Validée';
   }

   public static function description(): string
   {
       return 'Demande de prêt validée par le responsable';
   }

}
