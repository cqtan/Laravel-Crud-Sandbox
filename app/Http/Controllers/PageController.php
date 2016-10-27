<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Page;
use App\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'meh';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'Unused create page: check custom create in web.php';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Validation
      $rules = array (
               'menu_name' => 'required|min:3|max:30'
      );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
      }

      // DB: Create
      $page = new Page;
      $page->subject_id = $request->input('subject_id'); // Foreign Key!!!
      $page->menu_name = $request->input('menu_name');
      $page->position = $request->input('position');
      $page->visible = $request->input('visible');
      $page->content = $request->input('content');
      $page->save();

      Session::flash('message', 'Successfully created the Page: ' . $page->menu_name);
      return redirect()->route('manage_content');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $page = Page::find($id);
      return view('sites.pages.show_page')->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $page = Page::find($id);
      return view('sites.pages.edit_page')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Validation
      $rules = array (
               'menu_name' => 'required|min:3|max:30'
      );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
      }
      // Change Subject:
      $currentSubject = $request->input('subject');
      $subject = Subject::where('menu_name', $currentSubject)->first();

      // DB: Create
      $page = Page::find($id);
      $page->subject_id = $subject->id; // Foreign Key!!!
      $page->menu_name = $request->input('menu_name');
      $page->position = $request->input('position');
      $page->visible = $request->input('visible');
      $page->content = $request->input('content');
      $page->save();

      Session::flash('message', 'Successfully edited the Page: ' . $page->menu_name);
      return redirect()->route('manage_content');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $page = Page::find($id);
      $page_name = $page->menu_name;
      $page->delete();

      Session::flash('message', 'Successfully deleted the Page: ' . $page_name);
      return Redirect::to('manage_content');    }
}
