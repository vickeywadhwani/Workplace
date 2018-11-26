<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorkplaceService;
use App\Http\Requests\WorkplaceRequest;
use App\Workplace;

class WorkplaceController extends Controller
{
    protected $workplace;

    /**
     * Injecting dependencies.
     *
     * @param WorkplaceService $workplace
     */
    public function __construct(WorkplaceService $workplace)
    {
        //
        $this->workplace = $workplace;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {

        $workplaces = $this->workplace->index();
        if(!$workplaces->isEmpty())
          {

          return response()->json($workplaces,200);
          }
        else
          {
          return response()->json(array("msg"=>"No data available."),422);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $workplace = $this->workplace->read($id);
        if($workplace)
          {
          return response()->json($workplace,200);
          }
        else
          {
          return response()->json(array("msg"=>"Record doesn't exist."),422);
          }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Htpp\Requests\WorkplaceRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WorkplaceRequest $request)
    {

        $workplace = $this->workplace->create($request);
        if($workplace)
          {
          return response()->json(array("msg"=>"Your data has been successfully saved.","data"=>$workplace), 201);
          }
        else
          {
          return response()->json(array("msg"=>"Something went wrong, please try again."), 422);
          }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Htpp\Requests\WorkplaceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WorkplaceRequest $request, $id)
    {
        //
        $updated = $this->workplace->update($request, $id);
        if($updated)
          {
            return response()->json(array("msg"=>"Data updated successfully."), 200);
          }
        else
          {
            return response()->json(array("msg"=>"Something went wrong, please check the id of the given item and try again."), 422);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $res = $this->workplace->delete($id);
        if($res)
          {
            return response()->json(array("msg"=>"Data deleted successfully"), 200);
          }
        else
          {
            return response()->json(array("msg"=>"Record doesn't exist."), 422);
          }

    }
}
