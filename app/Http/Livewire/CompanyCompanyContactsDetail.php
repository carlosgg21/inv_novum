<?php

namespace App\Http\Livewire;

use App\Models\Charge;
use Livewire\Component;
use App\Models\Company;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\CompanyContact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyCompanyContactsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Company $company;
    public CompanyContact $companyContact;
    public $chargesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CompanyContact';

    protected $rules = [
        'companyContact.name' => ['required', 'max:255', 'string'],
        'companyContact.last_name' => ['required', 'max:255', 'string'],
        'companyContact.title' => ['nullable', 'max:255', 'string'],
        'companyContact.charge_id' => ['nullable', 'exists:charges,id'],
        'companyContact.boss' => ['required', 'boolean'],
        'companyContact.email' => ['nullable', 'email'],
        'companyContact.phone' => ['nullable', 'max:255', 'string'],
        'companyContact.social_media' => ['nullable', 'max:255', 'json'],
    ];

    public function mount(Company $company): void
    {
        $this->company = $company;
        $this->chargesForSelect = Charge::pluck('name', 'id');
        $this->resetCompanyContactData();
    }

    public function resetCompanyContactData(): void
    {
        $this->companyContact = new CompanyContact();

        $this->companyContact->charge_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCompanyContact(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.company_company_contacts.new_title');
        $this->resetCompanyContactData();

        $this->showModal();
    }

    public function editCompanyContact(CompanyContact $companyContact): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.company_company_contacts.edit_title');
        $this->companyContact = $companyContact;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->companyContact->company_id) {
            $this->authorize('create', CompanyContact::class);

            $this->companyContact->company_id = $this->company->id;
        } else {
            $this->authorize('update', $this->companyContact);
        }

        $this->companyContact->social_media = json_decode(
            $this->companyContact->social_media,
            true
        );

        $this->companyContact->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', CompanyContact::class);

        CompanyContact::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCompanyContactData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->company->companyContacts as $companyContact) {
            array_push($this->selected, $companyContact->id);
        }
    }

    public function render(): View
    {
        return view('livewire.company-company-contacts-detail', [
            'companyContacts' => $this->company
                ->companyContacts()
                ->paginate(20),
        ]);
    }
}
