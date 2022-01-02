console.log("test")
let element = document.querySelector("#z")
console.log(element)
function render(){
    let title = <h1>Wesh</h1>
    console.log(title)
    ReactDOM.render(title,element)
}
render()
