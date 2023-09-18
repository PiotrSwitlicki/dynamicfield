<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index() {
    $fields = Field::all();
    return view('form', compact('fields'));
	}

	public function store(Request $request) {

	    $fields = $request->input('fields', []);
	    $fieldIds = $request->input('field_ids', []);

	    foreach ($fields as $index => $value) {
	        if (isset($fieldIds[$index])) {
	            $field = Field::find($fieldIds[$index]);
	            if ($field) {
	                $field->update(['value' => $value]);
	            }
	        } else {
	            if (!empty($value)) {
	                Field::create(['value' => $value]);
	            }
	        }
	    }

	    return redirect('/form')->with('success', 'Dane zostały zapisane.');
	}

	public function destroy(Field $field) {
	    $field->delete();
	    return redirect('/form')->with('success', 'Pole zostało usunięte.');
	}
}
