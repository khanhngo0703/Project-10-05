<?php
include "shared/_header.php";
require_once "admin/utils.php";

$errors = [];

if(isset($_POST['send'])) {
    $username = sanitize($_POST['username']);
    $email_contact = sanitize($_POST['email']);
    $message = sanitize($_POST['message']);
    
    if (empty($username)) {
        array_push($errors, 'Username cannot be left blank');
    }

    if (empty($username)) {
        array_push($errors, 'Email cannot be left blank');
    }

    if (empty($username)) {
        array_push($errors, 'Message cannot be left blank');
    }

    if (count($errors) == 0) {
        $sql = "insert into contact_info (username_contact,email_contact,message_contact) values ('$username','$email_contact','$message')";
        $res = $conn->query($sql);
        if ($res) {
            echo 'WE WILL CONTACT YOU FASTEST';
            exit();
        } else {
            array_push($errors, 'Registration failed');
        }
    }
}
?>
    <div class="iframe-form">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9244039373093!2d105.8164542749293!3d21.035710580615344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab145bf89bd7%3A0xd94a869b494c04b6!2zMjg1IMSQ4buZaSBD4bqlbiwgVsSpbmggUGjDuiwgQmEgxJDDrG5oLCBIw6AgTuG7mWkgMTAwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1682070434167!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <section id="contact" class="contact">

        <h1 class="section-header">Contact</h1>

        <div class="contact-wrapper">


            <form method="post" name="emailContact" class="form-horizontal">
                <h2 class="title-contact">LET US NOW!</h2>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" placeholder="USERS NAME" name="username" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="" required>
                    </div>
                </div>

                <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>

                <button class="btn btn-primary send-button" id="submit" type="submit" name="send" value="SEND">
                    <div class="alt-send-button">
                        <i class="fa fa-paper-plane"></i><span class="send-text">SEND</span>
                    </div>

                </button>
            </form>

            <div class="direct-contact-container">
                <h2 class="title-contact">HEAD OFFICE</h2>

                <ul class="contact-list">
                    <li class="list-item"><i class="fa fa-map-marker fa-2x"><span class="contact-text place">ĐỘI CẤN</a></span></i></li>

                    <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a href="tel:0356895656" title="Give me a call">0356895656</a></span></i></li>

                    <li class="list-item"><i class="fa fa-envelope fa-2x"><span class="contact-text gmail"><a href="mailto:#" title="Send me an email">Phuongthao@gmail.com</a></span></i></li>

                </ul>

                <hr>
                <ul class="social-media-list">
                    <li><a href="#" target="_blank" class="contact-icon">
                            <i class="fa-solid fa-headphones"></i></a>
                    </li>
                    <li><a href="#" target="_blank" class="contact-icon">
                            <i class="fa-solid fa-globe"></i></a>
                    </li>
                    <li><a href="#" target="_blank" class="contact-icon">
                            <i class="fa-solid fa-dove"></i></a>
                    </li>
                    <li><a href="#" target="_blank" class="contact-icon">
                            <i class="fa-brands fa-instagram"></i></a>
                    </li>
                </ul>
                <hr>

            </div>

        </div>
    </section>

    <section class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer_about">
                        <div class="footer_logo">
                            <a href="index.html">Fashion Shop<span>.</span></a>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
                        <div class="footer_social">
                            <a href="#">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="footer_widget">
                        <h6>Quick Links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="footer_widget">
                        <h6>Accounts</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="footer_widget">
                        <h6>Support</h6>
                        <ul>
                            <li><a href="#">Frequently Asked Questions</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Report a Payment Issue</a></li>
                            <li><a href="#">24/7 Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>