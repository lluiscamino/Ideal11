let freeNickname;
let freeEmail;

function checkNicknameEmailFree(nickname, email) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            freeNickname = response['freeNickname'];
            freeEmail = response['freeEmail'];
        }
    };
    xhttp.open('GET', 'resources/php/register_checker.php?nickname=' + nickname + '&email=' + email, true);
    xhttp.send();
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('register-form');
    const password = document.getElementById('password');
    const passwordAgain = document.getElementById('passwordAgain');
    const meter = document.getElementById('password-strength-meter');
    const nickname = document.getElementById('nickname');
    const email = document.getElementById('email');
    const passwordFeedback = document.getElementById('password-feedback');
    const emailFeedback = document.getElementById('email-feedback');
    const nicknameFeedback = document.getElementById('nickname-feedback');

    email.addEventListener('input', function () {
        checkNicknameEmailFree(nickname.value, email.value);
        if (freeEmail) {
            emailFeedback.innerText = 'Please choose a valid email.';
            email.setCustomValidity('');
        }
    });

    nickname.addEventListener('input', function () {
        checkNicknameEmailFree(nickname.value, email.value);
        if (freeNickname) {
            nicknameFeedback.innerText = 'Please choose a nickname.';
            nickname.setCustomValidity('');
        }
    });

    /**
     * Updates password inputs validity when fields are updated.
     */
    function updatePasswordValidity() {
        if (password.validationMessage === 'Passwords have to be equal' && password.value === passwordAgain.value) {
            passwordFeedback.innerText = 'Password cannot be empty.';
            password.setCustomValidity('');
            passwordAgain.setCustomValidity('');
        } else if (password.validationMessage === 'Password is not safe enough' && meter.value >= 2) {
            passwordFeedback.innerText = 'Password cannot be empty.';
            password.setCustomValidity('');
            passwordAgain.setCustomValidity('');
        }
    }

    password.addEventListener('input', function() {
        const result = zxcvbn(password.value);
        if (result.score !== 0) {
            password.classList.add('no-bottom-radius');
        } else {
            password.classList.remove('no-bottom-radius');
        }
        meter.value = result.score;
        updatePasswordValidity();
    });

    passwordAgain.addEventListener('input', updatePasswordValidity);

    nickname.addEventListener('focus', function() {
        if (nickname.value === '') {
            nickname.value = email.value.replace(/@.*$/, '').substr(0, 20);
        }
    });

    form.addEventListener('submit', function(event) {
        passwordFeedback.innerText = 'Password cannot be empty.';
        emailFeedback.innerText = 'Please choose a valid email.';
        nicknameFeedback.innerText = 'Please choose a nickname.';
        password.setCustomValidity('');
        passwordAgain.setCustomValidity('');
        email.setCustomValidity('');
        nickname.setCustomValidity('');
        checkNicknameEmailFree(nickname.value, email.value);
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        if (meter.value < 2 && password.value !== '') {
            password.setCustomValidity('Password is not safe enough');
            passwordAgain.setCustomValidity('Password is not safe enough');
            passwordFeedback.innerText = 'Password is not safe enough.';
            event.preventDefault();
            event.stopPropagation();
        } else if (password.value !== passwordAgain.value) {
            password.setCustomValidity('Passwords have to be equal');
            passwordAgain.setCustomValidity('Passwords have to be equal');
            passwordFeedback.innerText = 'Passwords do not match.';
            event.preventDefault();
            event.stopPropagation();
        }
        if (!freeNickname && nickname.value !== '') {
            nickname.setCustomValidity('Nickname is already used');
            nicknameFeedback.innerText = 'Nickname is already used.';
            event.preventDefault();
            event.stopPropagation();
        }
        if (!freeEmail && email.value !== '') {
            email.setCustomValidity('Email is already used');
            emailFeedback.innerText = 'Email is already used.';
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});