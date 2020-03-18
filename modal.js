class Modal {
	constructor (modal) {
		this.modal = modal;
		this.modal.role = 'dialog';
		this.modal.addEventListener('keydown', () => {this.handle_key_press();});
		this.overlay = document.getElementById('modal-overlay') || this.create_overlay();
		this.overlay.addEventListener('click', () => {this.close();});
		let close_button = modal.querySelector('button.modal-close') || this.create_close_button();
		close_button.addEventListener('click', () => {this.close();});
		this.focusable_elements = this.modal.querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
		this.first_focusable_element = this.focusable_elements[0];
		this.last_focusable_element = this.focusable_elements[this.focusable_elements.length - 1];
		this.last_focused_element = null;
	}

	create_overlay() {
		const overlay = document.createElement('div');
		overlay.id = 'modal-overlay';
		overlay.classList.add('modal-overlay', 'hidden-all');
		overlay.tabindex = '-1';
		document.querySelector('body').appendChild(overlay);
		return document.getElementById('modal-overlay');
	}

	create_close_button() {
		const close_button = document.createElement('button');
		close_button.type = 'button';
		close_button['aria-label'] = 'Close';
		close_button.classList.add('modal-close');
		const close_icon = document.createElement('span');
		close_icon.classList.add('close-icon');
		close_icon['aria-hidden'] = 'true';
		close_icon.innerHTML = '&times;';
		close_button.appendChild(close_icon);
		this.modal.appendChild(close_button);
		return this.modal.querySelector('button.modal-close');
	}

	open() {
		this.overlay.classList.remove('hidden-all');
		this.modal.classList.remove('hidden-all');
		this.last_focused_element = document.activeElement;
		this.first_focusable_element.focus();
	}

	close() {
		this.overlay.classList.add('hidden-all');
		this.modal.classList.add('hidden-all');
		this.last_focused_element.focus();
		this.last_focused_element = null;
	}

	handle_key_press() {
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