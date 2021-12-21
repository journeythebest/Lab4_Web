function addReviews() {
    var count = document.getElementsByClassName('review').length;
    let Req = new XMLHttpRequest();
    Req.onload = function () {
        const reviews = JSON.parse(this.responseText);
        let i = 0;
        while (i < reviews.length) {
            document.getElementById('container').innerHTML += reviews[i];
            i++;
        }
    }
    Req.open("get", "load_data.php?count=" + count, true);
    Req.send();
}

function reg() {
    let signupForm = new FormData(document.getElementById('signup-form'));
    fetch('/web4/reg.php', {
            method: 'POST',
            body: signupForm
        }
    )
        .then(response => response.json())
        .then((result) => {
            if (result.errors) {
                for (let i = 0; i < result.errors.length; i++)
                {
                    console.log(result.errors[i])
                }
                console.log("ERROR");
            }
            else {
                window.location.href = '#';
                location.reload();
            }
        })
        .catch(error => console.log(error));
}

function log() {
    let loginForm = new FormData(document.getElementById('login-form'));
    fetch('/web4/log.php', {
            method: 'POST',
            body: loginForm
        }
    )
        .then(response => response.json())
        .then((result) => {
            if (result.errors) {
                for (let i = 0; i < result.errors.length; i++)
                {
                    console.log(result.errors[i])
                }
                console.log("ERROR");

            }
            else {
                window.location.href = '#';
                location.reload();
            }
        })
        .catch(error => console.log(error));
}

function out()
{
    let Req = new XMLHttpRequest();
    Req.onload = function () {
    }
    Req.open("get", "out.php", true);
    Req.send();
    window.location.reload();

}