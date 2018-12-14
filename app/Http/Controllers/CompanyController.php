<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompany;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view("company_index", ["companies" => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        return view("company_store", ["company" => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompany $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $validated = $request->validated();
        $company = new Company([
            "name" => $validated['name'],
            "email" => $validated['email'] ?? '',
            "logo" => $validated['logo'] ?? false ? $this->saveLogo($validated['logo']) : '',
            "website" => $validated['website'] ?? ''
        ]);
        $company->save();
        return redirect(route('company.show', array('id' => $company->id)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = (new Company())->where("id", $id)->first();
        return view("company_show", ["company" => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = (new Company())->where("id", $id)->first();
        return view("company_edit", ["company" => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCompany  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, $id)
    {
        $validated = $request->validated();
        Company::where("id", $id)->update([
            "name" => $validated['name'],
            "email" => $validated['email'] ?? '',
            "logo" => $validated['logo'] ?? false ? $this->updateLogo($validated['logo'], $id) : '',
            "website" => $validated['website'] ?? ''
        ]);
        return redirect(route('company.show', array('id' => $id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = (new Company())->where("id", $id)->first();
        if($company){
            if($company->has("employee")){
                $company->employee()->delete();
            }
            $this->deleteLogo($company);
            $company->delete();
        }
        return redirect(route('company.index'));
    }

    function deleteLogo($company){
        if (!empty($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
    }

    function saveLogo($logo){
        return $logo->store('companyLogos', 'public');
    }
    function updateLogo($logo, $id){
        $company = Company::where("id", $id)->first();
        $this->deleteLogo($company);
        return $logo->store('companyLogos', 'public');
    }
}
