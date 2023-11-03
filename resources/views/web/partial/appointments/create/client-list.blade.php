<label for="appointment-clients" class="text-warning">Choose Client</label>
<select name="client_id" id="appointment-clients" class="form-select">

    @foreach($clients as $client)

        <option  value="{{$client->id}}">
            {{ $client->name }}
        </option>

    @endforeach

</select>
