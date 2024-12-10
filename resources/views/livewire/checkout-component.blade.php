<div>
    <div class="wrap">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md d-flex align-items-center">
                    <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+00 1234 567</a> or <span class="mailus">email us:</span> <a href="#">emailsample@email.com</a></p>
                </div>
                <div class="col-12 col-md d-flex justify-content-md-end">
                    <p class="mb-0">Mon - Fri / 9:00-21:00, Sat - Sun / 10:00-20:00</p>
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Taste.<span>it</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
    
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="chef.html" class="nav-link">Chef</a></li>
                    <li class="nav-item"><a href="{{route('menu')}}" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="reservation.html" class="nav-link">Reservation</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="{{route('cart')}}" class="nav-link">Cart ({{ $cartCount }})</a></li>
                    <li class="nav-item"><a href="{{route('checkout')}}" class="nav-link">Checkout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    
    <section class="ftco-section">
        <div class="container">
            @if($cartCount > 0)
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Checkout</span>
                    <h2 class="mb-4">Order Summary</h2>
                </div>
            </div>
            <div class="row">
                @foreach($cartItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="menu-wrap">
                        <div class="menus d-flex ftco-animate">
                            <div class="menu-img img" style="background-image: url(storage/photos/{{$item->image}});"></div>
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3>{{$item->name}}</h3>
                                        <p>Quantity: {{$item->quantity}}</p>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price">${{$item->price}}</span>
                                    </div>
                                </div>
                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <h3 class="mb-4">Order Details</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>${{$item->price}}</td>
                                <td>${{$item->price * $item->quantity}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <form wire:submit.prevent="placeOrder" class="billing-form">
                        <h3 class="mb-4 billing-heading">Payment Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="paymentType">Payment Type</label>
                                    <select wire:model="paymentType" class="form-control">
                                        <option value="credit_card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="cash_on_delivery">Cash on Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Place Order" class="btn btn-primary py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->
                </div>
            </div>
            @else
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Checkout</span>
                    <h2 class="mb-4">Your cart is empty</h2>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>