@extends('layouts.app')
@section("content")





<h1 class="text-center pb-3">My Orders</h1>

<div class="container mt-5 d-flex justify-content-center">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Product</th>
        <th scope="col">Title</th>
        <th scope="col">Address</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Payment Status</th>
        <th scope="col">Status</th>
        <th scope="col">Order Placed</th>
        <th scope="col">Order Updated</th>

      </tr>
    </thead>
    <tbody>


      @foreach($orders as $order)
      <tr>

        <th scope="row">{{ $order->order_id }}</a></th>

        <td><img class="trending-img" src="/storage/{{ $order->image }}"></td>
        <td>{{ $order->name }}</td>
        <td>{{ $order->address }}</td>
        <td>{{ $order->payment_method }}</td>
        <td>{{ $order->payment_status }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ date('d-m-Y', strtotime($order->created_at));  }}</td>
        <td>{{ date('d-m-Y', strtotime($order->updated_at)); }}</td>


      </tr>

      @endforeach


    </tbody>
  </table>



</div>
<div class="pagination justify-content-center">
  {{ $orders->links() }}
</div>

@endsection