const container = document.querySelector(".login-container"),
      pwShowHide = document.querySelector(".showHidePw"),
      pwFields= document.querySelector(".password");


// Mostrar/ocultar la contraseña
pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", ()=>{
        pwFields.forEach(pwField =>{
            if(pwField.type ==="password"){
                pwField.type = "text";

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("bx bx-hide", "bx bx-show-alt")
                })
            } else{
                pwField.type = "password"

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("bx bx-show-alt", "bx bx-hide")
                })
            }
        })
    })
}
)


