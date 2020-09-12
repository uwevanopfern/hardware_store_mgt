<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Client as ClientResource;

class ClientController extends Controller
{
    /**
     * Get auth user
     */
    private function getAuthUser()
    {
        return Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return ClientCollection
     */
    public function index()
    {
        $companyId = $this->getAuthUser()->company_id;
        $clients = Client::where('company_id', $companyId)->orderBy('id', 'DESC')->get();
        return new ClientCollection($clients);
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
     * @param ClientRequest|Request $request
     * @return ClientResource
     */
    public function store(ClientRequest $request)
    {
        $client = new Client;

        $companyId = $this->getAuthUser()->company_id;

        $client->company_id = $companyId;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client $client
     * @return ClientResource
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest|Request $request
     * @param  \App\Client $client
     * @return ClientResource
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client = Client::where("id", $client->id)->first();

        $companyId = $this->getAuthUser()->company_id;

        $client->company_id = $companyId;
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
