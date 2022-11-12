@extends('front.welcome')
@section('products')
    <section class="feature">
        <div class="row">
            <div class="col-md-3 sm:text-left"><a href="{{route('landing')}}" class="btn btn-info">Back</a></div>
        </div>
        <div class="row">
            @if(isset($feat_prod))
                <div class="col-md-12"><h2>Featured Products</h2></div>
            @else
                <div class="col-md-12"><h2>New Products</h2></div>
            @endif
        </div>

        <div class="row text-center">
            @if(isset($feat_prod))
                @foreach($feat_prod as $feature_prod)
                    <div class="col-3">
                        <a href="{{route('products.show', $feature_prod->id)}}"><img src="{{$feature_prod->image}}" alt="" width="30%"></a>
                        <a href="{{route('products.show', $feature_prod->id)}}"><p>{{$feature_prod->title}}</p></a>
                        <p class="btn btn-primary"><a href="{{route('add.to.cart', $feature_prod->id) }}"><span><strong>Add To Cart</strong></span></a></p>
                    </div>
                @endforeach
                @else
                @foreach($new_prod as $prod)
                    <div class="col-3">
                        <a href="{{route('products.show', $prod->id)}}"><img src="{{$prod->image}}" alt="" width="30%"></a>
                        <a href="{{route('products.show', $prod->id)}}"><p>{{$prod->title}}</p></a>
                        <p class="btn btn-primary"><a href="{{route('add.to.cart', $prod->id) }}"><span><strong>Add To Cart</strong></span></a></p>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
