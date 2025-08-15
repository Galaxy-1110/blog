// Cursor properties
let ccursor = {
	width: "20px",
	height: "20px",
	borderRadius: "100%",
};
let hoverTimeout;

export let isHovering = false;

export function setHovering(value) {
	isHovering = value;
}

export function getHovering() {
	return isHovering;
}

document.addEventListener("DOMContentLoaded", () => {
	// FOR BUTTONS
	let buttons = document.querySelectorAll("button");

	buttons.forEach((button) => {
		gsap.set(button, {
			scale: 1,
		});

		button.addEventListener("mouseenter", async (e) => {
			hoverTimeout = setTimeout(async () => {
				const buttonSize = button.getBoundingClientRect();
				const centerX = buttonSize.left + buttonSize.width / 2;
				const centerY = buttonSize.top + buttonSize.height / 2;

				gsap.to(cursor, {
					x: centerX,
					y: centerY,
					width: buttonSize.width,
					height: buttonSize.height,
					borderRadius: window.getComputedStyle(button).borderRadius,
					duration: 0.3,
					overwrite: "auto",
				});
				setHovering(true);
			}, 50);
		});

		button.addEventListener("mouseleave", (e) => {
			clearTimeout(hoverTimeout);
			setHovering(false);
			gsap.to(cursor, {
				width: ccursor.width,
				height: ccursor.height,
				borderRadius: ccursor.borderRadius,
				duration: 0,
				overwrite: "auto",
			});
			gsap.to(button, {
				scale: 1,
				duration: 0.2,
				overwrite: "auto",
			});
		});
		const tl = gsap.timeline({ defaults: { duration: 0.2, ease: "none" } });

		button.addEventListener("mousedown", (e) => {
			tl.pause(0).clear();
			tl.to(button, { scale: 0.95 }, 0).to(cursor, { scale: 0.95 }, 0).play();
		});

		button.addEventListener("mouseup", (e) => {
			tl.to(button, { scale: 1 }, 0).to(cursor, { scale: 1 }, 0).play();
			console.log("UP");
		});
	});

	// FOR LINKS
	let links = document.querySelectorAll("a.links");
	links.forEach((link) => {
		link.addEventListener("mouseenter", async (e) => {
			hoverTimeout = setTimeout(async () => {
				const linksize = link.getBoundingClientRect();
				const centerX = linksize.left + linksize.width / 2;
				const centerY = linksize.top + linksize.height / 2;

				gsap.to(cursor, {
					width: linksize.width + 8,
					height: linksize.height + 6,
					borderRadius: "8px",
					x: centerX,
					y: centerY,
					duration: 0.2,
					overwrite: "auto",
				});
				setHovering(true);
			}, 25);
		});

		link.addEventListener("mouseleave", (e) => {
			clearTimeout(hoverTimeout);
			setHovering(false);
			gsap.to(cursor, {
				borderRadius: ccursor.borderRadius,
				width: ccursor.width,
				height: ccursor.height,
				duration: 0.1,
				overwrite: "auto",
			});
		});
	});
});
