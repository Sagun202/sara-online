<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\AdvertisementDataTable;
use Bsdev\Ecommerce\Models\Advertisement;
use Bsdev\Ecommerce\Requests\StoreAdvertisementRequest;
use Bsdev\Ecommerce\Requests\UpdateAdvertisementRequest;
use Bsdev\Theme\Traits\FileUpload;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdvertisementDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('advertisement_view'), 403);

        return $dataTable->render('ecommerce::advertisement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('advertisement_create'), 403);

        return view('ecommerce::advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertisementRequest $request)
    {
        abort_if(!auth()->user()->can('advertisement_create'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('adse', $request->image);
            }
            Advertisement::create($data);

            return redirect()->route('advertisements.index')->with('success', 'Successfully created!!');

        } catch (\Exception $ex) {

            return redirect()->route('advertisements.index')->with('error', 'Something went wrong!!');

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
    public function edit(Advertisement $advertisement)
    {
        abort_if(!auth()->user()->can('advertisement_edit'), 403);

        return view('ecommerce::advertisement.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        abort_if(!auth()->user()->can('advertisement_update'), 403);

        try {
            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('adse', $request->image);
            }
            $data['status'] = ($request->status) ? 1 : 0;
            $advertisement->update($data);

            return redirect()->route('advertisements.index')->with('success', 'Successfully updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('advertisements.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        abort_if(!auth()->user()->can('advertisement_delete'), 403);

        try {

            $advertisement->delete();

            return redirect()->route('advertisements.index')->with('success', 'Successfully deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('advertisements.index')->with('error', 'Something went wrong!!');

        }
    }
}
