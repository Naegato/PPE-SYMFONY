(function(){
    let button = document.querySelector("#navbar-toggler")
    let toggleItems = document.querySelectorAll("[data-toggle]")

    button.addEventListener("click",function (){
        this.classList.toggle("active")
        if (this.classList.contains('active')){
            for (let i=0; i<toggleItems.length;i++){
                // console.log(toggleItems[i].style)
                toggleItems[i].classList.add('active')
            }
        }else{
            for (let i=0; i<toggleItems.length;i++){
                // console.log(toggleItems[i].style)
                toggleItems[i].classList.remove('active')
            }
        }
    })

    window.addEventListener("resize",function (){
        // console.log(this.innerWidth);
        if (this.innerWidth > 912){
            button.classList.remove('active')
            for (let i=0;i<toggleItems.length;i++){
                toggleItems[i].classList.remove('active')
                // toggleItems[i].style.position = "relative"
            }
        }else{
            let offset=0;
            for (let i = 0; i < toggleItems.length; i++) {
                // toggleItems[i].style.position = "absolute"
                console.log(toggleItems[i])
                console.log(toggleItems[i].getBoundingClientRect())
                offset += toggleItems[i].getBoundingClientRect().height
                console.log(offset)
                toggleItems[i].style.bottom = (-1 * offset)
            }
        }
    })
})()