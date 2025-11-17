import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Highlight from '@tiptap/extension-highlight';
import TextAlign from '@tiptap/extension-text-align';
import Underline from '@tiptap/extension-underline';
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight';

// Import lowlight correctly
import { createLowlight, common } from 'lowlight';

// Create lowlight instance
const lowlight = createLowlight(common);

// Store editor instances to prevent duplicates
const editorInstances = new Map();

// TipTap Editor Alpine Component
export function tiptapEditor(uniqueId, initialContent) {
    return {
        editor: null,
        uniqueId: uniqueId,

        init() {
            console.log('TipTap init:', { uniqueId, initialContent });
            // Wait for next tick to ensure parent is ready
            this.$nextTick(() => {
                // Get initial content from parent if available
                const parentContent = this.$root?.content || initialContent || '';
                console.log('Initializing editor with content:', parentContent?.substring(0, 50));
                this.initEditor(parentContent);
            });

            // Cleanup on component destroy
            this.$el.addEventListener('alpine:unmount', () => {
                this.destroy();
            });
        },

        initEditor(content) {
            const element = document.getElementById('tiptap-editor-' + this.uniqueId);
            console.log('Editor element:', element);

            if (!element) {
                console.error('TipTap editor element not found!');
                return;
            }

            // If editor already exists and is active, just update content
            if (this.editor && !this.editor.isDestroyed) {
                console.log('Editor already exists, updating content');
                this.editor.commands.setContent(content || '<p></p>');
                return;
            }

            // Destroy existing editor for this instance
            if (editorInstances.has(this.uniqueId)) {
                console.log('Destroying existing editor instance');
                const oldEditor = editorInstances.get(this.uniqueId);
                if (oldEditor && !oldEditor.isDestroyed) {
                    oldEditor.destroy();
                }
                editorInstances.delete(this.uniqueId);
            }

            console.log('Creating new TipTap editor instance');

            try {
                this.editor = new Editor({
                    element: element,
                    extensions: [
                        StarterKit.configure({
                            codeBlock: false, // We're using CodeBlockLowlight instead
                        }),
                        CodeBlockLowlight.configure({
                            lowlight,
                            defaultLanguage: 'javascript',
                        }),
                        Highlight,
                        TextAlign.configure({
                            types: ['heading', 'paragraph'],
                        }),
                        Underline,
                    ],
                    content: content || '<p></p>',
                    editorProps: {
                        attributes: {
                            class: 'prose prose-sm max-w-none focus:outline-none',
                        },
                    },
                    onUpdate: ({ editor }) => {
                        // Update parent component content
                        if (this.$root?.updateContent) {
                            this.$root.updateContent(editor.getHTML());
                        }
                    },
                    onCreate: ({ editor }) => {
                        console.log('Editor created and ready');
                    },
                    onDestroy: () => {
                        console.log('Editor destroyed');
                    },
                });

                // Store editor instance
                editorInstances.set(this.uniqueId, this.editor);
                console.log('TipTap editor created successfully');
            } catch (error) {
                console.error('Error creating TipTap editor:', error);
            }
        },

        destroy() {
            console.log('Destroying editor:', this.uniqueId);
            if (this.editor) {
                this.editor.destroy();
                this.editor = null;
            }
            if (editorInstances.has(this.uniqueId)) {
                editorInstances.delete(this.uniqueId);
            }
        },
    };
}

// Text Editor Manager Alpine Component
export function textEditorManager(uniqueId, defaultEditor, initialContent) {
    return {
        activeEditor: defaultEditor,
        content: initialContent || '',
        uniqueId: uniqueId,
        editorReady: false,

        init() {
            console.log('Manager init:', { uniqueId, defaultEditor, initialContent: this.content });

            // Initialize TipTap if it's the default editor
            if (this.activeEditor === 'tiptap') {
                this.$nextTick(() => {
                    this.editorReady = true;
                });
            }
        },

        switchEditor(type) {
            console.log('Switching to:', type);
            this.activeEditor = type;

            if (type === 'tiptap') {
                this.$nextTick(() => {
                    this.editorReady = true;
                    // Re-initialize TipTap editor when switching
                    const editorComponent = this.$el.querySelector('[x-data*="tiptapEditor"]');
                    if (editorComponent && editorComponent.__x) {
                        const editorData = editorComponent.__x.$data;
                        if (editorData.initEditor) {
                            editorData.initEditor(this.content);
                        }
                    }
                });
            } else {
                this.editorReady = false;
            }
        },

        updateContent(html) {
            console.log('Updating content:', html?.substring(0, 50));
            this.content = html;
            // Trigger Livewire update
            const textarea = document.getElementById('hidden-textarea-' + this.uniqueId);
            if (textarea) {
                textarea.value = this.content;
                textarea.dispatchEvent(new Event('input', { bubbles: true }));
            }
        },
    };
}
