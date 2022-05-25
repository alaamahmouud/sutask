@extends('admin.layouts.main')
  
@section('content')


<body>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->

    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Products</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('Products')}}">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->


    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->

            </div>
            <div class="card-header border-0">
              <h3 class="mb-0">Products</h3>
            </div>

        <div class="ibox-title">
            <div class="pull-right">
                <a href="{{url('products/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Adding
                </a>
            </div>
        </div><br>


            <!-- Light table -->
            <div class="table-responsive">
              <table class="table" id="table">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th scope="col" class="sort" data-sort="name">Title</th>
                    <th scope="col" class="sort" data-sort="name">description</th>
                    <th scope="col" class="sort" data-sort="name">price</th>

                    <th class="text-center">Edit</th>
                    <th class="text-center">delate</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($products as $index => $one)
                            <tr id="removable{{$one->id}}">
                                <td>{{ $index + 1}}</td>
                                <td>{{$one->title}}</td>
                                <td>{{$one->des}}</td>
                                <td>{{$one->price}}</td>
                                <td class="text-center"><a href="{{url('products/' . $one->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                {{-- <td class="text-center">
                                <form method="post" action="{{route('categories.destroy' , ['category'=>$one->id])}}">
                                 @csrf
                                 @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                 </form>
                                </td> --}}
                                <td>
                                  <form method="POST" action="{{ route('products.destroy', $one->id) }}">
                                      @csrf
                                      <input name="_method" type="hidden" value="DELETE">
                                      <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete' >Delete</button>
                                  </form>
                              </td>
                            </tr>
                            </tr>

                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->

          </div>
        </div>
      </div>
      {{ $products->links('pagination::bootstrap-4') }}

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

@endsection
