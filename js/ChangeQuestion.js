//TODO
//DEBUG THISSSSSSS
function next() {
    var galde = document.querySelectorAll('#galdera>div');
    for (var i = 0; i < galde.length; i++) {
        if (galde[i].style.display != 'none') {
            galde[i].style.display = 'none';
            if (i == galde.length - 1) {
                galde[0].style.display = 'block';
            } else {
                galde[i + 1].style.display = 'block';
            }
            break;
        }
    }      
}