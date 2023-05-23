<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaUploadFileRequest;
use App\Models\MediaModel;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    private $mediaModel;
    private $responseHelper;
    public function __construct()
    {
        $this->mediaModel = new MediaModel();
        $this->responseHelper = new ResponseHelper();
    }

    public function uploadFile(MediaUploadFileRequest $request)
    {
        $filename   = rand()."-".rand().".".$request->file->getClientOriginalExtension();
        $pathFile   = $request->folder_name."/".$filename;
        Storage::put($pathFile, $request->file);

        $data           = $this->mediaModel;
        $data->path     = $pathFile;
        $data->filename = $request->file_name ? : $filename;
        $data->is_used  = false;
        return response()->custom($data->save() ? $this->responseHelper->responseInsertSuccess(["id"=>$data->id]) : $this->responseHelper->responseInsertFail(null));
    }
}