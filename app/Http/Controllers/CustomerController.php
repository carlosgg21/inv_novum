<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\Country;
use App\Models\City;
use App\Models\Township;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\PaymentTerm;
use App\Repositories\CustomerRepository;
use Database\Factories\PaymentTermFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Customer::class);

        $search = $request->get('search', '');

        $customers = Customer::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.customers.index', compact('customers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Customer::class);

        $currencies = Currency::pluck('acronym', 'id');
        $banks = Bank::pluck('name', 'id');
        
        $countries = Country::pluck('name', 'id');;
        $townships = Township::pluck('name', 'id');
        $cities = City::pluck('name', 'code');
        $paymentTerms = PaymentTerm::get(['id', 'description', 'day']);
        $paymentMethods = PaymentMethod::pluck('name', 'id');

        return view('app.customers.create', compact(
            
            'currencies',
            'banks',
            'countries',
            'townships',
            'cities',
            'paymentTerms',
            'paymentMethods'
        ));

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validated();

        $customer = Customer::create($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Customer $customer): View
    {
        $this->authorize('view', $customer);

        return view('app.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Customer $customer): View
    {
        $this->authorize('update', $customer);
        $currencies = Currency::pluck('acronym', 'id');
        $banks = Bank::pluck('name', 'id');
        $customer = $this->customerRepository->findCustomer($customer->id);
        $countries = Country::pluck('name', 'id');;
        $townships = Township::pluck('name', 'id');
        $cities = City::pluck('name', 'code');
        $paymentTerms = PaymentTerm::get(['id', 'description', 'day']);
        $paymentMethods = PaymentMethod::pluck('name', 'id');
    //   dd($customer->getDefaultAddress()->city->name);
        return view('app.customers.edit', compact(
                                                  'customer', 
                                                  'currencies', 
                                                  'banks',
                                                  'countries',
                                                  'townships',
                                                  'cities',
                                                  'paymentTerms',
                                                  'paymentMethods'
                                                    ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CustomerUpdateRequest $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('update', $customer);

        dd($request->input());
        $validated = $request->validated();

        $customer->update($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
