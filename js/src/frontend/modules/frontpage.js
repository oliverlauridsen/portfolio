projectFunctions.frontPage = projectFunctions.frontPage || {};

projectFunctions.frontPage.init = function () {
	if (window.location.href.indexOf("my-work") != -1) {
		(function () {
			let header = document.getElementById("header");
			(switchBtnn = header.querySelector("button.slider-switch")),
				(toggleBtnn = function () {
					if (slideshow.isFullscreen) {
						classie.add(switchBtnn, "view-maxi");
					} else {
						classie.remove(switchBtnn, "view-maxi");
					}
				}),
				(toggleCtrls = function () {
					if (!slideshow.isContent) {
						classie.add(header, "hide");
					}
				}),
				(toggleCompleteCtrls = function () {
					if (!slideshow.isContent) {
						classie.remove(header, "hide");
					}
				}),
				(slideshow = new DragSlideshow(
					document.getElementById("slideshow"),
					{
						// toggle between fullscreen and minimized slideshow
						onToggle: toggleBtnn,
						// toggle the main image and the content view
						onToggleContent: toggleCtrls,
						// toggle the main image and the content view (triggered after the animation ends)
						onToggleContentComplete: toggleCompleteCtrls,
					}
				)),
				(toggleSlideshow = function () {
					slideshow.toggle();
					toggleBtnn();
				});
			// toggle between fullscreen and small slideshow

			$(switchBtnn).click(function () {
				toggleSlideshow();
			});
			switchBtnn.addEventListener("click", toggleSlideshow);
		})();
	}

	if (window.location.href.indexOf("my-work") == -1) {
		$("html").on("mousewheel", function (e) {
			var delta = e.originalEvent.wheelDelta;

			if (delta < 0) {
				location.href = "http://localhost:8888/my-work";
			}
		});
	}
};
