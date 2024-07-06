<div class="w-100 p-0">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="country_id"
            label="Country"
            wire:model="selectedCountryId"
        >
            <option selected>Please select the Country</option>
            @foreach($allCountries as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    @if(!empty($selectedCountryId))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="city_id"
            label="City"
            wire:model="selectedCityId"
        >
            <option selected>Please select the City</option>
            @foreach($allCities as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select> </x-inputs.group
    >@endif @if(!empty($selectedCityId))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="township_id"
            label="Township"
            wire:model="selectedTownshipId"
        >
            <option selected>Please select the Township</option>
            @foreach($allTownships as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select> </x-inputs.group
    >@endif
</div>
