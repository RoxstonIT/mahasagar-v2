console.log('APP JS LOADED');

import './bootstrap';
import { Editor } from '@tiptap/core'
import { Extension } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Image from '@tiptap/extension-image'
import Youtube from '@tiptap/extension-youtube'
import { Node } from '@tiptap/core'

// SweetAlert2 global configuration
import Swal from 'sweetalert2';
window.Swal = Swal;

// Initialize Lucide icons
import { createIcons, icons } from 'lucide';
createIcons({ icons });

// Initialize TipTap editor
document.addEventListener('DOMContentLoaded', () => {

    const editorElement = document.querySelector('#editor')
    const textarea = document.querySelector('#full_article')

    if (!editorElement || !textarea) return

    const CustomShortcuts = Extension.create({
        addKeyboardShortcuts() {
            return {

                'Mod-b': () => this.editor.chain().focus().toggleBold().run(),
                'Mod-i': () => this.editor.chain().focus().toggleItalic().run(),
                'Mod-1': () => this.editor.chain().focus().toggleHeading({ level: 1 }).run(),
                'Mod-2': () => this.editor.chain().focus().toggleHeading({ level: 2 }).run(),
                'Mod-l': () => this.editor.chain().focus().toggleBulletList().run(),

            }
        },
    })

    const Embed = Node.create({
        name: 'embed',

        group: 'block',

        atom: true,

        addAttributes() {
            return {
                src: {},
                width: { default: 640 },
                height: { default: 360 },
                frameborder: { default: 0 },
                allowfullscreen: { default: true },
            }
        },

        parseHTML() {
            return [
                {
                    tag: 'iframe',
                },
            ]
        },

        renderHTML({ HTMLAttributes }) {
            return ['iframe', HTMLAttributes]
        },
    })

    const editor = new Editor({
        extensions: [
            StarterKit,
            Image,
            Youtube.configure({
                width: 640,
                height: 360,
                controls: true,
            }),
            Embed,
            CustomShortcuts,
        ],
        content: textarea.value || '',
        onUpdate: ({ editor }) => {
            textarea.value = editor.getHTML()
            updateToolbar()
        },
    })

    editorElement.appendChild(editor.view.dom)

    // =========================
    // Toolbar Active State
    // =========================
    function updateToolbar() {

        document.querySelectorAll('[data-action]').forEach(button => {

            const action = button.getAttribute('data-action')

            let isActive = false

            switch (action) {

                case 'bold':
                    isActive = editor.isActive('bold')
                    break

                case 'italic':
                    isActive = editor.isActive('italic')
                    break

                case 'h1':
                    isActive = editor.isActive('heading', { level: 1 })
                    break

                case 'h2':
                    isActive = editor.isActive('heading', { level: 2 })
                    break

                case 'ul':
                    isActive = editor.isActive('bulletList')
                    break

                case 'ol':
                    isActive = editor.isActive('orderedList')
                    break

            }

            if (isActive) {
                button.classList.add('bg-[#ec1e20]', 'text-white')
            } else {
                button.classList.remove('bg-[#ec1e20]', 'text-white')
            }

        })

    }

    // =========================
    // Toolbar Actions
    // =========================
    document.querySelectorAll('[data-action]').forEach(button => {

        button.addEventListener('click', () => {

            const action = button.getAttribute('data-action')

            switch (action) {

                case 'bold':
                    editor.chain().focus().toggleBold().run()
                    break

                case 'italic':
                    editor.chain().focus().toggleItalic().run()
                    break

                case 'h1':
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                    break

                case 'h2':
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                    break

                case 'ul':
                    editor.chain().focus().toggleBulletList().run()
                    break

                case 'ol':
                    editor.chain().focus().toggleOrderedList().run()
                    break

                case 'image':
                    const input = document.createElement('input')
                    input.type = 'file'
                    input.accept = 'image/*'

                    input.onchange = async () => {

                        const file = input.files[0]
                        if (!file) return

                        const formData = new FormData()
                        formData.append('image', file)

                        try {
                            const response = await fetch('/admin/articles/upload-image', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: formData
                            })

                            const data = await response.json()

                            editor.chain().focus().setImage({ src: data.url }).run()

                        } catch (error) {
                            console.error('Upload failed', error)
                        }

                    }

                    input.click()
                    break

                case 'embed':

                    const embedUrl = prompt('Enter video URL (Vimeo or embed link)')
                    if (!embedUrl) return

                    let finalUrl = embedUrl

                    if (embedUrl.includes('vimeo.com')) {
                        const videoId = embedUrl.split('/').pop()
                        finalUrl = `https://player.vimeo.com/video/${videoId}`
                    }

                    editor.chain().focus().insertContent({
                        type: 'embed',
                        attrs: {
                            src: finalUrl,
                            width: 640,
                            height: 360,
                        }
                    }).run()

                    break

                case 'youtube':

                    const url = prompt('Enter YouTube URL')

                    if (!url) return

                    editor.chain().focus().setYoutubeVideo({
                        src: url,
                    }).run()

                    break

            }

            // 🔴 Important: instant UI update
            updateToolbar()

        })

    })

    // Initial state
    updateToolbar()

})