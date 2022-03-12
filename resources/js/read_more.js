function read_more(dots_id, read_more_text_id, button_id) {

    let dots = document.getElementById(dots_id);
    let moreText = document.getElementById(read_more_text_id);
    let btnText = document.getElementById(button_id);


    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}