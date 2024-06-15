/*!
 * local functions
 */

// from: top/bottom, align:left/right/center,
function showNotification(from, align, color, msg) {
  type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

  $.notify({
    icon: "add_alert",
    message: msg
  }, {
    type: color, // type[color],
    delay: 10,
    timer: 1000,
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: 'pause',
    placement: {
      from: from,
      align: align
    }
  });
}

function timerSwal(swalTitle, timeLen) {
  Swal.fire({
    title: swalTitle,
    html: 'Please wait <b></b> seconds.',
    timer: timeLen,
    //timerProgressBar: true,
    //closeOnConfirm: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
    onBeforeOpen: () => {
      Swal.showLoading()
      timerInterval = setInterval(() => {
        const content = Swal.getContent()
        if (content) {
          const b = content.querySelector('b')
          if (b) {
            b.textContent = parseInt(Swal.getTimerLeft() / 1000) + 1
          }
        }
      }, 100)
    },
    onClose: () => {
      clearInterval(timerInterval)
    }
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
      console.log('Auto closed by the timer')
      location.reload();
    }
  });

}

function showError(from, align, color, msg) {
  type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

  $.notify({
    icon: "warning",
    message: msg
  }, {
    type: color, // type[color],
    delay: 10000,
    timer: 100,
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: 'pause',
    placement: {
      from: from,
      align: align
    }
  });
}

// ajax exec
function ajaxExec(link, notify=1) {
  $.ajax({
    type: "GET",
    url: link,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    timeout: 5000,
    success: function(data) {
      //console.log(data);
      if (data.code == 0) {
        if (notify) {
          showNotification('top', 'center', 'success', "Command exec success<br>" + data.desc);
        }
      } else {
        console.log(data);
        if (notify) {
          showNotification('top', 'center', 'warning', "Command exec failure<br>" + data.desc);
        }
      }
    },
    error: function(error) {
      console.log(error);
      if (notify) {
      showNotification('top', 'center', 'warning', "Command exec error" + error);
      }
    }
  });
}

function sleep(delay) {
  var start = (new Date()).getTime();
  while ((new Date()).getTime() - start < delay) {
    continue;
  }
}

var mobile_menu_visible = 0;
$(document).on('click', '.navbar-toggler', function() {
  $toggle = $(this);

  if (mobile_menu_visible == 1) {
    $('html').removeClass('nav-open');

    setTimeout(function() {
      $toggle.removeClass('toggled');
    }, 400);

    mobile_menu_visible = 0;
  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 430);

    $('html').addClass('nav-open');

    mobile_menu_visible = 1;
  }

});


