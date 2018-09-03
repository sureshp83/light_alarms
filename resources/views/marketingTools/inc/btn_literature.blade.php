<label class="img-checkbox">
    <input
        type="checkbox"
        name="literatures[]"
        id="{{ $id }}"
        value="{{ $id }}"
        autocomplete="off"
        {{ in_array($id, old('literatures', [])) ? 'checked' : '' }}
    >
    <img src="{{ asset('/img/'.$img) }}"
        class="img-thumbnail"
        v-b-tooltip.hover title="{{ $name }}"
        >
</label>
