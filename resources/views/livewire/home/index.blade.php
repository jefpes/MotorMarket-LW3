<section class="bg-white py-2">

  <div class="container mx-auto flex items-center flex-wrap">

    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
          {{ __('Store') }}
        </a>

        <div class="flex items-center" id="store-nav-content">

          <a class="pl-3 inline-block no-underline hover:text-black" href="#">
            <svg class="fill-current hover:text-black" width="24" height="24"
              viewBox="0 0 24 24">
              <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
            </svg>
          </a>

          <a class="pl-3 inline-block no-underline hover:text-black" href="#">
            <svg class="fill-current hover:text-black" width="24" height="24"
              viewBox="0 0 24 24">
              <path
                d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
            </svg>
          </a>

        </div>
      </div>
    </nav>

    @foreach ($this->vehicles as $v)
    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
      <a href="#">
        <img class="hover:grow hover:shadow-lg"
          src="{{ $v->photos->first()->path }}">
        <div class="pt-3 flex items-center justify-between">
          <p class="">{{ $v->model->name . ' - ' . $v->year_one.'/'.$v->year_two }}</p>
        </div>
        <p class="pt-1 text-gray-900">R$ <span>{{ $v->sale_price }}</span> </p>
      </a>
    </div>
    @endforeach
  </div>

</section>