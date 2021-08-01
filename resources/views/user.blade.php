@extends('layouts.app')
   
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Customers') }}</div>

                <div class="card-body">
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Created</th>
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
    ajax: "{{ route('customers.datatables') }}",
        columns: [
                {data: 'name'},
                {data: 'email'},
                {data: 'created_at', searchable: false}
                ]
            });
            
        //$('#DataTables_Table_0_filter label input').focus();
    }); 
    
    /*$(function () {
    
        var table = $('.table_id').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('customers.datatables') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'create_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
*/
  
</script>    

@endpush