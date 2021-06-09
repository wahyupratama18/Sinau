<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\{Material, MaterialFile};
use App\Traits\{EnrollTraits, SummernoteUpload};
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    use EnrollTraits, SummernoteUpload;

    public function __construct()
    {
        $this->middleware('teacher')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Save
    */
    private function saved(Request $request, int $id = null)
    {
        $request->validate([
            'type' => 'required|integer|between:1,2',
            'title' => 'required|string',
            'description' => 'required|string',
            'opened_at' => 'nullable|date_format:H:i',
            'closed_at' => 'nullable|date_format:H:i|after:opened_at'
        ]);

        Material::updateOrCreate(['id' => $id], [
            'meet_id' => $request->meet,
            'title' => $request->title,
            'description' => $this->upload($request->description, 'images'),
            'type' => $request->type,
            'opened_at' => $request->opened_at,
            'closed_at' => $request->closed_at
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $course, int $meet)
    {
        $m = new Material();

        return view('sinau.enroll.material.form', [
            'course' => $this->getCourse($course),
            'meet' => $meet,
            'route' => 'store',
            'material' => $m->getTypes()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->saved($request);

        return redirect()->route('enroll.meet.show', [
            'enroll' => $request->enroll,
            'meet' => $request->meet
        ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $enroll
     * @param  int  $meet
     * @param  int  $material
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $enroll, int $meet, int $material)
    {
        Material::findOrFail($material)->delete();
        /* $m = MaterialFile::where('material_id', $material);

        // Delete each items
        foreach ($m->get() as $key) {
            # code...
        }

        $m->delete(); */

        return redirect()->route('enroll.meet.show', [
            'enroll' => $enroll,
            'meet' => $meet
        ]);

    }
}
