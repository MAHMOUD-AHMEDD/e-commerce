@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','Product | Create')

@section('content')
    <div class="create-product">
        <h2 class="text-center">
            Create Product
        </h2>

        <div class="container">
            @if(session('message'))
                <p class="alert alert-success">{{session('message')}}</p>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <form
                        @if(!(isset($data))) action="{{route('products.store')}}" @else action="{{route('products.update',$data->id)}}" @endif
                    method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($data))
                            <input type="hidden" value="PUT" name="_method">
                        @endif
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" class="form-control simulated" name="name" value="{{isset($data)?$data->name:''}}" required>
                        </div>
                        <div class="mb-2">
                            <label for="">Info</label>
                            <textarea class="form-control simulated" name="info"  required>{{isset($data)?$data->name:''}}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="">Price</label>
                            <input type="number" class="form-control simulated" name="price" value="{{isset($data)?$data->price:''}}" required>
                        </div>
                        <div class="mb-2">
                            <label for="">Category</label>
{{--                            <input class="form-check-input" name="categories[]" required type="checkbox" >--}}
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="categories[]"
                                           value="{{ $category->id }}"
                                           id="category_{{ $category->id }}"
                                    @if(isset($data))
                                        {{ (is_array(old('categories', $data->categories->pluck('id')->toArray())) && in_array($category->id, old('categories', $data->categories->pluck('id')->toArray()))) ? 'checked' : '' }}
                                        @endif>
                                    <label class="form-check-label" for="category_{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-2">
                            <label for="">Images</label>
                            <input type="file" class="form-control simulated" name="images[]" accept="image/*" multiple @if(!(isset($data)))  required @endif>
                        </div>
                        <input type="submit" class="form-control btn btn-success">
                    </form>
                </div>
                <div class="col-lg-6 mb-2 mt-3">
                    <div class="simulation d-block">



                        <div class="info">
                            <p>
                                <span>Name:</span>
                                <span related_to="name"></span>
                            </p>
                            <p>
                                <span>Info:</span>
                                <span related_to="info"></span>
                            </p>
                            <p>
                                <span>Price:</span>
                                <span related_to="price"></span>
                            </p>
                            <p>
                                <span>Categires:</span>
                                <span related_to="category"></span>
                            </p>
                            <span>images:</span>
                            <div>
                                <div class="images d-flex">
                                    @if (isset($data))
                                        <div class="d-flex form-images">
                                            @foreach($data->images as $image)
                                                <div class="position-relative delete-image">
                                                    <a href="/delete-item?model_name=Images&id={{$image->id}}"><i class="ri-close-line"></i> </a>
                                                    <img src="{{asset('images/'.$image->name)}}">
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
