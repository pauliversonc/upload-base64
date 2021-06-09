<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    public function uploadview(){
        $post = DB::table('repository.otr_attachment')->get();
        return view('upload', compact('post'));
    }

    public function save(Request $request){
        
        if($request->hasFile('file')){
            foreach($request->file as $file) {

                // $file
                $completeFileName = $file->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $randomized = rand();
                $newFileName = str_replace(' ', '', $fileNameOnly).'-'.$randomized.''.time().'.'.$extension;

                $image = base64_encode(file_get_contents($file));

                
                DB::table('repository.otr_attachment')->insert([
                    'FileName' => $completeFileName,
                    'IMG' => $image
                ]);
            }
        } 


    }

    public function download($id){
        $posty = DB::table('repository.otr_attachment')->where('Id',$id)->first();


  


        Storage::disk('public')->put($posty->FileName,base64_decode($posty->IMG));

        // Storage::disk('media')->url('HRTKD1607258351/HRTKD1607258351.jpg');
        // File Path is storage/app/public






    }


}
