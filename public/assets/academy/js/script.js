/**
 * Easy selector helper function
 */
const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
  }
};

/**
 * Easy event listener function
 */
const on = (type, el, listener, all = false) => {
  let selectEl = select(el, all);
  if (selectEl) {
    if (all) {
      selectEl.forEach((e) => e.addEventListener(type, listener));
    } else {
      selectEl.addEventListener(type, listener);
    }
  }
};

//preview image
const upload_file = select("#foto");
const prev = select(".hidden_prev");

upload_file.addEventListener("change", function () {
  const hero_img = select(".img-preview");

  const uploaded_img = new FileReader();
  uploaded_img.readAsDataURL(upload_file.files[0]);

  uploaded_img.onload = function (e) {
    hero_img.src = e.target.result;
    prev.value = e.target.result;
  };
});
