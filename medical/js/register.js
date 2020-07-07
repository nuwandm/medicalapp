function register() {
    console.log("uploading");
    $.ajax({
    url: 'https://scaf.lk:610/api/Auth/register',
    type: 'POST',
    data: new FormData($('#registerForm')[0]), // The form with the file inputs.
    processData: false,
    contentType: false // Using FormData, no need to process data.
    }).done(function(){
    window.location.replace("login.php?signup=success");
    }).fail(function(response){
    console.log(response);
    
    
    });
    }