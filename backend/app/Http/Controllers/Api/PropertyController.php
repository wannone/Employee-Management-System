<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Religion;
use App\Models\Group;
use App\Models\Unit;
use App\Models\Eselon;
use App\Models\Workplace;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religion = Religion::get();
        $group = Group::get();
        $eselon = Eselon::get();
        $workplace = Workplace::get();
        $unit = Unit::get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'religion' => $religion,
                'group' => $group,
                'eselon' => $eselon,
                'workplace' => $workplace,
                'unit' => $unit,
            ],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type){

        $value;
        switch ($type) {
            case 'religion':
                $value = Religion::get();
                break;
            case 'group':
                $value = Group::get();
                break;
            case 'eselon':
                $value = Eselon::get();
                break;
            case 'workplace':
                $value = workplace::get();
                break;
            case 'unit':
                $value = Unit::get();
                break;
            default:
                return response()->json([
                    'status' => 'error',
                    'message' => 'property not found',
                ], 404);
                break;
        }

        return response()->json([
            'status' => 'success',
            'data' => $value,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
