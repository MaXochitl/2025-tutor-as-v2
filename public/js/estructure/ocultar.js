// sidebar toggle
const btnToggle = document.querySelector('.toggle-btn');



btnToggle.addEventListener('click', function() {
    //console.log('clik')
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('cont').classList.toggle('move');
    //console.log(document.getElementById('sidebar'))
    //console.log(document.getElementById('cont'))
});

$(document).ready(function() {
    $('.menu li:has(ul)').click(function(e) {
        //evita que se redirija al usuario
        e.preventDefault();

        if ($(this).hasClass('activado')) {
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();

        } else {
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });

    $(window).resize(function() {
        if ($(document).width() > 450) {
            $('.sidebar .menu').css({ 'display': 'block' });
        }
        if ($(document).width() < 450) {
            $('.sidebar .menu').css({ 'display': 'none' });
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
        }
    });

    $('.menu li ul li .enlaces').click(function() {
        window.location.href = $(this).attr("href");
    });
});