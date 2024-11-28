import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');
    if (editorElement) {
        ClassicEditor
            .create(editorElement, {
                toolbar: [
                    'heading', '|', 'Bold', 'Italic', 'Link', 'blockQuote'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    }
});
