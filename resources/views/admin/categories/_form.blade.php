<div class="space-y-4">

    <div>
        <label class="block mb-1 font-medium">Name</label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $category->name ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
               required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Slug (auto-generated)</label>
        <input type="text" id="slug"
               value="{{ old('slug', $category->slug ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 bg-gray-100"
               readonly>
    </div>

    <div class="flex gap-3">
        <button type="submit"
                class="bg-[#ec1e20] text-white px-5 py-2 rounded-lg hover:opacity-90">
            {{ $buttonText }}
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="px-5 py-2 rounded-lg border">
            Cancel
        </a>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (!nameInput || !slugInput) return;

        nameInput.addEventListener('input', function () {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-');

            slugInput.value = '/'+slug;
        });

    });
</script>