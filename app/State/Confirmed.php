<?php
namespace App\State;

use Spatie\ModelStates\State;

class Confirmed extends LendState
{
  public static $name = 'confirmed';

   public static  function title(): string
   {
       return 'Effectuée';
   }

   public static function description(): string
   {
       return 'Demande de prêt effectuée';
   }

}
