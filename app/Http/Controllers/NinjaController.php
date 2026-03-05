<?php

namespace App\Http\Controllers;
use App\Models\Ninja;
use App\Models\Dojo;
use Illuminate\Http\Request;

class NinjaController extends Controller
{
    public function index() {

    $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);

    return view('ninjas.index', ["ninjas" => $ninjas ]);
}

        
    

    public function show(Ninja $ninja) {

    //fetch record with id
    //fetch a single record & pass into show view
    $ninja ->load('dojo');

    return view('ninjas.show', ["ninja"=>$ninja]);

    }

    public function create() {
     $dojos = dojo::all();   
    
    //render a create view (vith web form) to users
        return view('ninjas.create', ["dojos"=> $dojos]);

    }

    public function store(request $request) {
        //handle POST request to store a new ninja record in table
$validated = $request->validate([
        'name' => 'required|string|max:255',
        'skill' => 'required|integer|min:0|max:100',
        'bio' => 'required|string|min:20|max:1000',
        'dojo_id' => 'required|exists:dojos,id',
      ]);

Ninja::create($validated);

return redirect()->route('ninjas.index')->with('success', 'Ninja Created!');
}

public function destroy(Ninja $ninja) {
    //handle delete request to delete a ninja record from table
    $ninja->delete();

    return redirect()->route('ninjas.index')->with('successD', 'Ninja Deleted!');
}



}


/*
|-----------ninjas-----------|
| id | name  | bio  | dojo_id |
|----|-------|------|---------|
| 01 | mario | blah | 03      |
| 02 | yoshi | blah | 01      |
| 03 | peach | blah | 02      |
| 04 | toad  | blah | 03      |
|----------------------------|

|------------dojos------------|
| id | name | loc   | desc.. |
|----|------|-------|--------|
| 01 | abc  | UK    | blah   |
| 02 | def  | Spain | blah   |
| 03 | ghi  | Japan | blah   |
|-----------------------------|
*/

