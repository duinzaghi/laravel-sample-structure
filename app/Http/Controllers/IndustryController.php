<?php

namespace App\Http\Controllers;

use App\Helpers\ValidateResponse;
use App\Models\Contact;
use App\Models\Industry;
use App\Models\Message;
use Illuminate\Http\Request;
use Validator;

/**
 * @OA\Tag(
 *     name="Industries",
 *     description="Industry APIs",
 * )
 **/
class IndustryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/industries",
     *     tags={"Industries"},
     *     summary="Get industries",
     *     description="Get industries list",
     *     security={{"bearerAuth":{}}},
     *     operationId="getIndustries",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        try {
            $result = Industry::get();
            if($result){
                return $this->responseSuccess($result);
            }else{
                return $this->responseSuccess([]);
            }

        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/industries",
     *     tags={"Industries"},
     *     summary="Create new industry",
     *     description="Create new industry",
     *     security={{"bearerAuth":{}}},
     *     operationId="createIndustry",
     *     @OA\RequestBody(
     *         description="Industry schemas",
     *         @OA\JsonContent(ref="#/components/schemas/Industry")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function store(Request $request, Industry $industry)
    {
        try {
            $input = $request -> all();
            $rules = Industry::$rules;
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                $errors = ValidateResponse::make($validator);
                return $this->responseError($errors,400);
            }
            $newIndustry = Industry::create($input);
            return $this->responseSuccess($newIndustry,201);
        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/industries/{id}",
     *     tags={"Industries"},
     *     summary="Get industry by id",
     *     description="Get industry by id API",
     *     security={{"bearerAuth":{}}},
     *     operationId="getIndustryByIdAPI",
     *     @OA\Parameter(
     *         description="industry id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function show(Request $request, $id)
    {
        try {
            $industryData = Industry::where("id", $id)->first();
            return $this->responseSuccess($industryData);
        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/industries/{id}",
     *     tags={"Industries"},
     *     summary="Update industry API",
     *     description="Update industry API",
     *     security={{"bearerAuth":{}}},
     *     operationId="updateIndustryAPI",
     *     @OA\Parameter(
     *         description="industry id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Industry schemas",
     *         @OA\JsonContent(ref="#/components/schemas/Industry")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = Industry::$updateRules;
            $input = $request->all();

            $industryData = Industry::where("id", $id)->first();
            if (empty($industryData)) {
                return $this->responseException('Not found industry', 404);
            }

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $errors = ValidateResponse::make($validator);
                return $this->responseError($errors, 400);
            }

            $industryData->update($input);

            return $this->responseSuccess($industryData, 201);

        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/industries/{id}",
     *     tags={"Industries"},
     *     summary="Delete industry API",
     *     description="Delete industry API",
     *     security={{"bearerAuth":{}}},
     *     operationId="deleteIndustryAPI",
     *     @OA\Parameter(
     *         description="industry id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $industryData = Industry::where("id", $id)->first();
            if (empty($industryData)) {
                return $this->responseException('Not found industry', 404);
            }
            Industry::destroy($id);
            return $this->responseSuccess("Delete industry success", 200);
        } catch (\Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }
}
