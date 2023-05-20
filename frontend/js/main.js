// IIFE, because we are cool :)
(() => {
    const formSubmiter = document.getElementById("form-sumbitter");
    const referatInput = document.getElementById("referat-input");
    const audioInput = document.getElementById("audio-input");
    const configInput = document.getElementById("config-input");
    const loader = document.getElementById('gray-background-loader');
    console.log(referatInput.files);

    formSubmiter.addEventListener('click', function(event) {
        // Prevent the default behavior
        // event.preventDefault();
        if (referatInput.files.length < 1){
            alert("Some of the input fields have unselected files");
            ShowLoader();
            return;
        }
       
      });

      function ShowLoader() {
        if (loader) {
            loader.style.display = 'flex';
        }
      }

      function HideLoader() {
        if (loader) {
            loader.style.display = 'none';
        }
      }
})();