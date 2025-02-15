<x-app-layout>
    <div class="container px-6 mx-auto">
        <div class="flex justify-center my-6">
            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                @if ($message = Session::get('success'))
                    <div class="p-4 mb-3 bg-green-400 rounded">
                        <p class="text-green-800">{{ $message }}</p>
                    </div>
                @endif
                <h3 class="text-3xl text-bold">Basket List</h3>

                    <input type="hidden" value="{{$size=0}}">
                    @foreach ($items as $item)
                        <input type="hidden" value="{{$size++}}">
                    @endforeach
                    <h3>Welcome
                        @auth
                            {{ Auth::user()->name }} :
                            @endauth
                            Basket Size is {{$size}}</h3>

                <div class="flex-1">
                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                        <tr class="h-12 uppercase">

                            <th >Name</th>
                            <th class="hidden md:table-cell"></th>
                            <th class="pl-5 text-left lg:text-right lg:pl-0">
                                <span class="lg:hidden" title="Quantity">Qtd</span>
                                <span class="hidden lg:inline">Quantity</span>
                            </th>
                            <th class="hidden text-right md:table-cell"> Price</th>
                            <th class="hidden text-right md:table-cell"> Remove </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($items as $item)
                            <tr>
                                <td class="text-left md:table-cell">

                                        <p class="mb-2 md:ml-4 text-an">{{ $item->productName }}</p>


                                </td>

                                <td class="hidden text-right md:table-cell"></td>


                                <td class="justify-center mt-2 md:justify-end md:flex">



                                            <form action="{{ route('basket.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                                <input type="number" name="quantity" min=1 value="{{ $item->orderQuantity }}"
                                                       class="text-center bg-gray-300" />

                                    <x-primary-button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">update</x-primary-button>
                                    </form>
                                </td>

                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm font-medium lg:text-base">
                                        ${{ $item->price * $item->orderQuantity}}
                                    </span>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <form action="{{ route('basket.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="px-4 py-2 text-white bg-red-600">x</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <input type="hidden" value="{{$total=0}}">
                    @foreach ($items as $item)
                        <input type="hidden" value="{{$total+=$item->price*$item->orderQuantity}}">
                    @endforeach
                    <h3>Basket Total: £{{$total}}</h3>


                    <div>


                        <form action="{{ route('basket.clear') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                            <x-primary-button class="px-6 py-2 text-red-800 bg-red-300">Remove All basket</x-primary-button>
                        </form>



                        <form action="{{ route('basket.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                        <x-primary-button class="text-green-600 bg-green-300">Buy</x-primary-button>
                        </form>



                    </div>
                    <td class="hidden text-right md:table-cell"></td>

                    {{--<div>
                        <form action="{{ route('basket.clear') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                            <x-primary-button class="px-100 py-2 text-green-600 bg-green-300">Buy</x-primary-button>
                        </form>
                    </div>--}}


                </div>
            </div>
        </div>
    </div>


</x-app-layout>
