
   <div class="col-md-6">
        <form>
            <div class="input-group">
                <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                    value="{{ $attributes->get('search') ?? '' }}" class="form-control form-control-sm"
                    autocomplete="off" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-info-t btn-sm mr-2">
                        <i class="ti-search"></i>
                    </button>
                    {{ $slot }}
                </div>
            </div>
        </form>
    </div>