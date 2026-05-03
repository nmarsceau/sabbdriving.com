(function() {
  const thumbnailButtons = Array.from(document.querySelectorAll("button.thumbnail"));
  const unsupportedNotice = document.getElementById("unsupported-notice");
  const imageModal = document.getElementById("image-modal");

  if (!window.HTMLDialogElement || typeof imageModal.showModal !== "function") {
    if (unsupportedNotice) {
      unsupportedNotice.hidden = false;
    }
    return;
  }

  const previousButton = imageModal.querySelector("button.image-modal-nav.previous");
  const nextButton = imageModal.querySelector("button.image-modal-nav.next");
  const closeButton = imageModal.querySelector("button.closeBtn");
  const webpSource = imageModal.querySelector('source[type="image/webp"]');
  const image = imageModal.querySelector("img");
  const description = imageModal.querySelector("p");

  let imageNumber = 1;
  let triggerButton = null;

  const totalImages = thumbnailButtons.length;
  const imageAltByNumber = thumbnailButtons.reduce(function(map, button) {
    map[button.dataset.imageNumber] = button.dataset.alt || "";
    return map;
  }, {});

  const touchState = {
    startX: null,
    startY: null,
    endX: null,
    endY: null,
    moves: 0
  };

  function resetTouchState() {
    touchState.startX = null;
    touchState.startY = null;
    touchState.endX = null;
    touchState.endY = null;
    touchState.moves = 0;
  }

  function updateImageSizing() {
    image.classList.remove("width_greater", "height_greater");
    if (image.naturalWidth > image.naturalHeight) {
      image.classList.add("width_greater");
    } else {
      image.classList.add("height_greater");
    }
  }

  function updateNavButtons() {
    const onFirst = imageNumber === 1;
    const onLast = imageNumber === totalImages;
    previousButton.disabled = onFirst;
    nextButton.disabled = onLast;

    if (onFirst && document.activeElement === previousButton) {
      nextButton.focus();
    }
    if (onLast && document.activeElement === nextButton) {
      previousButton.focus();
    }
  }

  function loadImage(nextImageNumber) {
    imageNumber = nextImageNumber;
    const altText = imageAltByNumber[String(imageNumber)] || "";
    webpSource.srcset = "/assets/images/gallery/fullsize/webp/" + imageNumber + ".webp";
    image.src = "/assets/images/gallery/fullsize/jpg/" + imageNumber + ".jpg";
    image.alt = altText;
    description.textContent = altText;
    updateNavButtons();
  }

  function showPreviousImage() {
    if (imageNumber > 1) {
      loadImage(imageNumber - 1);
    }
  }

  function showNextImage() {
    if (imageNumber < totalImages) {
      loadImage(imageNumber + 1);
    }
  }

  function openImageModal(nextImageNumber, button) {
    triggerButton = button;
    loadImage(nextImageNumber);
    imageModal.showModal();
  }

  image.addEventListener("load", updateImageSizing);

  thumbnailButtons.forEach(function(button) {
    button.addEventListener("click", function() {
      openImageModal(Number(button.dataset.imageNumber), button);
    });
  });

  previousButton.addEventListener("click", showPreviousImage);
  nextButton.addEventListener("click", showNextImage);
  closeButton.addEventListener("click", function() {
    imageModal.close();
  });

  imageModal.addEventListener("close", function() {
    resetTouchState();
    if (triggerButton && triggerButton.isConnected) {
      triggerButton.focus();
    }
  });

  imageModal.addEventListener("click", function(event) {
    if (event.target === imageModal) {
      imageModal.close();
    }
  });

  imageModal.addEventListener("keydown", function(event) {
    switch (event.key) {
      case "ArrowUp":
      case "ArrowDown":
        event.preventDefault();
        break;
      case "ArrowLeft":
        event.preventDefault();
        showPreviousImage();
        break;
      case "ArrowRight":
        event.preventDefault();
        showNextImage();
        break;
    }
  });

  imageModal.addEventListener("touchstart", function(event) {
    if (!event.touches.length) {
      return;
    }
    touchState.startX = event.touches[0].clientX;
    touchState.startY = event.touches[0].clientY;
    touchState.endX = null;
    touchState.endY = null;
    touchState.moves = 0;
  }, { passive: true });

  imageModal.addEventListener("touchmove", function(event) {
    if (!event.touches.length) {
      return;
    }
    event.preventDefault();
    touchState.endX = event.touches[0].clientX;
    touchState.endY = event.touches[0].clientY;
    touchState.moves += 1;
  }, { passive: false });

  imageModal.addEventListener("touchend", function() {
    if (
      touchState.startX === null
      || touchState.startY === null
      || touchState.endX === null
      || touchState.endY === null
      || touchState.moves < 3
    ) {
      resetTouchState();
      return;
    }

    const xDiff = touchState.startX - touchState.endX;
    const yDiff = touchState.startY - touchState.endY;

    if (Math.abs(yDiff) > Math.abs(xDiff)) {
      resetTouchState();
      return;
    }

    if (xDiff < 0) {
      showPreviousImage();
    } else if (xDiff > 0) {
      showNextImage();
    }

    resetTouchState();
  });
})();
