<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class GalleryController extends Controller
{
    //List Galleries
    private $table = 'galleries';

    public function index(){
        
        $galleries = DB::table($this->table)->get();
    	//die('Gallery/index');
        return view('gallery/index',compact('galleries'));
    }

    //Show create form
    public function create() {
        if(!Auth::check()){
            return \Redirect::route('gallery.index');
        }
        return view('gallery/create');
    }

    //Store Gallery
    public function store(Request $request) 
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $cover_image = $request->file('cover_image');
        $owner_id = 1;

        //Check Image uploaded
        if($cover_image){
            $cover_image_filename = $cover_image->getClientOriginalName();
            $cover_image->move(public_path('images'),$cover_image_filename);
        }else{
           $cover_image_filename = 'noimage.jpg';
        }

        DB::table($this->table)->insert([
                'name'          =>  $name,
                'description'   =>  $description,
                'cover_image'   =>  $cover_image_filename,
                'owner_id'      =>  $owner_id
                ]
            );

        //Set Message
        \Session::flash('message','Gallery Added');
        //Redirect 
        return \Redirect::route('gallery.index');
    }

    //SHow Gallery Photos
    public function show($id){
    	$gallery = DB::table($this->table)->where('id',$id)->first();

        $photos = DB::table('photos')->where('gallery_id',$id)->get();

        return view('gallery/show',compact('gallery','photos'));
    }
}
