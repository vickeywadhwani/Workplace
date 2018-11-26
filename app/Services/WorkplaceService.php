<?php

namespace App\Services;

use App\Repositories\WorkplaceRepository;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;

class WorkplaceService
{
    protected $workplace;

    /**
     * Injecting dependencies.
     *
     * @param \App\Repositories\WorkplaceRepository $workplace
     */
    public function __construct(WorkplaceRepository $workplace)
    {
        //
        $this->workplace = $workplace;
    }

    /**
     * Get all workplaces
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->workplace->all();
    }

    /**
     * Add/creat a new workplace
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Workplace
     */
    public function create(Request $request)
    {

        return $this->workplace->create($request);
    }

    /**
     * Return a workplace matching with an id
     * @param  int  $id
     * @return \App\Workplace
     */
    public function read($id)
    {
        //
        return $this->workplace->find($id);
    }

    /**
     * Update a workplace matching with an id
    * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int
     */
    public function update(Request $request, $id)
    {
        //
        return $this->workplace->update($id, $request);
    }

    /**
     * Delete a workplace matching with an id
     * @param  int  $id
     * @return boolean
     */
    public function  delete($id)
    {
        //
        return $this->workplace->delete($id);
    }
}
