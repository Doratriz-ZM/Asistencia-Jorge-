const container = document.querySelector(".login-container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields= document.querySelectorAll(".password"),
      signUp= document.querySelector(".signup-link"),
      login= document.querySelector(".login-link");


// Mostrar/ocultar la contraseña
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("bx-hide", "bx-show")
                })
            } else{
                pwField.type = "password"

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("bx-show", "bx-hide")
                })
            }
        })
    })
}
)

// Cambiar de Login a Register y Viceversa
signUp.addEventListener("click", ( )=>{
    container.classList.add("active");
});
login.addEventListener("click", ( )=>{
    container.classList.remove("active");
});