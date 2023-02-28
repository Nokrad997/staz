<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected Request $request;
    protected Client $client;

    public function __construct(
        Request $request,
        Client $client
    ) {
        $this->request = $request;
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->client->all();
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'No clients found']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $checkEmail = $this->client->findByEmail($this->request->get('email'));

        if (!$checkEmail) {
            $edit = $this->request->all();

            try {
                $result = $this->client->create($edit);
                return response()->json($result);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error while creating a client']);
            }
        }

        return response()->json(['message' => 'Client already exists']);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $clientId)
    {
        $client = $this->client->find($clientId);

        if ($client) {
            return response()->json($client);
        } else {
            return response()->json(['message' => 'Client not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $clientId)
    {
        $clientData = $this->client->find($clientId);

        if ($clientData) {
            $edit = $this->request->all();

            try {
                $result = $clientData->update($edit);
                return response()->json($result);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error while updating a client']);
            }
        } else {
            return response()->json(['message' => 'Client not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $clientId)
    {
        $client = $this->client->find($clientId);

        if ($client) {
            $client->delete();
            return response()->json(['message' => 'Client deleted successfully']);
        } else {
            return response()->json(['message' => 'Client not found']);
        }
    }
}
