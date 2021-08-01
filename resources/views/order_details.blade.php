@extends('layouts.app')
   
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">{{ __('Order Details') }}<a style="float:right" href="{{url('orders')}}">Back</a> </div>
                   
                <div class="card-body">
                   
                @if(count($orderDetails) > 0) 
                @foreach($orderDetails as $orderDetails)
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">{{ __('Invoice Number') }}</div>
                    <div class="col-sm-3">{{$orderDetails->invoice_number}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">{{ __('Customer Name') }}</div>
                    <div class="col-sm-3">{{$orderDetails->customer_name}}</div>
                </div>   
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">{{ __('Product Name') }}</div>
                    <div class="col-sm-3">{{$orderDetails->product_name}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">{{ __('Price') }}</div>
                    <div class="col-sm-3">{{$orderDetails->price}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">{{ __('Order Date') }}</div>
                    <div class="col-sm-3">{{date('d/m/y h:i:s',strtotime($orderDetails->created_at))}}</div>
                </div>
                <br>
                <hr>
                @endforeach
                @else
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-3">{{ __('No Data Found!') }}</div>
                    
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 
@push('scripts')
 
<script type="text/javascript">
  
</script>    

@endpush