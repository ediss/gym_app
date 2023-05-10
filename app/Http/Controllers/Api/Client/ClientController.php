<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\DeleteClientRequest;
use App\Models\Client;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    public const CLIENT_ROLE = "5";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClientRequest $request) {

        $validatedData = $request->validated();

        $validatedData['role_id'] = self::CLIENT_ROLE;
//        if($validatedData['role_id'] !== self::CLIENT_ROLE) {
//            throw ValidationException::withMessages(['role'=>'You are trying to create user which is not client!']);
//        }

        $coachModel = new Coach();

        $coach = $coachModel->where('id', '9')->firstOrFail();

        $client = Client::create($validatedData);

        //event send email to client for email validation


        //assigning client to coach
        $coach->clients()->attach($client);

        //return client resource
        return $client;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteClientRequest $request)
    {

        $validatedData = $request->validated();

        //check if client belongs to coach then delete

        $client = Client::findOrFail($validatedData['client_id']);

        $coachModel = new Coach();

        $coach = $coachModel->where('id', '9')->firstOrFail();

        $coach->clients()->detach($client);

//        if ($client->trashed()) {
//            dd("soft deleted");
//        }else{
//            dd("not deleted user");
//        }


        if (!$client) {
            return "delete client error";
        }

        return 'client deleted successfully!';
    }
}
