<!-- Feedback Screen Start -->
<section id="feedback-screen">
    <div class="container">
        <div class="sign-in-full-section ">
            <h1 class="d-none">Feedback Page</h1>
            <form class="forget-password-screen-form" action="/config/feedback.php" method="post">
                <div class="feedback-sec">
                    <label class="feedback-lbl">Nama</label>
                    <input type="text" id="name" name="nama" placeholder="Write here" class="feedback-sec-txt">
                </div>
                <div class="feedback-sec">
                    <label class="feedback-lbl">Email</label>
                    <input type="email" id="Email" name="email" placeholder="Write here" class="feedback-sec-txt">
                </div>
                <div class="feedback-sec">
                    <label class="feedback-lbl">whatsapp</label>
                    <input type="number" id="whatsapp" name="whatsapp" min="62" placeholder="Write here" class="feedback-sec-txt">
                </div>
                <div class="feedback-text mt-16">
                    <label class="feedback-lbl">Pesan</label>
                    <textarea rows="4" class="feedback-tp" name="pesan" placeholder="Write here"></textarea>
                </div>
                <div class="feedback-btn">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Feedback Screen End -->