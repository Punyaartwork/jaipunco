<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;


class ImageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCrop()
    {
        return view('user.crop');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCropPost(Request $request)
    {
        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/profile/" . $image_name;


        file_put_contents($path, $data);

        $user  = User::find(Session::get('user_id'));
        $user ->profile = "/profile/" . $image_name;
        $user ->save();  


        return response()->json(['success'=>'done']);
    }
}