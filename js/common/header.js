const header = document.querySelector("header");

window.addEventListener("scroll", () => {
  header?.classList.toggle("shadow-sm", window.scrollY > 20);
  header?.classList.toggle("backdrop-blur-md", window.scrollY > 20);
  header?.classList.toggle("py-3", window.scrollY > 20);
  
  if (window.scrollY > 20) {
    header?.classList.remove("bg-transparent", "py-5");
    header?.classList.add("shadow-sm", "backdrop-blur-md", "py-3");
  } else {
    header?.classList.add("bg-transparent", "py-5");
    header?.classList.remove("shadow-sm", "backdrop-blur-md", "py-3");
  }
});
