<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AutoModel;

class ModelsController extends Controller
{
    public function showByMark($id)
    {
        return response()->json(AutoModel::where('mark_id', $id)->get());
    }
}
