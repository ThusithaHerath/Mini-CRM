<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use File;
use Session;
use App\Notifications\Announcement;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Company::paginate(10);
        return view('admin.company.index',compact('data'));
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.addcompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required|unique:companies,name',
            'email'=>'required|unique:companies,email',
            'website'=>'required',
            'logo'=>'required'
           
        ],
        [
            'name.required' => 'name is required',
            'name.unique' => 'this company name is already exist',
            'email.required' => 'email is required',
            'email.unique' => 'this email is already exist',
            'website.required' => 'website  is required',
            'logo.required'=> 'logo is required',
        ]
    
    );

        $data = new Company;
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->website = $request->input('website');

        //store unique image names for each and every image
        //all images are stored locally in public/images..

        $logo=$request->logo;
        $logoname=time().'.'.$logo->getClientOriginalExtension();
        $request->logo->move('images',$logoname);
        $data->logo=$logoname;

        $data->save();


       

        //sending to email 
        // Notification::route('mail',['thusithalherath@gmail.com'])->notify(new Announcement ($announcement));

        Session::flash('company_added','Company added successfully.');

        return redirect('/manage-companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $company = Company::findOrFail($id);

        return view('admin.company.editcompany',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company,$id)
    {
        $data = Company::findOrFail($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->website = $request->input('website');


        //stop duplicating one image again and again by destroying once new image is replaced 
        $destination = 'images/'.$data->logo;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $logo=$request->logo;
        $logoname=time().'.'.$logo->getClientOriginalExtension();
        $request->logo->move('images',$logoname);
        $data->logo=$logoname;

        $data->save();

        Session::flash('updated_company','The company has been successfully Updated.');
        return redirect('/manage-companies');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
       $data = Company::findOrFail($id);
       $data->delete();

       Session::flash('deleted_company','The company has been successfully Deleted.');
       return redirect('/manage-companies');

    }
}
