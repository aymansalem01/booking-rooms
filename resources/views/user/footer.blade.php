<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ft-about">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{asset('img/logo.png')}}" alt="" style="margin-top:-30px;width:500px ">
                            </a>
                        </div>
                        <p>we offer a unique rental experience where you can <br />find comfortable and stylish
                            accommodations at competitive prices</p>
                        <div class="fa-social">
                            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i
                                    class="fab fa-facebook"></i></a>
                            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com" target="_blank" class="social-icon"><i
                                    class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">

                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-newslatter">
                        <h6>New latest</h6>
                        <p>Get the latest updates and offers.</p>
                        <form action="{{ route('subscribe') }}" method="post" class="fn-form">
                            @csrf
                            <input type="text" name="email" placeholder="Email">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul>
                        <li><a href="{{route('home')}}" style="color:aliceblue">Home</a></li>
                        <li><a href="{{url('/contact')}}" style="color: aliceblue">Contact</a></li>
                        <li><a href="{{ route('about') }}" style="color: aliceblue">About Us</a></li>
                    </ul>

                </div>
                <div class="col-lg-5">
                    <div class="co-text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved to ayman  & osama </a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
@livewireScripts
<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script> <!-- تأكد من أن jQuery قبله -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
