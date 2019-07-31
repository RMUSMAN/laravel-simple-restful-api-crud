<?php

namespace App\Http\Controllers;
use App\Http\Resources\ProfileResource;
use App\Profile;
use Illuminate\Http\Request;
use Validator;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profiles =Profile::all();
        return ProfileResource::collection($profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
             'last_name' => 'required',
             'email' => 'unique:profiles,email',
             'address' => 'required',
        ]);
        if($validator->fails()){
          
            return new ProfileResource($validator->errors(), 400);

             // return response()->json($validator->errors(), 400);    // json response can also be used
        }

        $profile = new Profile;
        $profile->first_name=$request->input('first_name');
        $profile->last_name=$request->input('last_name');
        $profile->email=$request->input('email');
        $profile->address=$request->input('address');
        $profile->save();
        return new ProfileResource($profile);
      //  return response()->json($$profile);
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
        $profile = Profile::find($id);
        if($profile){
            return new  ProfileResource($profile);       }
        return "Profile Not Found";
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
             'last_name' => 'required',
            'email' => 'unique:profiles,email',
             'address' => 'required',
        ]);
        if($validator->fails()){
            return new ProfileResource($validator->errors(), 400);
          //  return response()->json($validator->errors(), 400); 
        }
        
        $profile = Profile::find($id);
        $profile->first_name=$request->input('first_name');
        $profile->last_name=$request->input('last_name');
        $profile->email=$request->input('email');
        $profile->address=$request->input('address');
        $profile->save();
        return new ProfileResource($profile);
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
        $profile = Profile::findOrfail($id);
        if($profile->delete()){
            return new ProfileResource($profile);
        }
        return "Error in deleting";
    }
}
