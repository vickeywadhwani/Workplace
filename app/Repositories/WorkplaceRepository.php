<?php

namespace App\Repositories;

use App\Workplace;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;

class WorkplaceRepository
{
    protected $workplace;

    /**
     * Injecting dependencies.
     *
     * @param \App\Workplace $workplace
     */
    public function __construct(Workplace $workplace)
    {
        $this->workplace = $workplace;
    }

    /**
     * Get all workplaces
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        return $this->workplace->with('user')->orderBy('id', 'DESC')->get();

    }

    /**
     * Return a workplace matching with an id
     * @param  int  $id
     * @return \App\Workplace
     */
    public function find($id)
    {
        return $this->workplace->with('user')->find($id);

    }

    /**
     * Add/creat a new workplace
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Workplace
     */
    public function create(Request $request)
    {
        //
        $attributes = $request->all();


        if ($request->hasFile('image'))
        {
            $filerepo = new FileRepository();
            $storedPath = $filerepo->saveImage($request);
            $attributes['image'] = $storedPath;
         }
        return $this->workplace->create($attributes);
    }

    /**
     * Update a workplace matching with an id
    * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int
     */
    public function update($id, Request $request)
    {
        //
          $filerepo = new FileRepository();
          $workplace = $this->find($id);
          $attributes = $request->all();
          if ($request->hasFile('image'))
          {
              $filerepo->removeImage($workplace->image);
              $storedPath = $filerepo->saveImage($request);
              $attributes['image'] = $storedPath;
          }
          if($workplace)
            {
            return $workplace->update($attributes);
            }
          else
            {
            return false;
            }


    }

    /**
     * Delete a workplace matching with an id
     * @param  int  $id
     * @return boolean
     */
    public function  delete($id)
    {
        //
        $workplace = $this->find($id);
        if($workplace)
          {
          return $workplace->delete();
          }
        else
          {
          return false;
          }

    }

}
