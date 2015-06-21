<?php

class ServiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();

		// get all the service
        $service = Service::all();

        // load the view and pass the services
        return View::make('service.index',compact($user))
            ->with('service', $service);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 // load the create form (app/views/service/create.blade.php)
        return View::make('service.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'service_name'       => 'required',            
            'service_status' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('service/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $service = new Service;
            $rec = DB::table('services')->where('serviceName', Input::get('service_name'))->first();
            if(!$rec) {
            	$service->serviceName       = Input::get('service_name');            
	            $service->status = Input::get('service_status');
	            $service->save();
	            // redirect
            	Session::flash('message', 'Successfully created Service!');
            } else {
            	Session::flash('message', 'Service already available!');
            }
            
            return Redirect::to('service');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{		
		// get the service
        $service = Service::find($id);
        
        // show the view and pass the service to it
        return View::make('service.show')
            ->with('service', $service);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the service
        $service = Service::find($id);
        
        // show the edit form and pass the service
        return View::make('service.edit')
            ->with('service', $service);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
				// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'service_name'       => 'required',            
            'service_status' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('service/' . $id->id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $rec = DB::table('services')->where('serviceName', Input::get('service_name'))->first();
            if(!$rec){
  	            $service = Service::find($id);
	            $service->serviceName       = Input::get('service_name');            
	            $service->status = Input::get('service_status');
	            $service->save();
	            Session::flash('message', 'Successfully updated Service!');
            } else {
            	Session::flash('message', 'Service already available!');
            }

            // redirect            
            return Redirect::to('service');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
        $service = Service::find($id);
        $service->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Service!');
        return Redirect::to('service');
	}


}
