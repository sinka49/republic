<?php

namespace republic\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Columns\Column\Action;
use SleepingOwl\Admin\Exceptions\ValidationException;
use SleepingOwl\Admin\Repositories\Interfaces\ModelRepositoryInterface;
use SleepingOwl\Admin\Models\ModelItem;
use SleepingOwl\Admin\Session\QueryState;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\View\View;
use republic\Http\Requests;
use republic\Http\Controllers\Controller;

class AdminPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content = view('admin.places.create');
        return Admin::view($content, 'Создание нового места');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(/*Request $request=null, $id=null*/)
    {

        $content = 'my page aa';
        return Admin::view($content, 'My Page Title');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
