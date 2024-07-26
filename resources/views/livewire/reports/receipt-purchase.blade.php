<div class="indent-2 container m-3 space-y-3 text-justify">
    <h1 class="text-xl text-center font-bold">
      RECIBO
    </h1>

    <div class="space-y-3">
      <p>Eu, {{ $sale->supplier->name }}, CPF: {{ $sale->supplier->cpf }}, declaro que recebi do(a)
        @if ($company->cnpj) {{ $company->name }}, CNPJ: {{ $company->cnpj }} @else {{ $company->employee->name }}, CPF: {{ $company->employee->cpf }} @endif,
        o valor <x-span-money class="font-bold" :money="$sale->total" />
        referente a venda um veículo de: </p>
    </div>

    <div class="space-y-3 rounded-md flex justify-center">
      <table class="w-auto text-left rtl:text-right ">
        <tbody>
          @foreach ($data as $d)
            <tr class="border">
              <th scope="row" class="p-2 font-medium whitespace-nowrap border border-gray-600">
                {{ $d->label }}
              </th>
              <td class="p-2 border border-gray-600">
                {{ $d->value }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="py-10 flex justify-end">
      <p class="font-semibold">{{ $city }}, {{ $date }}.</p>
    </div>


    <div class="grid grid-cols-2 gap-4 gap-y-20 py-20">
      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p class="text-center">VENDEDOR</p>
      </div>

      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p class="text-center">COMPRADOR</p>
      </div>

      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p>TESTEMUNHA:</p>
        <p>CPF:</p>
      </div>
    </div>
  </div>
