<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
class SlideController extends Controller
{
    //
  function __construct()
  {
  	$slide=Slide::all();
  view()->share('slide',$slide);
  }
}
