(function(){
    let button = document.querySelector("#navbar-toggler")
    let toggleItems = document.querySelectorAll("[data-toggle]")

    button.addEventListener("click",function (){
        this.classList.toggle("active")
        if (this.classList.contains('active')){
            for (let i=0; i<toggleItems.length;i++){
                toggleItems[i].classList.add('active')
            }
        }else{
            for (let i=0; i<toggleItems.length;i++){
                toggleItems[i].classList.remove('active')
            }
        }
    })

    let buttonPassword = document.querySelectorAll(".input-password button")
    console.log(buttonPassword)

    for (let i = 0; i < buttonPassword.length ; i++) {
        console.log(buttonPassword[i])
        buttonPassword[i].addEventListener("click",function () {
            let input = this.parentNode.querySelector('input')
            let img = this.querySelectorAll('img')
            if (input.type == "password"){
                input.type = "text"
                img[0].style.display = "none"
                img[1].style.display = "flex"
            }else{
                input.type = "password"
                img[1].style.display = "none"
                img[0].style.display = "flex"
            }
        })
    }

})()