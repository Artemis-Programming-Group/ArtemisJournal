import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Swal from 'sweetalert2'
import './alpine-main.js';
import Clipboard from '@ryangjchandler/alpine-clipboard'

import { tiptapEditor, textEditorManager } from './tiptap-editor';

Alpine.data('tiptapEditor', tiptapEditor);
Alpine.data('textEditorManager', textEditorManager);

window.Swal = Swal;
window.tiptapEditor = tiptapEditor;
window.textEditorManager = textEditorManager;



Alpine.plugin(Clipboard)
Livewire.start()
