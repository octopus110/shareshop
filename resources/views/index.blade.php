@extends('common')
@section('css')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/lib/swiper-3.4.2.min.css">
@endsection

@section('content')
    <div class="swiper-container swiper-banner">
        <div class="swiper-wrapper">
            @foreach($banner as $item)
                <div class="swiper-slide">
                    <a href="{{ $item->href }}">
                        <img src="/uploads/{{ $item->src }}" alt="" width="100%"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-scrollbar"></div>
    </div>

    <div class="swiper-container swiper-nav">
        <div class="swiper-wrapper">
            @foreach($classify as $k=>$item)
                <div class="swiper-slide">
                    <a href="/list/{{ $item->id }}/{{ $k+3 }}">
                        <img src="/uploads/{{ $item->src }}" alt="" width="63" height="63"/>

                        <p>{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <section class="new-product">
        <div class="pro-title">
            新品上架
            <a href="/list/-1/1" class="right"><i class="iconfont icon-gengduo"></i></a>
        </div>
        <div class="product">
            @foreach($newcommoditys as $item)
                <div class="pro-item">
                    <a href="/details/{{ $item->id }}">
                        <img src="/uploads/{{ $item->src }}" alt="" width="100%">

                        <div>
                            <h6>{{ $item->name }}</h6>

                            <p><b>{{ $item->storename }}</b><span class="right">￥{{ $item->price }}</span></p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="active-product">
        <div class="pro-title">
            畅销产品
            <a href="/list/0/2" class="right"><i class="iconfont icon-gengduo"></i></a>
        </div>
        <div class="product">
            @foreach($salescommoditys as $item)
                <div class="pro-item">
                    <a href="/details/{{ $item->id }}">
                        <img src="/uploads/{{ $item->src }}" alt="" width="100%">

                        <div>
                            <h3 style="padding-top: 2vw"><b>{{ $item->storename }}</b></h3>

                            <p style="padding:1vw 0;">{{ $item->name }}</p>

                            <p><span class="right">￥{{ $item->price }}</span></p>

                            <div class="clear"></div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript" src="/lib/swiper-3.4.2.jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            new Swiper('.swiper-banner', {
                autoplay: 2000,
                scrollbar: '.swiper-scrollbar',
            })
            new Swiper('.swiper-nav', {
                slidesPerView: 5,
                spaceBetween: 25,
            })
        });
    </script>
@endsection