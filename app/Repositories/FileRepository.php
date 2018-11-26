<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileRepository
{
    /**
   * save Image and return its absolute path
   *
   * @return string
   */
    public function saveImage(Request $request)
    {
        //
        $fileName = "fileName".time().'.'.request()->image->getClientOriginalExtension();
        $storedPath = $request->image->storeAs('media',$fileName);
        return asset("storage/".$storedPath);
    }

    /**
   * remove Image from media directory
   *
   * @return boolean
   */
    public function removeImage($filename)
    {
      $filename = str_replace(asset('storage/'),"",$filename);
      return Storage::delete($filename);
    }

}
