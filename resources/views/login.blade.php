@extends('layouts.app')
@section('banner')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
      <div class="container">
        <div
          class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end"
        >
          <div class="col-first">
            <h1>Login/Register</h1>
            <nav class="d-flex align-items-center">
              <a href="{{route('index')}}"
                >Home<span class="lnr lnr-arrow-right"></span
              ></a>
              <a href="category.html">Login/Register</a>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!-- End Banner Area -->
@endsection
    @section('content')
        
    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="login_box_img">
              <img class="img-fluid" src="img/login.jpg" alt="" />
              <div class="hover">
                <h4>New to our website?</h4>
                <p>
                  There are advances being made in science and technology
                  everyday, and a good example of this is the
                </p>
                <a class="primary-btn" href="{{route('register')}}"
                  >Create an Account</a
                >
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="login_form_inner" >
              <h3>Log in to enter</h3>
              <form
                class="row login_form"
                id="contactForm"
                novalidate="novalidate"
              >
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="email"
                    placeholder="Username"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Username'"
                  />
                  <span class="text-danger error-msg" id="errorEmail"></span>
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Password"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Password'"
                  />
                  <span class="text-danger error-msg" id="errorPassword"></span>
                </div>
                <span id="error"></span>
                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <input type="checkbox" id="f-option2" name="selector" />
                    <label for="f-option2">Keep me logged in</label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <a  id="submit" class="primary-btn">
                    Log In
                  </a>
                  <a href="#">Forgot Password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </section>
    <!--================End Login Box Area =================-->
    @endsection
    @section('script')
    <script src="{{asset('js/accounts/login.js')}}"></script>
    @endsection
