
@extends('profile.main')

@section('p-content')

<form>
    <div class="row gx-4 gy-3">
        <label class="form-label fs-5">PERSONAL INFORMATION</label>
        <div class="col-sm-6">
            <label class="form-label" for="reg-fn">First Nane</label>
            <input class="form-control" type="text" id="first_name" name="first_name"
                value="{{ old('first_name', $cliente->first_name) }}">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-ln">Last Name</label>
            <input class="form-control" type="text" id="last_name" name="last_name"
                value="{{ old('last_name', $cliente->last_name) }}">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-email">E-mail Address</label>
            <input class="form-control bg-input" type="email" disabled
                value="{{ old('email', $valores['email']) }}">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-fn">Phones</label>
            <input class="form-control" type="text" id="phone" name="phone"
                value="{{ old('phone', $cliente->phone) }}">
        </div>

        {{-- ------------------------------------------------------------ --}}

        <div class="pt-4">
            <label class="form-label fs-5">ADDRESSES INFORMATION</label>
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-fn">Country</label>
            <input class="form-control" type="text" id="country" name="country"
                value="{{ old('country', $cliente->country) }}">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-ln">City</label>
            <input class="form-control" type="text" id="city" name="city"
                value="{{ old('city', $cliente->city) }}">
        </div>
        <div class="col-sm-8">
            <label class="form-label" for="reg-ln">State</label>
            <input class="form-control" type="text" id="state" name="state"
                value="{{ old('state', $cliente->state) }}">
        </div>
        <div class="col-sm-4">
            <label class="form-label" for="reg-ln">Zip Code</label>
            <input class="form-control" type="text" id="zipcode" name="zipcode"
                value="{{ old('zipcode', $cliente->zipcode) }}">
        </div>

        <div class="col-sm-6">
            <label class="form-label" for="reg-ln">Address (Line 1)</label>
            <input class="form-control" type="text" id="address1" name="address1"
                value="{{ old('address1', $cliente->address1) }}">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="reg-ln">Address (Line 2)</label>
            <input class="form-control" type="text" id="address2" name="address2"
                value="{{ old('address2', $cliente->address2) }}">
        </div>

        {{-- ------------------------------------------------------------ --}}

        <div class=" pt-4">
            <label class="form-label fs-5">OTHER INFORMATION</label>
        </div>

        <div class="col-sm-12">
            <label class="form-label" for="reg-fn">Payment methods</label>
            <input class="form-control bg-input" disabled
            value="(Cards) Stripe / Check">
                {{-- value="{{ old('company', $cliente->company) }}"> --}}
        </div>
        <div class="col-sm-8">
            <label class="form-label" for="reg-fn">Company</label>
            <input class="form-control" type="text" id="company" name="company"
                value="{{ old('company', $cliente->company) }}">
        </div>
        <div class="col-sm-4">
            <label class="form-label" for="reg-fn">Website</label>
            <input class="form-control" type="text" id="website" name="website"
                value="{{ old('website', $cliente->website) }}">
        </div>
        <div class="col-sm-4">
            <label class="form-label" for="reg-fn">TAX id</label>
            <input class="form-control" type="text" id="taxid" name="taxid"
                value="{{ old('taxid', $cliente->taxid) }}">
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label for="" class="form-label">Formulario</label>
                <input class="form-control" name="form_path" type="file" id="form_path">
                <h6 class="nota-red">"Formato de archivo permitido, jpeg,png,pdf.
                    no
                    superar size 2 mb"<h6>
            </div>
        </div>

        <div class="col-12">
            <hr class="mt-2 mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <button class="btn btn-primary mt-3 mt-sm-0" type="button">Update profile</button>
            </div>
        </div>
    </div>
</form>
@endsection