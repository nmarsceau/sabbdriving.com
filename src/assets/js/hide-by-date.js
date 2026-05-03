class HideByDate extends HTMLElement {
	static get observedAttributes() {
		return ["timestamp"];
	}

	connectedCallback() {
		this.applyVisibility();
	}

	attributeChangedCallback() {
		if (this.isConnected) {
			this.applyVisibility();
		}
	}

	applyVisibility() {
		const timestamp = this.getAttribute("timestamp");

		// No timestamp means always show content.
		if (!timestamp) {
			return;
		}

		const targetTime = Date.parse(timestamp);

		if (Number.isNaN(targetTime)) {
			console.warn(
				`<hide-by-date> received an invalid timestamp: "${timestamp}". Expected format: YYYY-MM-DDTHH:MM:SSZ`
			);
			return;
		}

		if (Date.now() > targetTime) {
			this.replaceChildren();
		}
	}
}

if (!customElements.get("hide-by-date")) {
	customElements.define("hide-by-date", HideByDate);
}
