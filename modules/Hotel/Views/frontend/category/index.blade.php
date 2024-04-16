{{-- GUNEY --}}
@extends('layouts.app')
@section('head')
@endsection
@section('content')
    <section class="our-listing pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title">{{__('All Categories')}}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{__('Homepage')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('All Categories')}}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row hotel-categories">
                @if (!empty($hotelCategoryHeader))
                    @foreach ($hotelCategoryHeader as $categoryHeader)
                        <div class="col-sm-6 col-md-4">
                            <a href="{{ $categoryHeader->getDetailUrl() }}">
                                <div class="icon-box">
                                    @if ($categoryHeader->icon_image_id)
                                        <img src="{{ get_file_url($categoryHeader->icon_image_id, 'full')}}" alt="{{ $categoryHeader->name }}" />
                                    @endif
                                    <div class="content-details">
                                        <div class="title">{{ $categoryHeader->name }} - NUMBER HERE</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
{{--
    <section class="our-listing pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Various Hotel Options at tatilbenim.com!</h2>
                    <p>Where is your four seasons holiday address? If you want to have a holiday in these addresses where you can find natural beauties, historical places or unique beaches, you can examine our Yurtiçi Hotel options, which serve with the best quality and best service understanding. You can take advantage of our campaigns offered to you as much as you want. All you have to do is make plans for where you want to go and take action to get it. You can choose one of the private transfer services from flight tickets, tours, hotels and airports on TatilBudur.com, which offers cash or installment options at the same place. Or you can apply to us for the honeymoon hotel of your dreams and open the doors of an unforgettable honeymoon holiday with one of the hotel options we offer you. You can take advantage of the most beautiful hotel options in the Thermal Hotels, which stand out with their healing waters, which are indispensable in cold weather. From March to October, you can choose one of the Cyprus Hotels where you can have a sea holiday and set off.
                        O people of Istanbul! Do you want to relieve stress on a short holiday without being too far from where you live? You can choose the City Hotels or add color to your weekend holiday thanks to the Near Region Hotels, where you will find addresses famous for their unique nature, close to Istanbul, where Ağva, Abant, Kocaeli, Bolu, Şile, Sapanca and many more regions are located. It is not difficult to realize the holiday you have in mind, thanks to easy payment options, the hotel you want is just a click away.</p>
                </div>
            </div>
        </div>
    </section>
--}}
@endsection

@section('footer')
@endsection
