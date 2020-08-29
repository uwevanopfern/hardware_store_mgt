<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'DESC')->get();
        return view('companies.index')->withCompanies($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:companies'
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->save();
        if ($company) {
            return redirect()->route('companies.index')->with('success', 'Company created successfully');
        }
        return back()->withInput()->with('errors', 'Failed to create a company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.show')->withCompany($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.edit')->withCompany($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        //Access $post in CustomRequest
        //$this->route('post')
        $modelObject = Company::where('id', $company->id)
            ->update([
                'type_name' => $request->input('name')
            ]);
        if ($modelObject) {
            return redirect()->route('companies.index', ['company' => $company->id])->with('success', 'Company updated successfully');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $findModel = Company::find($company->id);
        if ($findModel->delete()) {
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
        }
        return back()->withInput()->with('errors', 'Company could not deleted');
    }
}
