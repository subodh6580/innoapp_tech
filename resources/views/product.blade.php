@extends('layouts.app')
   
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Products') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock Status</th>
                                <th>Created</th>
                                <th>Action</th>
                                
                            </tr>
            </thead>
   
                <tbody>
                
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 
@push('scripts')
 
<script type="text/javascript">

 
  $(document).ready(function() {
    var usersTable = $('#example').DataTable({
    ajax: "{{ route('products.datatables') }}",
        columns: [
                {data: 'name'},
                {data: 'price'},
                {data: 'stock_status'},
                {data: 'created_at', searchable: false},
                {data: 'action', name: 'action'},
                ]
            });
            
    }); 

    
  function getProductID(product_id)
  {
    $.ajax({
        type: 'GET',
        url: "{{ url('change_stock') }}/"+product_id,
        dataType: "text",
        success: function(resultData) { 
            console.log(resultData);
            location.reload();
            },
        error: function(error){
            console.log(error);
         }
        });
  }
</script>    

@endpush