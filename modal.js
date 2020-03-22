// https://bitsofco.de/accessible-modal-dialog/
// https://www.w3.org/TR/wai-aria-practices/examples/dialog-modal/dialog.html

class Modal {
	constructor (container) {
		this.container = container;
		this.modal = container.querySelector('.my-modal');
		this.close_button = this.modal.querySelector('button.my-modal-close');

		this.focusable_elements = this.modal.querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
		this.first_focusable_element = this.focusable_elements[0];
		this.last_focusable_element = this.focusable_elements[this.focusable_elements.length - 1];
		this.last_focused_element = null;

		this.modal.addEventListener('keydown', event => {this.handle_key_press(event);});
		this.close_button.addEventListener('click', () => {this.close();});
		this.container.addEventListener('click', event => {
			if(event.target === this.container) {this.close();}
		});
	}

	open() {
		console.log(document.activeElement);
		this.container.removeAttribute('hidden');
		this.last_focused_element = document.activeElement;
		this.first_focusable_element.focus();
	}

	close() {
		this.container.setAttribute('hidden', '');
		console.log(this.last_focused_element);
		this.last_focused_element.focus();
		this.last_focused_element = null;
	}

	handle_key_press(event) {
		const key_tab = 9;
		const key_esc = 27;
		switch (event.keyCode) {
			case key_tab:
				if (this.focusable_elements.length === 1) {
					event.preventDefault();
					break;
				}
				if (event.shiftKey) {
					if (document.activeElement === this.first_focusable_element) {
						event.preventDefault();
						this.last_focusable_element.focus();
					}
				}
				else {
					if (document.activeElement === this.last_focusable_element) {
						event.preventDefault();
						this.first_focusable_element.focus();
					}
				}
				break;
			case key_esc:
				this.close();
				break;
		}
	}
}
