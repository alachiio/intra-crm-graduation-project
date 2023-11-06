<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class BaseController extends Controller
{
    protected $model;
    protected array $data = [];

    protected $permissions = [
        'index' => 'view',
        'create' => 'create',
        'show' => 'view',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete'
    ];

    public function __construct()
    {
        $action = request()->route()->getActionMethod();
        $permission = (array_key_exists($action, $this->permissions)) ? $this->permissions[$action] : null;
        if ($permission)
            $this->middleware('can:' . (new $this->model)->getTable() . '.' . $permission);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.' . $this->model::URL . '.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->form();
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->data['row'] = $this->model::where((new $this->model)->getRouteKeyName(), $id)->firstOrFail();
        return view('pages.' . $this->model::URL . '.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->form();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        if ($request->header('X-Type') === 'inline') {
            try {
                $this->model::whereId($id)->update($request->all());
                DB::commit();
                return response()->json(['success' => __('Data has been updated successfully')], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        try {
            $this->model::onlyTrashed()->find($id)->restore();
            DB::commit();
            return back()->with('toast', ['icon' => 'success', 'message' => __('Data has been restored successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('toast', ['icon' => 'error', 'message' => __('Something went wrong, Please Call the developer'), 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $row = $this->model::withTrashed()->find($id);
            $this->beforeDelete($row);
            if (Schema::hasColumn((new $this->model)->getTable(), 'deleted_at') and $row->trashed())
                $row->forceDelete();
            else
                $row->delete();
            $this->afterDelete($row);
            DB::commit();
            return back()->with('toast', ['icon' => 'success', 'message' => __('Data has been deleted successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('toast', ['icon' => 'error', 'message' => __('Something went wrong, Please Call the developer'), 'error' => $e->getMessage()]);
        }
    }

    /*
     * Pages Functions
     */

    protected function form()
    {
        return view('pages.' . $this->model::URL . '.form', $this->data);
    }

    protected function beforeDelete($row)
    {
    }

    protected function afterDelete($row)
    {
    }

    public function getModel()
    {
        return $this->model;
    }
}
