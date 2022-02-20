<?php

namespace Bsdev\Slider\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Slider\DataTables\SlidersDataTable;
use Bsdev\Slider\Models\Slider;
use Bsdev\Slider\Requests\StoreSliderRequest;
use Bsdev\Slider\Requests\UpdateSliderRequest;
use Bsdev\Slider\Traits\FileUpload;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUpload;

    public $filepath = 'sliders';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SlidersDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('slider_view'), 403);

        return $dataTable->render('slider::index');
        // $sliders = Slider::orderBy('updated_at', 'DESC')->get();
        // return view('slider::index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('slider_create'), 403);

        return view('slider::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        abort_if(!auth()->user()->can('slider_create'), 403);

        try {

            $data = $request->validated();

            if ($request->image) {
                $data['image'] = $this->uploadFile($this->filepath, $request->image);
            }
            if (!$request->position) {
                $data['position'] = 1;
            }
            $data['user_id'] = auth()->id();

            Slider::create($data);

            return redirect()->route('sliders.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('sliders.index')->with('error', 'Sorry!! Something went wrong. Please try again!!');

        }
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
    public function edit(Slider $slider)
    {
        abort_if(!auth()->user()->can('slider_edit'), 403);

        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $slider->user_id != auth()->id()) {
            abort(404);

        }
        return view('slider::edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        abort_if(!auth()->user()->can('slider_update'), 403);
        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $slider->user_id != auth()->id()) {
            abort(404);

        }
        try {

            $data = $request->validated();

            if ($request->image) {
                $data['image'] = $this->uploadFile($this->filepath, $request->image);
            }
            if (!$request->status) {

                $data['status'] = 0;
            }

            $slider->update($data);

            return redirect()->route('sliders.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('sliders.index')->with('error', 'Sorry!! Something went wrong. Please try again!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        abort_if(!auth()->user()->can('slider_delete'), 403);
        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $slider->user_id != auth()->id()) {
            abort(404);

        }
        try {

            $slider->delete();

            return redirect()->route('sliders.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('sliders.index')->with('error', 'Sorry!! Something went wrong. Please try again!!');

        }
    }
}
