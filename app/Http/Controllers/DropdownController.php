<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dropdown;
class DropdownController extends Controller
{
    
    public function getDropdownList(Request $request){
        $table_name = $request->table_name;
        $id = $request->id;
        $name = $request->name;
        $parent_id = $request->parent_id;
        $parent_name_id = $request->parent_name_id;
        $data = Dropdown::getDropdownLists($table_name, $id, $name, $parent_id, $parent_name_id);
        return response()->json($data);
     }  
}
