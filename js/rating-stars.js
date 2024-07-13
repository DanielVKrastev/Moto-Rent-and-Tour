// To access the stars
let stars = 
    document.getElementsByClassName("star");
let output = 
    document.getElementById("output");
            
// Funtion to update rating
function gfg(n) {
   remove();
   for (let i = 0; i < n; i++) {
        if (n == 1) cls = "one";
        else if (n == 2) cls = "one";
        else if (n == 3) cls = "one";
        else if (n == 4) cls = "one";
        else if (n == 5) cls = "one";
    stars[i].className = "star " + cls;
    }
    document.querySelector('.rating-input').value = n;
}
// To remove the pre-applied styling
function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}           