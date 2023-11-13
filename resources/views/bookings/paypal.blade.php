@extends('layouts.app')
@section("content")

<div class="container loginView">
   <div class="row">
      <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">Payment Page</h3>
      <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-default credit-card-box">
            <div class="panel-heading">
               <div class="row">
                  <h3>Payment By PayPal</h3>

               </div>
            </div>
            <div class="panel-body">
               @if (Session::has('success'))
               <div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <p>{{ Session::get('success') }}</p><br>
               </div>
               @endif
               <br>

               <table class="table table-bordered">

                  <tbody>
                     <tr>
                        <td>Amount</td>
                        <td>£{{$total}}</td>

                     </tr>
                     <tr>
                        <td>Tax</td>
                        <td>£0</td>

                     </tr>
                     <tr>
                        <td>Delivery</td>
                        <td>£10</td>
                     </tr>
                     <tr>
                        <td>Total Amount</td>
                        <td>£{{$total+10}}</td>
                     </tr>

                  </tbody>
               </table>
               <form action="{{ route('paypal') }}" method="POST">
                  @csrf
                  <input type="hidden" name="amount" value="{{$total+10}}">


                  <button type="submit" class="btn btn-info my-3">Pay with PayPal</button>
               </form>

            </div>

         </div>
      </div>
   </div>
</div>

@endsection