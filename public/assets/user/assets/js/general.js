// Handle Option Register Target
function handleShowSearch() {
  const overlaySearch = document.querySelector(".header-scroll__overlay");
  const searchContent = document.querySelector(".intro-tabs__cover");
  const searchIconSearch = document.querySelector(
    ".header-activity__search>svg"
  );
  const searchIconClose = document.getElementById("icon-close");

  const addClass = (element, className) => {
    element.classList.add(className);
  };

  const removeClass = (element, className) => {
    element.classList.remove(className);
  };

  const handleRemoveClass = (event) => {
    event.stopPropagation();
    removeClass(searchIconClose.closest(".header-activity__search"), "active");
    removeClass(overlaySearch, "active");
    removeClass(searchContent, "active");
  };

  if (searchIconSearch) {
    searchIconSearch.addEventListener("click", (event) => {
      event.stopPropagation();
      addClass(overlaySearch, "active");
      addClass(searchContent, "active");
      addClass(searchIconSearch.closest(".header-activity__search"), "active");
    });
  }

  if (searchIconClose) {
    searchIconClose.addEventListener("click", handleRemoveClass);
  }

  if (overlaySearch) {
    overlaySearch.addEventListener("click", handleRemoveClass);
  }
}

function handleLoadMore() {
  const btnMoreShow = document.querySelector(".height-zoom");
  const btnMoreHide = document.querySelector(".height-small");

  btnMoreShow.addEventListener("click", () => {
    const parentMore = btnMoreShow.closest(".filter-sort__more");

    parentMore.previousElementSibling.classList.remove("load-more");
    parentMore.classList.add("active");
  });

  btnMoreHide.addEventListener("click", () => {
    const parentMore = btnMoreHide.closest(".filter-sort__more");

    parentMore.previousElementSibling.classList.add("load-more");
    parentMore.classList.remove("active");
  });
}

(() => {
  handleShowSearch();
  handleLoadMore();
})();
