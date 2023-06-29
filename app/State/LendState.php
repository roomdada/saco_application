<?php
namespace App\State;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;


abstract class LendState extends State
{
 abstract public static function title(): string;

 abstract public static function description(): string;

 public static function config(): StateConfig
 {
     return parent::config()
         ->default(Confirmed::class)
         ->allowTransition(Confirmed::class, Validated::class)
         ->allowTransition(Confirmed::class, Cancelled::class)
         ->allowTransition(Validated::class, Cancelled::class)
         ->allowTransition(Validated::class, Rejected::class)
         ->allowTransition(Validated::class, Completed::class)
     ;
 }

}
