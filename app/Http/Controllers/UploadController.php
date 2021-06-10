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




                $destinationPath = "public/Attachments/".session('LoggedUser_CompanyID')."/SOF/";
                // For preview

                $file->storeAs($destinationPath, $completeFileName);






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

   

        




        // File Path is storage/app/public
        // return response()->download(storage_path('app/public/file.pdf'));

        // Dynamic Download
        return response()->download(storage_path('app/public/'.$posty->FileName));

        // For public folder
        // return response()->download(public_path('app/public/file.pdf'));

        // DD
        // dd($posty->FileName);




    }
  
}
