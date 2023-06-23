<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
<title>Surfside Media</title>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="">
<meta property="og:type" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.ico">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/custom.css"></head>

<body>
@if(session()->has('flase_message'))
 <p>{{ session()->get('flase_message') }}</p>
@endif
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"></a>                    
               
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">User Register</h3>
                                    </div>                                        
                                    <form action="{{route('adminStore')}}" method="post" enctype="multipart/form-data">
                                        @csrf()
                                        <div class="form-group">
                                            <input type="text" required="" name="name" placeholder="Name" value="{{old('name')}}">
                                            @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('name')}}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Email" value="{{old('email')}}">
                                            @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password" value="{{old('password')}}">
                                            @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('password')}}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="cpassword" placeholder="Confirm password" value="{{old('cpassword')}}">
                                            @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('cpassword')}}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="text" name="address" placeholder=" Enter address" value="{{old('address')}}">
                                            @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('address')}}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            @if($errors->has('role'))
                                            <p class="text-danger">{{$errors->first('role')}}</p>
                                            @endif
                                            <select name="role" id="ro" class="form-control" required="">
                                                <option value="">choose role</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                            <a href="privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit &amp; Register</button>
                                        </div>
                                    </form>                                        
                                    <div class="text-muted text-center">Already have an account? <a href="userLogin">Sign in now</a></div>
                                </div>
                            </div>
                        </div>                            
                        <div class="col-lg-6">
                           <img src="assets/imgs/login.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Vendor JS-->
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/plugins/slick.js"></script>
<script src="assets/js/plugins/jquery.syotimer.min.js"></script>
<script src="assets/js/plugins/wow.js"></script>
<script src="assets/js/plugins/jquery-ui.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.js"></script>
<script src="assets/js/plugins/magnific-popup.js"></script>
<script src="assets/js/plugins/select2.min.js"></script>
<script src="assets/js/plugins/waypoints.js"></script>
<script src="assets/js/plugins/counterup.js"></script>
<script src="assets/js/plugins/jquery.countdown.min.js"></script>
<script src="assets/js/plugins/images-loaded.js"></script>
<script src="assets/js/plugins/isotope.js"></script>
<script src="assets/js/plugins/scrollup.js"></script>
<script src="assets/js/plugins/jquery.vticker-min.js"></script>
<script src="assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="assets/js/plugins/jquery.elevatezoom.js"></script>
<!-- Template  JS -->
<script src="assets/js/main.js?v=3.3"></script>
<script src="assets/js/shop.js?v=3.3"></script>   
</body>

</html>