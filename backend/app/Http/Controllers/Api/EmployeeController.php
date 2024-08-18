<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Religion;
use App\Models\Group;
use App\Models\Eselon;
use App\Models\Workplace;
use Illuminate\Http\Request;
use PDF;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employees = Employee::with(['information', 'employment'])->get();

            $result = $employees->map(function ($employee) {
                return [
                    'nip' => $employee->nip,
                    'name' => $employee->name,
                    'birthplace' => optional($employee->information)->birthplace,
                    'birthdate' => optional($employee->information)->birthdate,
                    'address' => optional($employee->information)->address,
                    'gender' => optional($employee->information)->gender,
                    'group' => optional($employee->employment->group)->name,
                    'eselon' => optional($employee->employment->eselon)->name,
                    'position' => optional($employee->employment)->position,
                    'workplace' => optional($employee->employment->workplace)->name,
                    'religion' => optional($employee->information->religion)->name,
                    'unit' => optional($employee->employment->unit)->name,
                    'phone' => optional($employee->information)->phone,
                    'npwp' => optional($employee->information)->npwp,
                ];
            });        

        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
    
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nip' => 'required | string | min: 12 | max:12 | unique:employee',
                'name' => 'required | string',
                'birthplace' => 'required | string',
                'birthdate' => 'required | date',
                'address' => 'required | string',
                'gender' => 'required | string | in:M,F',
                'group' => 'required | integer | exists:group,id',
                'eselon' => 'required | integer | exists:eselon,id',
                'position' => 'required | string',
                'workplace' => 'required | integer | exists:workplace,id',
                'religion' => 'required | integer | exists:religion,id',
                'unit' => 'required | integer | exists:unit,id',
                'phone' => 'required | string',
                'npwp' => 'required | string',
            ]);
    
            $employee = Employee::create([
                'nip' => $validated['nip'],
                'name' => $validated['name'],
            ]);
    
            $employee->information()->create([
                'nip' => $validated['nip'],
                'birthplace' => $validated['birthplace'],
                'birthdate' => $validated['birthdate'],
                'address' => $validated['address'],
                'gender' => $validated['gender'],
                'religion_id' => $validated['religion'],
                'phone' => $validated['phone'],
                'npwp' => $validated['npwp'],
            ]);
            
            $employee->employment()->create([
                'nip' => $validated['nip'],
                'group_id' => $validated['group'],
                'eselon_id' => $validated['eselon'],
                'position' => $validated['position'],
                'workplace_id' => $validated['workplace'],
                'unit_id' => $validated['unit'],
            ]);
    
            return response()->json([
                'status' => 'success',
                'data' => $employee,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // HTTP status code 422 Unprocessable Entity
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
    
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
        
    }

    public function upload(Request $request, string $id)
    {
        try {
            $employee = Employee::with(['information'])->where('nip', $id)->firstOrFail();

            if (!$employee) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee not found',
                ], 404); // HTTP status code 404 for not found
            }

            $validated = $request->validate(['image' => 'required | image | max:2048']);
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique file name
        
                // Store the image in the 'public/images' directory
                $path = $image->storeAs('images', $imageName, 'public'); // Save to 'storage/app/public/images'
        
                // Optionally, save the image path to the database
                $employee->information->update(['image_url' => $path]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'image_url' => $path,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // HTTP status code 422 Unprocessable Entity

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors

        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employees = Employee::with(['information', 'employment'])->where('nip', $id)->get();

            $result = $employees->map(function ($employee) {
                return [
                    'nip' => $employee->nip,
                    'name' => $employee->name,
                    'birthplace' => optional($employee->information)->birthplace,
                    'birthdate' => optional($employee->information)->birthdate,
                    'address' => optional($employee->information)->address,
                    'gender' => optional($employee->information)->gender,
                    'group' => optional($employee->employment->group)->id,
                    'eselon' => optional($employee->employment->eselon)->id,
                    'position' => optional($employee->employment)->position,
                    'workplace' => optional($employee->employment->workplace)->id,
                    'religion' => optional($employee->information->religion)->id,
                    'unit' => optional($employee->employment->unit)->id,
                    'phone' => optional($employee->information)->phone,
                    'npwp' => optional($employee->information)->npwp,
                    'image_url' => optional($employee->information)->image_url ?? null,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $result,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
    
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $employee = Employee::with(['information', 'employment'])->where('nip', $id)->firstOrFail();

            if (!$employee) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee not found',
                ], 404); // HTTP status code 404 for not found
            }

            $validated = $request->validate([
                'nip' => 'required | string | min: 12 | max:12 | exists:employee',
                'name' => 'required | string',
                'birthplace' => 'required | string',
                'birthdate' => 'required | date',
                'address' => 'required | string',
                'gender' => 'required | string | in:M,F',
                'group' => 'required | integer | exists:group,id',
                'eselon' => 'required | integer | exists:eselon,id',
                'position' => 'required | string',
                'workplace' => 'required | integer | exists:workplace,id',
                'religion' => 'required | integer | exists:religion,id',
                'unit' => 'required | integer | exists:unit,id',
                'phone' => 'required | string',
                'npwp' => 'required | string',
            ]);

            $employee->update([
                'name' => $validated['name'],
            ]);

            $employee->information()->update([
                'nip' => $validated['nip'],
                'birthplace' => $validated['birthplace'],
                'birthdate' => $validated['birthdate'],
                'address' => $validated['address'],
                'gender' => $validated['gender'],
                'religion_id' => $validated['religion'],
                'phone' => $validated['phone'],
                'npwp' => $validated['npwp'],
            ]);
            
            $employee->employment()->update([
                'nip' => $validated['nip'],
                'group_id' => $validated['group'],
                'eselon_id' => $validated['eselon'],
                'position' => $validated['position'],
                'workplace_id' => $validated['workplace'],
                'unit_id' => $validated['unit'],
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $employee,
            ]);
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); // HTTP status code 422 Unprocessable Entity
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
    
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::with(['information', 'employment'])->where('nip', $id)->firstOrFail();

            if (!$employee) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee not found',
                ], 404); // HTTP status code 404 for not found
            }

            $employee->information()->delete();
            $employee->employment()->delete();
            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions (e.g., foreign key constraint failures)
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
    
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // HTTP status code 500 for server errors
        }
    }

    public function download() {
        $employees = Employee::with(['information', 'employment'])->get();

        $data = $employees->map(function ($employee) {
            return [
                'nip' => $employee->nip,
                'name' => $employee->name,
                'birthplace' => optional($employee->information)->birthplace,
                'birthdate' => optional($employee->information)->birthdate,
                'address' => optional($employee->information)->address,
                'gender' => optional($employee->information)->gender,
                'group' => optional($employee->employment->group)->name,
                'eselon' => optional($employee->employment->eselon)->name ?? '-',
                'position' => optional($employee->employment)->position,
                'workplace' => optional($employee->employment->workplace)->name,
                'religion' => optional($employee->information->religion)->name,
                'unit' => optional($employee->employment->unit)->name,
                'phone' => optional($employee->information)->phone,
                'npwp' => optional($employee->information)->npwp,
            ];
        });         

        $pdf = PDF::loadView('employeePDF', ['data' => $data])->setPaper('a4', 'landscape');
        
        return $pdf->download('employee.pdf');
    }
}
