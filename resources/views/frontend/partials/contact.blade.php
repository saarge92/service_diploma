<!-- Start contact Area -->
<div id="contact" class="contact-area">
    <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2>Свяжитесь с нами</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-mobile"></i>
                            <p>
                                Звоните: +79678207489<br>
                                <span>Понедельник-Пятница (09:00-18:00)</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-envelope-o"></i>
                            <p>
                                Email-почта: i.durdieva@doslab.ru<br>
                                <span>Web-сайт: www.example.com</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                            <i class="fa fa-map-marker"></i>
                            <p>
                               Расположение : город Астрахань<br>
                                <span>ул.Адмиралтейская 43 стр 1 офис 10</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Start Google Map -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- Start Map -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2753.7517646155197!2d48.03367760089054!3d46.35447089261835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41a9058250d65af5%3A0xc47217d516b8f9f3!2z0JDQtNC80LjRgNCw0LvRgtC10LnRgdC60LDRjyDRg9C7LiwgNDMsINCQ0YHRgtGA0LDRhdCw0L3RjCwg0JDRgdGC0YDQsNGF0LDQvdGB0LrQsNGPINC-0LHQuy4sIDQxNDAwMA!5e0!3m2!1sru!2sru!4v1558249515712!5m2!1sru!2sru"
                        width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <!-- End Map -->
                </div>
                <!-- End Google Map -->

                <!-- Start  contact -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <form class="form" id="contactForm">
                        <div id="errormessage"></div>
                        <form method="post" role="form" id="contactForm">
                            <div class="form-group">
                                <label>Ваше ФИО</label>
                                <input type="text" name="name" class="form-control" id="nameContact"
                                    placeholder="Ваше ФИО" data-rule="minlen:4" data-msg="Пожалуйста, хотя бы 4 символа"
                                    required />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <label>Введите мобильный телефон, начиная с 8</label>
                                <input type="phone" class="form-control" id="phoneContact" required
                                    placeholder="Ваш номер телефона" onkeypress="return isNumberKey(event)"/>
                                <div class="validation" id="phoneValidation"></div>
                            </div>
                            <div class="form-group">
                                <label>Комментарий (обязательно)</label>
                                <textarea class="form-control" required id="commentsContact" name="comments" rows="5"
                                    data-rule="required" data-msg="Пожалуйста, заполните поле"
                                    placeholder="Комментарий"></textarea>
                                <div class="validation"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="sendContact">Отправить запрос</button>
                            </div>
                        </form>
                </div>
            </div>
            <!-- End Left contact -->
        </div>
    </div>
</div>
</div>
<!-- End Contact Area -->
<script type="text/javascript" src="{{ URL::asset('frontend/js/phoneValidaton.js') }}"></script>