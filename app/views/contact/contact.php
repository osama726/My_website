<section id="contact" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact Me</h2>
        <p>Let's start a conversation about your project or next technical challenge.</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="contact-form-card">
                    <div class="form-header text-center">
                        <div class="header-icon">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                        <div>
                            <h3>Send a Message</h3>
                            <p>I usually respond within 24 hours.</p>
                        </div>
                    </div>

                    <form action="<?= BASE_URL ?>?controller=message&action=sendMail" method="post" class="contact-form">
                        
                        <div class="row">
                            
                            <div class="col-md-12 mb-3"> 
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-control username" 
                                    placeholder="Your Name" 
                                    required>
                                <span class="custom-error empty-username">Name can't be empty.</span>
                                <span class="custom-error length-username">Name must be larger than 2 characters.</span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control email" 
                                    placeholder="Email Address" 
                                    required>
                                <span class="custom-error empty-email">Email can't be empty.</span>
                                <span class="custom-error invalid-email">Email is not valid.</span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <input 
                                    type="text" 
                                    name="subject" 
                                    class="form-control subject" 
                                    placeholder="What's this about?" 
                                    required>
                                <span class="custom-error empty-subject">Subject can't be empty.</span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    class="form-control phone" 
                                    placeholder="Phone Number (e.g. 01xxxxxxxxx)"
                                    maxlength="11"> 
                                <span class="custom-error len-phone">Phone number must be 11 digits and start with 01x.</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <textarea 
                                class="form-control message" 
                                name="message" 
                                rows="4" 
                                placeholder="Tell us more about your project..." 
                                required></textarea>
                            <span class="custom-error empty-message">Message can't be empty.</span>
                            <span class="custom-error len-message">Message must be larger than 10 characters.</span>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="submit-btn">
                                <span>Send Message</span>
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>