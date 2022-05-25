@extends('admin.layouts.main')
@section('content')



    <body>
        <!-- Main content -->

        <div class="main-content" id="panel">
            <!-- Topnav -->
            <br>
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Adding </h3>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/products{{ isset($product) ? '/' . $product->id : '' }}" method="post">
                         {!! isset($product) ? method_field('PATCH') : '' !!}
                            @csrf

                            <div class="pl-lg-2">
                                <div class="row">
                                    <div class="col-lg-10">

                                        <div class="form-group">
                                            <label class="form-control-label" >title</label>
                                            <input name ="title" type="text"  class="form-control" placeholder="title">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" >description</label>
                                            <input name ="des" type="text"  class="form-control" placeholder="des">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" >price</label>
                                            <input name ="price" type="text"  class="form-control" placeholder="price">
                                        </div>


                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
