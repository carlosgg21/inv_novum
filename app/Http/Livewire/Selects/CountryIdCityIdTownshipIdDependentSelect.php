<?php

namespace App\Http\Livewire\Selects;

use App\Models\City;
use Livewire\Component;
use App\Models\Address;
use App\Models\Country;
use App\Models\Township;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CountryIdCityIdTownshipIdDependentSelect extends Component
{
    use AuthorizesRequests;

    public $allCountries;
    public $allCities;
    public $allTownships;

    public $selectedCountryId;
    public $selectedCityId;
    public $selectedTownshipId;

    protected $rules = [
        'selectedCountryId' => ['nullable', 'exists:countries,id'],
        'selectedCityId' => ['nullable', 'exists:cities,id'],
        'selectedTownshipId' => ['nullable', 'exists:townships,id'],
    ];

    public function mount($address): void
    {
        $this->clearData();
        $this->fillAllCountries();

        if (is_null($address)) {
            return;
        }

        $address = Address::findOrFail($address);

        $this->selectedCountryId = $address->country_id;

        $this->fillAllCities();
        $this->selectedCityId = $address->city_id;

        $this->fillAllTownships();
        $this->selectedTownshipId = $address->township_id;
    }

    public function updatedSelectedCountryId(): void
    {
        $this->selectedCityId = null;
        $this->fillAllCities();
    }

    public function updatedSelectedCityId(): void
    {
        $this->selectedTownshipId = null;
        $this->fillAllTownships();
    }

    public function fillAllCountries(): void
    {
        $this->allCountries = Country::all()->pluck('name', 'id');
    }

    public function fillAllCities(): void
    {
        if (!$this->selectedCountryId) {
            return;
        }

        $this->allCities = City::where('country_id', $this->selectedCountryId)
            ->get()
            ->pluck('name', 'id');
    }

    public function fillAllTownships(): void
    {
        if (!$this->selectedCityId) {
            return;
        }

        $this->allTownships = Township::where('city_id', $this->selectedCityId)
            ->get()
            ->pluck('name', 'id');
    }

    public function clearData(): void
    {
        $this->allCountries = null;
        $this->allCities = null;
        $this->allTownships = null;

        $this->selectedCountryId = null;
        $this->selectedCityId = null;
        $this->selectedTownshipId = null;
    }

    public function render(): View
    {
        return view(
            'livewire.selects.country-id-city-id-township-id-dependent-select'
        );
    }
}
