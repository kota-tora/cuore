// import Swal from 'sweetalert2'

// or via CommonJS
// const Swal = require('sweetalert2')


function swalert(event, title, icon = 'warning', text = '') {

  let target = event.target;
  event.preventDefault();

  Swal.fire({
    title: title,
    text: text,
    type: icon, // version9からはiconになる
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
  }).then((result) => {
    if (result.value) {
      $($(target).closest('form').submit());
    }
  });
}


