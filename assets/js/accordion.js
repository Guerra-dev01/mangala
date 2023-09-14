const accordionBtns = document.querySelectorAll(".accordion");

accordionBtns.forEach((accordion) => {
  accordion.onclick = function () {
    this.classList.toggle("is-open");

    let content = this.nextElementSibling;
    console.log(content);

    if (content.style.maxHeight) {
      //Se o acordao estiver aberto
      content.style.maxHeight = null;
    } else {
      //Se o acordao estiver fechado
      content.style.maxHeight = content.scrollHeight + "px";
      console.log(content.style.maxHeight);
    }
  };
});
