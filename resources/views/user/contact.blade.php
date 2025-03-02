@extends('layouts.uerPage')

@section('content')
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Escape Reality </h2>
                        <h3>Where Imagination Knows No Limits</h3>
                        <p>Step into a world beyond the ordinary, where dreams take shape and boundaries fade away. At
                            Escaping Reality, we offer a sanctuary from the everyday—whether through immersive stories,
                            breathtaking experiences, or a space to unwind and recharge. Lose yourself in adventure,
                            creativity, and inspiration as you explore a realm where reality is just the beginning.</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Address:</td>
                                    <td>Al-salt,Balqa,Jordan</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Phone:</td>
                                    <td>(00962) 7704651114</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td>info.colorlib@gmail.com</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    @if (session('message'))
                    <div class="alert alert-primary">
                        {{ session('message') }}
                    </div>
                    @endif
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Your Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Your Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Your Message"></textarea>

                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108235.59116187948!2d35.80841447306123!3d32.032385589968854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151cbd5c659cb8a7%3A0x31d4c6ecaa51cc1e!2z2KfZhNiz2YTYtw!5e0!3m2!1sar!2sjo!4v1740900650236!5m2!1sar!2sjo"
                    height="470" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
