<div>
    <div class="mb-4">
        @can('create', App\Models\CompanyContact::class)
        <button class="btn btn-primary" wire:click="newCompanyContact">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\CompanyContact::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="company-company-contacts-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="companyContact.name"
                            label="Name"
                            wire:model="companyContact.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="companyContact.last_name"
                            label="Last Name"
                            wire:model="companyContact.last_name"
                            maxlength="255"
                            placeholder="Last Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.select
                            name="companyContact.charge_id"
                            label="Charge"
                            wire:model="companyContact.charge_id"
                        >
                            <option value="null" disabled>Please select the Charge</option>
                            @foreach($chargesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.text
                            name="companyContact.title"
                            label="Title"
                            wire:model="companyContact.title"
                            maxlength="255"
                            placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.checkbox
                            name="companyContact.boss"
                            label="Is Boss"
                            wire:model="companyContact.boss"
                        ></x-inputs.checkbox>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.email
                            name="companyContact.email"
                            label="Email"
                            wire:model="companyContact.email"
                            maxlength="255"
                            placeholder="Email"
                        ></x-inputs.email>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 col-lg-6">
                        <x-inputs.text
                            name="companyContact.phone"
                            label="Phone"
                            wire:model="companyContact.phone"
                            maxlength="255"
                            placeholder="Phone"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="companyContact.social_media"
                            label="Social Media"
                            wire:model="companyContact.social_media"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.last_name')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.charge_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.title')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.boss')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.email')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.phone')
                    </th>
                    <th class="text-left">
                        @lang('crud.company_company_contacts.inputs.social_media')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($companyContacts as $companyContact)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $companyContact->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">
                        {{ $companyContact->name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $companyContact->last_name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($companyContact->charge)->name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $companyContact->title ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $companyContact->boss ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $companyContact->email ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $companyContact->phone ?? '-' }}
                    </td>
                    <td class="text-right">
                        <pre>
{{ json_encode($companyContact->social_media) ?? '-' }}</pre
                        >
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $companyContact)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editCompanyContact({{ $companyContact->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">{{ $companyContacts->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
