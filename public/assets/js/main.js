/**
* Template Name: Craftivo
* Template URL: https://bootstrapmade.com/craftivo-bootstrap-portfolio-template/
* Updated: Oct 04 2025 with Bootstrap v5.3.8
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";


  /* * Dark and Light Mode Toggle - Final Version
  */
  document.addEventListener('DOMContentLoaded', () => {
      const themeToggleBtn = document.querySelector('#theme-toggle-btn');
      const storageKey = 'themePreference';
      const htmlElement = document.documentElement; // استهداف وسم <html>

      // 1. قراءة التفضيل المخزن وتطبيقه عند تحميل الصفحة
      const savedTheme = localStorage.getItem(storageKey);
      
      // إذا لم يكن هناك تفضيل محفوظ، استخدم تفضيل النظام (Dark/Light) كإعداد افتراضي
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
      
      htmlElement.setAttribute('data-theme', initialTheme);

      // 2. معالج حدث النقر
      if (themeToggleBtn) { // التأكد من وجود الزر قبل إضافة الحدث
          themeToggleBtn.addEventListener('click', () => {
              let currentTheme = htmlElement.getAttribute('data-theme');
              let newTheme;

              // تحديد الثيم الجديد
              if (currentTheme === 'dark' || currentTheme === 'undefined') {
                  newTheme = 'light';
              } else {
                  newTheme = 'dark';
              }

              // التبديل وتحديث التخزين
              htmlElement.setAttribute('data-theme', newTheme);
              localStorage.setItem(storageKey, newTheme);
              
              // 💡 ملاحظة: لا حاجة لاستدعاء دالة updateToggleIcon() هنا،
              // لأن الأيقونات يتم تبديلها تلقائيًا بواسطة الـCSS الذي أضفناه سابقًا
          });
      }
  });


  
  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });



  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Init typed.js
   */
  const selectTyped = document.querySelector('.typed');
  if (selectTyped) {
    let typed_strings = selectTyped.getAttribute('data-typed-items');
    typed_strings = typed_strings.split(',');
    new Typed('.typed', {
      strings: typed_strings,
      loop: true,
      typeSpeed: 100,
      backSpeed: 50,
      backDelay: 2000
    });
  }

  /**
   * Animate the skills items on reveal
   */
  let skillsAnimation = document.querySelectorAll('.skills-animation');
  skillsAnimation.forEach((item) => {
    new Waypoint({
      element: item,
      offset: '80%',
      handler: function(direction) {
        let progress = item.querySelectorAll('.progress .progress-bar');
        progress.forEach(el => {
          el.style.width = el.getAttribute('aria-valuenow') + '%';
        });
      }
    });
  });

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function(e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();

/* Skills Section Scroll Buttons JS File */
document.addEventListener('DOMContentLoaded', () => {
    const scrollWrapper = document.querySelector('.skills-horizontal-wrapper');
    const scrollLeftBtn = document.querySelector('#scroll-left');
    const scrollRightBtn = document.querySelector('#scroll-right');
    
    // قيمة التمرير في كل ضغطة (مثلاً 300 بكسل)
    const scrollDistance = 300; 

    if (scrollWrapper && scrollLeftBtn && scrollRightBtn) {
        
        // 💡 دالة التمرير لليمين
        scrollRightBtn.addEventListener('click', () => {
            scrollWrapper.scrollBy({ 
                left: scrollDistance, // تغيير 'top' إلى 'left'
                behavior: 'smooth' 
            });
        });
        
        // 💡 دالة التمرير لليسار
        scrollLeftBtn.addEventListener('click', () => {
            scrollWrapper.scrollBy({ 
                left: -scrollDistance, // تغيير 'top' إلى 'left' ووضع علامة (-)
                behavior: 'smooth' 
            });
        });
    }
});


/* Validation Contact Form JS File */
/* global $, alert, console */
// يجب التأكد من تضمين jQuery في ملف layouts/main.php

$(function () {
    'use strict';

    // 💡 تعريف متغيرات الخطأ: نبدأها بـ TRUE لتشغيل التحقق عند الضغط الأول
    let nameError    = true,
        emailError   = true, // تم تعديله ليتناسب مع الكود السابق
        subjectError = true, // تم إضافته
        phoneError   = false, // 💡 الهاتف ليس إجباري، نبدأ بـ FALSE
        msgError     = true;

    // دالة مساعدة للتحقق من صحة الإيميل
    function isValidEmail(email) {
        const pattern = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        return pattern.test(email);
    }
    
    // ======================================
    // Start Name Field (.username)
    // ======================================
    $('.username').blur(function () {
        $('.empty-username, .length-username').hide();
        $(this).css('border', '1px solid #ddd'); // إزالة الحدود الحمراء السابقة

        const val = $(this).val().trim();

        if (val === '') {
            $(this).css('border', '1px solid #f00');
            $('.empty-username').fadeIn(300);
            nameError = true;
        } else if (val.length < 3) {
            $(this).css('border', '1px solid #f00');
            $('.length-username').fadeIn(300);
            nameError = true;
        } else {
            $(this).css('border', '1px solid #080');
            nameError = false;
        }
    });

    // ======================================
    // Start Email Field
    // ======================================
    $('.email').blur(function () {
        $('.empty-email, .invalid-email').hide();
        $(this).css('border', '1px solid #ddd');
        
        const val = $(this).val().trim();

        if (val === '') { 
            $(this).css('border', '1px solid #f00');
            $('.empty-email').fadeIn(300);
            emailError = true;
        } else if (!isValidEmail(val)) { // التحقق من الصيغة
            $(this).css('border', '1px solid #f00');
            $('.invalid-email').fadeIn(300);
            emailError = true;
        } else {
            $(this).css('border', '1px solid #080');
            emailError = false;
        }
    });

    // ======================================
    // Start Subject Field (جديد)
    // ======================================
    $('.subject').blur(function () {
        $('.empty-subject').hide();
        $(this).css('border', '1px solid #ddd');

        if ($(this).val().trim() === '') {
            $(this).css('border', '1px solid #f00');
            $('.empty-subject').fadeIn(300);
            subjectError = true;
        } else {
            $(this).css('border', '1px solid #080');
            subjectError = false;
        }
    });

    // ======================================
    // Start Phone Field (اختياري)
    // ======================================
    $('.phone').blur(function () {
        $('.len-phone').hide();
        $(this).css('border', '1px solid #ddd');
        
        const phoneVal = $(this).val().trim();
        
        // 💡 الشرط: إذا كان الحقل ليس فارغاً، يجب أن يطابق الصيغة
        if (phoneVal.length > 0) {
            if (phoneVal.length !== 11 || !phoneVal.match(/^(010|011|012|015)[0-9]{8}$/)) {
                $(this).css('border', '1px solid #f00');
                $('.len-phone').fadeIn(300);
                phoneError = true;
            } else {
                $(this).css('border', '1px solid #080');
                phoneError = false;
            }
        } else {
            // إذا كان فارغاً، فهو مقبول (Not required)
            phoneError = false; 
        }
    });

    // ======================================
    // Start Message Field
    // ======================================
    $('.message').blur(function () {
        $('.empty-message, .len-message').hide();
        $(this).css('border', '1px solid #ddd');
        
        const val = $(this).val().trim();

        if (val === '') {
            $(this).css('border', '1px solid #f00');
            $('.empty-message').fadeIn(300); // رسالة الخطأ الفارغ
            msgError = true;
        } else if (val.length < 10) {
            $(this).css('border', '1px solid #f00');
            $('.len-message').fadeIn(300); // رسالة الخطأ للطول
            msgError = true;
        } else {
            $(this).css('border', '1px solid #080');
            msgError = false;
        }
    });

// ... (كود الـ Validation لكل حقل يبقى كما هو في الأعلى) ...


    // ======================================
    // Final Submission Check (AJAX Implementation)
    // ======================================
    $('.contact-form').submit(function (e) {
        e.preventDefault(); // نمنع الإرسال التقليدي وإعادة تحميل الصفحة

        // 1. تشغيل التحقق لجميع الحقول الإجبارية للتأكد من تحديث متغيرات الأخطاء
        $('.username, .email, .subject, .message').blur();
        $('.phone').blur();
        
        // إزالة رسائل النجاح/الخطأ السابقة لتجنب التكرار
        $('.flash-message-container').remove(); 
        
        // 2. التحقق النهائي من أن جميع المتغيرات الإجبارية تساوي false
        if( nameError === true || emailError === true || subjectError === true || msgError === true ) {
            // عرض رسالة خطأ مُنسقة بدلاً من alert()
            $(this).prepend('<div class="alert alert-warning text-center mb-4 flash-message-container">Please review and correct the fields marked in red.</div>');
            return; // إيقاف الإرسال إذا فشل التحقق في الواجهة
        }
        
        // 3. تجهيز النموذج للإرسال
        const submitBtn = $('.submit-btn');
        const form = $(this);
        
        // حالة التحميل (Loading State)
        submitBtn.prop('disabled', true).find('span').text('Sending...'); 
        submitBtn.find('i').removeClass('bi-send-fill').addClass('bi-hourglass-split'); // أيقونة التحميل

        // 4. إرسال البيانات عبر AJAX
        $.ajax({
            type: form.attr('method'), 
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json', 

            success: function (response) {
                // 5. إعادة زر الإرسال لحالته الأصلية
                submitBtn.prop('disabled', false).find('span').text('Send Message');
                submitBtn.find('i').removeClass('bi-hourglass-split').addClass('bi-send-fill');
            
                if (response.success) {
                    // النجاح: عرض رسالة النجاح ومسح النموذج
                    form.prepend('<div class="alert alert-success text-center mb-4 flash-message-container">✅ ' + response.message + '</div>');
                    form[0].reset(); 
                    // إزالة الحدود (الخضراء أو الحمراء)
                    $('.form-control').css('border', '1px solid #ddd'); 
                } else {
                    // فشل: عرض رسالة الخطأ (سواء كان خطأ DB أو Validation)
                    form.prepend('<div class="alert alert-danger text-center mb-4 flash-message-container"> ' + response.message + '</div>');
                    // إذا كان فشل Validation من Controller، فهذا الكود هو الذي يعرض رسالته
                    
                    // إذا أردت إظهار أخطاء الـ Validation من PHP (Controller) أسفل الحقول، ستضيف هنا منطق jQuery لتحليل response.errors
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // 5. إعادة زر الإرسال لحالته الأصلية حتى لو فشل الاتصال
                submitBtn.prop('disabled', false).find('span').text('Send Message');
                submitBtn.find('i').removeClass('bi-hourglass-split').addClass('bi-send-fill');

                // خطأ عام
                form.prepend('<div class="alert alert-danger text-center mb-4 flash-message-container">An error occurred while connecting to the server. Please try again.</div>');
            }
        });
    });
});