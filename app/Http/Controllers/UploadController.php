<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UploadController extends Controller
{
    public function uploadview(){
        $post = DB::table('repository.otr_attachment')->where('id','1748')->first();
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
                    'IMG' => $image
                ]);
            }
        } 















    }


}
