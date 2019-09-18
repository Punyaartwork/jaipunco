<?php

namespace App\Http\Controllers;
use App\Photo;
use Illuminate\Http\Request;
//เรียกใช้ library Input แล้วสร้าง alias ว่า Input
use Illuminate\Support\Facades\Input as Input;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all()->toArray();
        return view('photo.index',compact('photos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Session::has('boon_id')){
            return view('photo.create');
        }else{
            return redirect()->route('boon.create');    
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $data = $request->image;
    
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
    
    
            $data = base64_decode($data);
            $image_name= time().'.jpg';
            $path = public_path() . "/photos/" . $image_name;
    
    
            file_put_contents($path, $data);

            return $image_name;
            /*
            $photo = new Photo(
            [
                'boon_id'=>$request->get('boon_id'),
                'photo'=>'/'.'photos/'.$image_name
            ]
            );
            $photo->save();
            return response()->json(['id'=>$photo->id]);
            */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        return response()->json($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('photo.edit',compact('photo','id'));
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
        $this->validate($request,[
            'boon_id'=>'required',
            'photo'=>'required',
            ]);        
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $time = time().".png";
            //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
            $file->move('photos/', $file->getClientOriginalName());
            rename('photos/'.$file->getClientOriginalName(),'photos/'.$time);
        }
        $photo = Photo::find($id);
        $photo->boon_id = $request->get('boon_id');
        $photo->photo = '/'.'photos/'.$time;
        $photo->save();
        return redirect()->route('photo.index')->with('success','!!!!!!EDITED!!!!!!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $boon_id = $photo->boon_id;
        unlink('.'.$photo->photo);
        $photo->delete();
        return redirect()->route('photo.create')->with('boon_id',$boon_id );
    }
}
