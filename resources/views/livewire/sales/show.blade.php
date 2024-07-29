<div>
  <x-slot name="header"> {{ __($header) }} </x-slot>

  <!-- component -->
  <div class="space-y-2">
    @if ($sale->status == 'CANCELADO' || $sale->status == 'REEMBOLSADO')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">{{ __('Attention') }}</strong>
      <span class="block sm:inline">{{ __('This sale has been canceled/reembursed') }}</span>
      @if ($sale->status == 'REEMBOLSADO')
        <span class="block sm:inline">{{ '- '. __('Reimbursement') }}: <x-span-money :money="$sale->reimbursement" /></span>
      @endif
    </div>
    @endif

    <section class="container mx-auto">
      <div
        class="text-black dark:text-white p-3 bg-gray-100 dark:bg-gray-700 flex mx-auto border-b border-gray-400 dark:border-gray-100 rounded-lg sm:flex-row flex-col">
        <div class="flex-grow">
          <div class="flex justify-between border-b mb-2 gap-x-2">
            <div>
              <h1 class="text-2xl title-font font-bold">{{ __('Client'). ': '. $sale->client->name }}</h1>
            </div>
            <div>
              <a href="{{ route('client.show', $sale->client->id) }}"
                class="text-indigo-500 inline-flex items-center underline">{{ __('More information') }}
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                  <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>

          <div class="md:flex font-bold justify-between">
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('CPF') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->client->cpf }}</p>
            </div>
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Phone') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->client->phone_one }}</p>
            </div>
            @if ($sale->client->phone_two)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Phone').' (2)' }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->client->phone_two }}</p>
              </div>
            @endif
            @if ($sale->client->father_phone)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Father').': '. explode(' ', $sale->client->father)[0] }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->client->father_phone }}</p>
              </div>
            @endif
            @if ($sale->client->mother_phone)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Mother') .': '. explode(' ', $sale->client->mother)[0] }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->client->mother_phone }}</p>
              </div>
            @endif
            @if ($sale->client->affiliated_one_phone)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Affiliated') .': '. explode(' ', $sale->client->affiliated_one)[0] }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->client->affiliated_one_phone }}</p>
              </div class="flex md:block">
            @endif
            @if ($sale->client->affiliated_two_phone)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Affiliated').': '. explode(' ', $sale->client->affiliated_two)[0] }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->client->affiliated_two_phone }}</p>
              </div>
            @endif
          </div>

        </div>
      </div>
    </section>

    <section class="container mx-auto">
      <div
        class="text-black dark:text-white p-3 bg-gray-100 dark:bg-gray-700 flex mx-auto border-b border-gray-400 dark:border-gray-100 rounded-lg sm:flex-row flex-col">
        <div class="flex-grow">
          <div class="flex justify-between border-b mb-2 gap-x-2">
            <div>
              <h1 class="text-2xl title-font font-bold">{{ $sale->vehicle->model->type->name }}</h1>
            </div>
            <div>
              <a href="{{ route('vehicle.show', $sale->vehicle->id) }}"
                class="text-indigo-500 inline-flex items-center underline">{{ __('More information') }}
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                  <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>

          <div class="md:flex font-bold justify-between">
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Brand') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->vehicle->model->brand->name }}</p>
            </div>
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Model') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->vehicle->model->name }}</p>
            </div>
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Year') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->vehicle->year_one.'/'.$sale->vehicle->year_two }}</p>
            </div>
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('KM') }}</h2>
              <p class="ml-2 md:ml-0">{{ $sale->vehicle->km }}</p>
            </div>
            @if ($sale->surcharge > 0)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Surcharge') }}</h2>
                <p class="ml-2 md:ml-0"><x-span-money :money="$sale->surcharge" /></p>
              </div>
            @endif
            @if ($sale->discount > 0)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Discount') }}</h2>
                <p class="ml-2 md:ml-0"><x-span-money :money="$sale->discount" /></p>
              </div>
            @endif
            @if ($sale->down_payment > 0)
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Down Payment') }}</h2>
                <p class="ml-2 md:ml-0"><x-span-money :money="$sale->down_payment" /></p>
              </div>
            @endif
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Sale Price') }}</h2>
              <p class="ml-2 md:ml-0"><x-span-money :money="$sale->vehicle->sale_price" /> </p>
            </div>
            <div class="flex md:block">
              <h2 class="text-gray-500 dark:text-gray-400">{{ __('Sold Price') }}</h2>
              <p class="ml-2 md:ml-0"> <x-span-money :money="$sale->total" /> </p>
            </div>
          </div>

        </div>
      </div>
    </section>

    @if ($sale->number_installments > 1)
      <section class="container mx-auto mt-3">
        <div
          class="text-black dark:text-white p-3 bg-gray-100 dark:bg-gray-700 flex mx-auto border-b border-gray-400 dark:border-gray-100 rounded-lg sm:flex-row flex-col">
          <div class="flex-grow">
            <div class="flex justify-between border-b mb-2 gap-x-2">
              <div>
                <h1 class="text-2xl title-font font-bold">{{ __('Installments') }}</h1>
              </div>
              <div>
                <a href="{{ route('sale.installments', $sale->id) }}"
                  class="text-indigo-500 inline-flex items-center underline">{{ __('More information') }}
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                  </svg>
                </a>
              </div>
            </div>

            <div class="md:flex font-bold justify-between">
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Number of Installments') }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->number_installments }}</p>
              </div>
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Installments Paid') }}</h2>
                <p class="ml-2 md:ml-0">{{ $sale->paymentInstallments->where('status','PAGO')->count() }}</p>
              </div>
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Status') }}</h2>
                <p class="{{ $this->isArrears === 'EM ATRASO' ? 'ml-2 md:ml-0 text-red-500' : 'ml-2 md:ml-0 text-green-500' }}">{{ $this->isArrears }}</p>
              </div>
              @if ($sale->paymentInstallments->where('status','PENDENTE')->count() > 0)
                <div class="flex md:block">
                  <h2 class="text-gray-500 dark:text-gray-400">{{ __('Next installment day') }}</h2>
                  <p class="ml-2 md:ml-0"> <x-span-date :date="$sale->paymentInstallments->where('status','PENDENTE')->first()->due_date" /> </p>
                </div>
              @endif
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Installment value') }}</h2>
                <p class="ml-2 md:ml-0"> <x-span-money :money="$sale->paymentInstallments->first()->value" /> </p>
              </div>
              <div class="flex md:block">
                <h2 class="text-gray-500 dark:text-gray-400">{{ __('Amount paid') }}</h2>
                <p class="ml-2 md:ml-0"> <x-span-money :money="$this->amountPaid" /> </p>
              </div>
              @if ($sale->paymentInstallments->where('status','PENDENTE')->count() > 0)
                <div class="flex md:block">
                  <h2 class="text-gray-500 dark:text-gray-400">{{ __('Amount remaining') }}</h2>
                  <p class="ml-2 md:ml-0"> <x-span-money :money="$this->amountArrears" /> </p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </section>
    @endif
  </div>
  <div class="flex items-center mt-4 pt-2 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
    <x-secondary-button href="{{ route('sales') }}" wire:navigate>{{ __('Back') }}</x-secondary-button>
  </div>
</div>
