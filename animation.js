    const signUpButton = document.getElementById('signUpbutton');
    const signInButton = document.getElementById('signInbutton');
    const container = document.getElementById('container');

    //Activate animations defined in style.css
    signUpButton.addEventListener('click', () => {
      container.classList.add('left-panel-active');
    });

    signInButton.addEventListener('click', () => {
      container.classList.remove('left-panel-active');
    });
