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


})()