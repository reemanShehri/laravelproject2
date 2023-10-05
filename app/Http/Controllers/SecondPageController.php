<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecondPageController extends Controller
{
    //

    public function indexx()
    {
        return view('admin.category.create1'); // This assumes you have a 'second-page.blade.php' view.
    }
}
