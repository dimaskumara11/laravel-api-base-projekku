<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyInsertRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\CompanyModel;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $companyModel;
    private $responseHelper;
    public function __construct()
    {
        $this->companyModel = new CompanyModel();
        $this->responseHelper = new ResponseHelper();
    }
    public function get(Request $request): JsonResponse
    {
        $data = $request->page ? (new CompanyService())->pagination($request) : (new CompanyService())->list($request);
        return response()->custom($data ? $this->responseHelper->responseFound($data) : $this->responseHelper->responseNotFound(null));
    }
    public function detail($id): JsonResponse
    {
        $data   = $this->companyModel->with("getSector")->find($id);
        return response()->custom($data ? $this->responseHelper->responseFound($data) : $this->responseHelper->responseNotFound(null));
    }
    public function create(CompanyInsertRequest $request): JsonResponse
    {
        $data   = $this->companyModel;
        $data->sector_id = $request->sector_id;
        $data->logo = $request->logo;
        $data->name = $request->name;
        $data->owner_name = $request->owner_name;
        return response()->custom($data->save() ? $this->responseHelper->responseInsertSuccess(["id"=>$data->id]) : $this->responseHelper->responseInsertFail(null));
    }
    public function update(CompanyUpdateRequest $request, $id): JsonResponse
    {
        $data   = $this->companyModel->find($id);
        if(empty($data))
            return response()->custom($this->responseHelper->responseValidation("ID ".__("messages.invalid")));
        $data->sector_id = $request->sector_id;
        $data->logo = $request->logo;
        $data->name = $request->name;
        $data->owner_name = $request->owner_name;
        return response()->custom($data->save() ? $this->responseHelper->responseUpdateSuccess(["id"=>$id]) : $this->responseHelper->responseUpdateFail(null));
    }
    public function delete($id): JsonResponse
    {
        $data   = $this->companyModel->find($id);
        if(empty($data))
            return $this->responseHelper->responseValidation("ID ".__("messages.invalid"));
        return response()->custom($data->delete() ? $this->responseHelper->responseDeleteSuccess(["id"=>$id]) : $this->responseHelper->responseDeleteFail(null));
    }
}
