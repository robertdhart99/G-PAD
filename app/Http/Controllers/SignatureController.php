<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Signature;
 
class SignatureController extends Controller
{
    public function index()
    {
        return view('signature-pad');
    }
 
    public function store(Request $request)
    {
        $folderPath = public_path('uploads/');
       
        $image_parts = explode(";base64,", $request->signed);
             
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);
 
        $signature = uniqid() . '.'.$image_type;
           
        $file = $folderPath . $signature;
 
        file_put_contents($file, $image_base64);
 
        $save = new Signature;
        $save->name = $request->name;
        $save->signature = $signature
        $save->save();
    
 
        return back()->with('success', 'Form successfully submitted with signature');
    }
}