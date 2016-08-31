<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class PhotoController extends Controller
{
    private $table = 'photos';
    //Show create form
    public function create($gallery_id) {
    	if(!Auth::check()){
            return \Redirect::route('gallery.index');
        }
        return view('photo/create',compact('gallery_id'));
    }

    //Store photos
    public function store(Request $request){
        $title = $request->input('title');
        $description = $request->input('description');
        $location = $request->input('location');
        $image = $request->file('image');
        $owner_id = 1;
        $gallery_id = $request->input('gallery_id');

        //Check Image uploaded
        if($image){
            $image_filename = $image->getClientOriginalName();
            $image->move(public_path('images'),$image_filename);
        }else{
           $image_filename = 'noimage.jpg';
        }

        DB::table($this->table)->insert([
                'title'         =>  $title,
                'description'   =>  $description,
                'location'      =>  $location,
                'image'         =>  $image_filename,
                'gallery_id'    =>  $gallery_id,
                'owner_id'      =>  $owner_id
                ]
            );

        //Set Message
        \Session::flash('message','Photo Added');
        //Redirect 
        return \Redirect::route('gallery.show',array('id' => $gallery_id));
    }

    //SHow Photos details
    public function details($id){
    	$photo = DB::table($this->table)->where('id',$id)->first();

        return view('photo/details',compact('photo'));
    }
    
}
