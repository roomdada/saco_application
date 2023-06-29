<?php
namespace App\State;

class Completed extends LendState
{
  public static $name = 'completed';

   public static function title(): string
   {
       return 'Approuvée';
   }

   public static function description(): string
   {
       return 'Demande de prêt approuvée';
   }

}
