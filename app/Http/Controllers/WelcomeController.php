<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
   public function index()
    {
         $contents =fopen(storage_path('app/public/mock.txt'),'r');
         
         while(!feof($contents))
         { 
            $line = fgets($contents);  
            $list= (explode(",",$line)); 
            $columns=array("id","first_name","last_name","gender","lat","lon");
            $result[] = array_combine($columns, $list);
         }
           fclose($contents);
           
           return $result;
    }
}
