const ctx = document.getElementById("canvas").getContext("2d");


let side = 1;
let index = 1;
let fox = document.querySelector(".fox");
fox.style.left = "40px";
fox.style.right = "unset";
fox.style.top = "20px";
fox.style.bottom = "unset";
fox.style.transform = "scale(-1,1)";
//let block = document.querySelector(".anim");
function anim() {
    if (index == 1) {
        ctx.globalAlpha = 0;
    }
    if (index > 1 && index <= 10) {
        ctx.globalAlpha += 0.1;
    }
    ctx.clearRect(0, 0, 400, 281);
    let image = document.getElementById(index);
    ctx.drawImage(image, 0, 0, 400, 281);
    index++;
    index = index % 45;
    if (index == 0) {
        index = 1;

        if (side == 1) {
            fox.style.left = "unset";
            fox.style.right = "20px";
            fox.style.top = "200px";
            fox.style.bottom = "unset";
            fox.style.transform = "scale(1,1)";
        } 
        else {
            fox.style.left = "40px";
            fox.style.right = "unset";
            fox.style.top = "20px";
            fox.style.bottom = "unset";
            fox.style.transform = "scale(-1,1)";
        } 
        side = -side;
    }

}
setInterval(anim, 150);
