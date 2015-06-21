<?php

class PettypesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();

		// get all the service
        $pettype = Pettypes::all();

        // load the view and pass the services
        return View::make('pettype.index',compact($user))
            ->with('pettype', $pettype);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/service/create.blade.php)
        return View::make('pettype.create');
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
            'pettype'       => 'required',            
            'status' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('pettype/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $rec = DB::table('pettypes')->where('pettype', Input::get('pettype'))->first();
            if(!$rec){
                $pettype = new Pettypes;
                $pettype->pettype       = Input::get('pettype');            
                $pettype->status = Input::get('status');
                $pettype->save();

                // redirect
                Session::flash('message', 'Successfully created Pet Type!');                
            } else {
                // redirect
                Session::flash('message', 'Pet type already available!');                
            }
            return Redirect::to('pettype');
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
        $pettype = Pettypes::find($id);
        //var_dump($service);die;
        // show the view and pass the service to it
        return View::make('pettype.show')
            ->with('pettype', $pettype);
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
        $pettype = Pettypes::find($id);
        
        // show the edit form and pass the service
        return View::make('pettype.edit')
            ->with('pettype', $pettype);
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
            'pettype'       => 'required',            
            'status' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('pettype/' . $id->id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $rec = DB::table('pettypes')->where('pettype', Input::get('pettype'))->first();
            if(!$rec){
                // store
                $pettype = Pettypes::find($id);
                $pettype->pettype = Input::get('pettype');            
                $pettype->status = Input::get('status');
                $pettype->save();
                Session::flash('message', 'Successfully updated Pet Type!');
            } else {
                Session::flash('message', 'Pet Type already available!');
            }

            // redirect
            
            return Redirect::to('pettype');
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
        $pettype = Pettypes::find($id);
        $pettype->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Pet Type!');
        return Redirect::to('pettype');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroymapping($id)
    {
        $pettypemapping = null;
        // delete
        $pettypemapping = ServicePettypeMapping::find($id);        
        $pettypemapping->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Mapping!');
        return Redirect::to('pettype/viewall');
    }


	/**
	 * View all Pet type to allocated to service.
	 *
	 * @return Response
	 */
	public function viewall()
	{
		$user = Auth::user();

		// get all the service
        $pettype = Pettypes::all();

		// get all the service
        $service = Service::all();

        $service_pettype_mapping = ServicePettypeMapping::all();

        $finalViewArr=  array();

        foreach($service_pettype_mapping as $value){
            $service = Service::find($value->SID);
            $pettype = Pettypes::find($value->PTID);            

            $finalViewArr[$value->ID]['id'] = $value->ID;
            $finalViewArr[$value->ID]['service'] =  $service->serviceName;
            $finalViewArr[$value->ID]['pettype'] = $pettype->pettype;
        }

        /*foreach($finalViewArr as $key => $value){
            $finalViewArr["$key"]['service'] = implode(", ",$finalViewArr[$key]['service']);
        }*/

        // load the view and pass the services
        return View::make('pettype.viewall',compact($user))
            ->with('viewarr', $finalViewArr);
	}

	public function maptoservice(){
		
		// get all the service
        $pettype = Pettypes::all();

		// get all the service
        $service = Service::all();

        foreach($pettype as $value){
        	$viewPettype[$value->id] = $value->pettype;
        }

		// load the create form (app/views/service/create.blade.php)
        return View::make('pettype.maptoservice')->with('sept', array($viewPettype,$service));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storemapping()
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'pettype'       => 'required',            
            'services' => 'required|array'
        );
        $validator = Validator::make(Input::all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            return Redirect::to('pettype/maptoservice')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            //$servicePettypeMapping = new ServicePettypeMapping;
            $pettypeid = Input::get('pettype');
            $services = Input::get('services');            
            $alreadypresent = 0;
            foreach($services as $value){                

                $rec = DB::table('service_pettype_mappings')
                    ->where('SID', '=', $value)
                    ->where('PTID', '=', $pettypeid)
                    ->get();
                if(!$rec){
                    $servicePettypeMapping = new ServicePettypeMapping;
                    $servicePettypeMapping->ptid = $pettypeid;            
                    $servicePettypeMapping->sid  = $value;
                    $servicePettypeMapping->save();    
                } else {
                    $alreadypresent++;
                }
            }

            if($alreadypresent == 0){
                Session::flash('message', 'Mapping Successfully created!');    
            } else {
                Session::flash('message', 'Some or all of the mapping already available!');
            }
            // redirect
            
            return Redirect::to('pettype/viewall');
        }
	}
}
