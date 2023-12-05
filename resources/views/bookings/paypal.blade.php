@extends('layouts.app')
@section("content")

<!-- Page Content -->
<div class="container">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="/">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Payment Page</li>
      </ol>
   </nav>
</div>

<div class="container loginView">
   <div class="row">
      <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">Payment Page</h3>
      <div class="container">

         <div class="panel-heading">
            <div class="row">
               <h3>Payment By PayPal</h3>

            </div>
         </div>
         <div class="panel-body">
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
               <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">×</a>
               <p>{{ Session::get('success') }}</p><br>
            </div>
            @endif
            <br>

            <table class="table table-bordered">

               <tbody>
                  <tr>
                     <td>Payment from</td>
                     <td>{{ auth()->user()->name }}</td>

                  </tr>
                  <tr>
                     <td>Payment to</td>
                     <td>{{ $cart->name }}</td>

                  </tr>
                  @if($cart->currency == 'Sterling')
                  <tr>
                     <td>Total Amount</td>
                     <td>£{{ $cart->finalTotal }}</td>
                  </tr>

                  @else
                  <tr>
                     <td>Total Amount</td>
                     <td>€{{ $cart->finalTotal }}</td>
                  </tr>
                  @endif
               </tbody>
            </table>
            <form action="{{ route('paypal.payment') }}" method="POST">
               @csrf
               <input type="hidden" name="amount" value="{{ $cart->finalTotal }}">


               <button type="submit" class="btn btn-info my-3">Pay with PayPal</button>
            </form>

         </div>


      </div>
   </div>
</div>

@endsection