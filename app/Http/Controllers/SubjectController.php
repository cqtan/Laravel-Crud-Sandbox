<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class SubjectController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    echo 'well...';
  }

  // C: Part 1 Form
  public function create()
  {
    return view('sites.subjects.create_subject');
  }

  // C: Part 2 Save
  public function store(Request $request)
  {
    // Validation
    $rules = array (
             'menu_name' => 'required|min:3|max:30'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('subject/create')
                         ->withErrors($validator)
                         ->withInput();
    }

    // DB: Create
    $subject = new Subject;
    $subject->menu_name = $request->input('menu_name');
    $subject->position = $request->input('position');
    $subject->visible = $request->input('visible');
    $subject->save();

    Session::flash('message', 'Successfully created the Subject: ' . $subject->menu_name);
    return redirect()->route('manage_content');
  }

  public function show($id)
  {
    echo 'show';
  }

  // U: Part 1 Form
  public function edit($id) {
    $subject = Subject::find($id);
    return view('sites.subjects.edit_subject')
              ->with('subject', $subject);
  }

  // U: Part 2 Save
  public function update(Request $request, $id)
  {
    // Validation
    $rules = array (
             'menu_name' => 'required|min:3|max:30'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('subject/' . $id . '/edit')
                         ->withErrors($validator)
                         ->withInput();
    } else {
      $subject = Subject::find($id);
      $subject->menu_name = $request->input('menu_name');
      $subject->position = $request->input('position');
      $subject->visible = $request->input('visible');
      $subject->save();

      Session::flash('message', 'Successfully edited the Subject: ' . $subject->menu_name);
      return redirect()->route('manage_content');
    }


  }

  public function destroy($id)
  {
    $subject = Subject::find($id);
    $subject_name = $subject->menu_name;
    $subject->delete();

    Session::flash('message', 'Successfully deleted the Subject: ' . $subject_name);
    return Redirect::to('manage_content');
  }

}
