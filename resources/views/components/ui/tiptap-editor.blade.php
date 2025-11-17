@props([
'uniqueId' => 'editor',
])

<div x-data="tiptapEditor('{{ $uniqueId }}', '')" x-init="$watch('$root.content', (value) => { if (editor && value !== editor.getHTML()) { editor.commands.setContent(value); } })">
    <!-- Toolbar -->
    <div class="tiptap-toolbar">
        <template x-if="editor">
            <div class="tiptap-toolbar-inner">
                <!-- Text Formatting -->
                <button type="button" @click="editor.chain().focus().toggleBold().run()" :class="editor.isActive('bold') ? 'active' : ''" class="tiptap-btn" title="Bold">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 4v12h4.5a3.5 3.5 0 001.838-6.478A3.5 3.5 0 0010.5 4H6zm2 2h2.5a1.5 1.5 0 010 3H8V6zm0 5h3.5a1.5 1.5 0 010 3H8v-3z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleItalic().run()" :class="editor.isActive('italic') ? 'active' : ''" class="tiptap-btn" title="Italic">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 4v2h1.586l-3 9H7v2h6v-2h-1.586l3-9H16V4h-6z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleUnderline().run()" :class="editor.isActive('underline') ? 'active' : ''" class="tiptap-btn" title="Underline">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 3v7a4 4 0 008 0V3h-2v7a2 2 0 11-4 0V3H6zm-2 14h12v2H4v-2z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleStrike().run()" :class="editor.isActive('strike') ? 'active' : ''" class="tiptap-btn" title="Strikethrough">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 4a3 3 0 00-3 3v1H5V7a5 5 0 0110 0v1h-2V7a3 3 0 00-3-3zm-7 7h14v2H3v-2zm4 4h6a1 1 0 110 2H7a1 1 0 110-2z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleHighlight().run()" :class="editor.isActive('highlight') ? 'active' : ''" class="tiptap-btn" title="Highlight">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </button>

                <div class="tiptap-divider"></div>

                <!-- Headings -->
                <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="editor.isActive('heading', { level: 1 }) ? 'active' : ''" class="tiptap-btn tiptap-btn-text" title="Heading 1">H1</button>
                <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="editor.isActive('heading', { level: 2 }) ? 'active' : ''" class="tiptap-btn tiptap-btn-text" title="Heading 2">H2</button>
                <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="editor.isActive('heading', { level: 3 }) ? 'active' : ''" class="tiptap-btn tiptap-btn-text" title="Heading 3">H3</button>

                <div class="tiptap-divider"></div>

                <!-- Lists -->
                <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="editor.isActive('bulletList') ? 'active' : ''" class="tiptap-btn" title="Bullet List">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="editor.isActive('orderedList') ? 'active' : ''" class="tiptap-btn" title="Numbered List">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4h1v1H3V4zm3 0h11a1 1 0 110 2H6a1 1 0 110-2zM3 9h1v1H3V9zm3 0h11a1 1 0 110 2H6a1 1 0 110-2zM3 14h1v1H3v-1zm3 0h11a1 1 0 110 2H6a1 1 0 110-2z" />
                    </svg>
                </button>

                <div class="tiptap-divider"></div>

                <!-- Alignment -->
                <button type="button" @click="editor.chain().focus().setTextAlign('left').run()" :class="editor.isActive({ textAlign: 'left' }) ? 'active' : ''" class="tiptap-btn" title="Align Left">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4h14v2H3V4zm0 5h10v2H3V9zm0 5h14v2H3v-2z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().setTextAlign('center').run()" :class="editor.isActive({ textAlign: 'center' }) ? 'active' : ''" class="tiptap-btn" title="Align Center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4h14v2H3V4zm4 5h6v2H7V9zm-4 5h14v2H3v-2z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().setTextAlign('right').run()" :class="editor.isActive({ textAlign: 'right' }) ? 'active' : ''" class="tiptap-btn" title="Align Right">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4h14v2H3V4zm4 5h10v2H7V9zm-4 5h14v2H3v-2z" />
                    </svg>
                </button>

                <div class="tiptap-divider"></div>

                <!-- Code & Quote -->
                <button type="button" @click="editor.chain().focus().toggleCode().run()" :class="editor.isActive('code') ? 'active' : ''" class="tiptap-btn" title="Inline Code">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()" :class="editor.isActive('codeBlock') ? 'active' : ''" class="tiptap-btn tiptap-btn-text" title="Code Block">{ }</button>
                <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="editor.isActive('blockquote') ? 'active' : ''" class="tiptap-btn" title="Quote">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>

                <div class="tiptap-divider"></div>

                <!-- Horizontal Rule -->
                <button type="button" @click="editor.chain().focus().setHorizontalRule().run()" class="tiptap-btn" title="Horizontal Line">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 10h14v2H3v-2z" />
                    </svg>
                </button>

                <div class="tiptap-divider"></div>

                <!-- Undo/Redo -->
                <button type="button" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().undo()" class="tiptap-btn" title="Undo">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.445 14.832A1 1 0 0010 14v-2.798l5.445 3.63A1 1 0 0017 14V6a1 1 0 00-1.555-.832L10 8.798V6a1 1 0 00-1.555-.832l-6 4a1 1 0 000 1.664l6 4z" />
                    </svg>
                </button>
                <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor.can().redo()" class="tiptap-btn" title="Redo">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11.555 14.832A1 1 0 0110 14v-2.798l-5.445 3.63A1 1 0 013 14V6a1 1 0 011.555-.832L10 8.798V6a1 1 0 011.555-.832l6 4a1 1 0 010 1.664l-6 4z" />
                    </svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Editor Content Area -->
    <div
        :id="'tiptap-editor-' + uniqueId"
        class="tiptap-content"></div>
</div>
