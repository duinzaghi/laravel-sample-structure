<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


/**
 * @OA\Tag(
 *     name="Files",
 *     description="File APIs",
 * )
 **/
class FileUploadController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/files/upload",
     *     tags={"Files"},
     *     summary="Upload file",
     *     description="Upload file",
     *     security={{"bearerAuth":{}}},
     *     operationId="uploadFile",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="file",
     *                     type="file",
     *                ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png, bmp, tiff'
            ]);
            $path = Storage::disk('public')->putFile('', $request->file('file'));
            $result = [
                'uri' => $path,
                'url' => env('APP_URL') . 'api/v1/files/' . $path
            ];
            return $this->responseSuccess($result, 200);

        } catch (\Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    public function getImage($filename)
    {
        try {
            $path = storage_path('app/public/' . $filename);
            $header = array(
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment',
                'filename' => $filename,
            );
            return Response::download($path, $filename, $header);
        } catch (\Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }
}
