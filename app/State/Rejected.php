<?php
namespace App\State;

class Rejected extends LendState
{
  public static $name = 'rejected';

   public static function title(): string
   {
       return 'Rejetée';
   }

   public static function description(): string
   {
       return 'Demande de prêt rejetée';
   }

}
