<?php
namespace App\State;

class Cancelled extends LendState
{
  public static $name = 'cancelled';

   public static function title(): string
   {
       return 'Annulée';
   }

   public static function description(): string
   {
       return 'Demande de prêt annulée';
   }

}
