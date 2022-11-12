@extends('front.welcome')
@section('products')
    <section class="feature">
        <div class="row">
            @if($feature)
                <div class="col-md-12"><h2>Featured Products</h2></div>
            @else
                <div class="col-md-12"><h2>New Products</h2></div>
            @endif
        </div>

        <div class="row text-center">
            @if(isset($feature))
                @foreach($feature as $feature_prod)
                    <div class="col-3">
                        <a href="{{route('products.show', $feature_prod->id)}}"><img src="{{$feature_prod->image}}" alt="" width="30%"></a>
                        <a href="{{route('products.show', $feature_prod->id)}}"><p>{{$feature_prod->title}}</p></a>
                        <p class="btn btn-primary"><a href="{{route('add.to.cart', $feature_prod->id) }}"><span><strong>Add To Cart</strong></span></a></p>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="offset-9 col-md-3 sm:text-right"><a href="{{route('feat-products')}}" class="btn btn-info">View All</a></div>
        </div>
    </section>

    <section class="new-product">
        <div class="row">
            <div class="col-md-12"><h2>New Products</h2></div>
        </div>

        <div class="row text-center">
            @if(isset($new))
                @foreach($new as $new_prod)
                    <div class="col-3">
                        <div class="thumbnail">
                            <div class="caption">
                                <a href="{{route('products.show', $new_prod->id)}}"><img src="{{$new_prod->image}}" alt="" width="30%"></a>
                                <a href="{{route('products.show', $new_prod->id)}}"><p>{{$new_prod->title}}</p></a>
                                <p class="btn btn-primary"><a href="{{route('add.to.cart', $new_prod->id) }}"><span><strong>Add To Cart</strong></span></a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="offset-9 col-md-3 sm:text-right"><a href="{{route('new-products')}}" class="btn btn-info">View All</a></div>
        </div>
    </section>

@endsection
