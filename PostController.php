<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
* create
*
* @return void
*/
public function create()
{
  return view('post.create');
}
    
/**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
  $this->validate($request, [
     'image'     => 'required|image|mimes:png,jpg,jpeg',
     'title'     => 'required',
     'content'   => 'required'
  ]);

  //upload image
  $image = $request->file('image');
  $image->storeAs('public/posts', $image->hashName());

  $post = Post::create([
      'image'     => $image->hashName(),
      'title'     => $request->title,
      'content'   => $request->content
  ]);

  if($post){
    //redirect dengan pesan sukses
    return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
  }

}
}
