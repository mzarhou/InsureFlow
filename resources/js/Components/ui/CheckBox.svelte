<script>
    export let checked = false;
    export let label = ""
</script>


<!-- component -->
<span class="inline-flex items-start justify-start">
    <label for="check-box" class="select-none">{label}</label>
    <div class="flex relative items-center justify-center flex-shrink-0 w-6 h-6 ml-2 bg-white border-2 rounded {checked ? 'border-indigo-500' : 'border-gray-400'}">
        <input id="check-box" bind:checked type="checkbox" class="absolute inset-0 w-full h-full opacity-0">
        <svg class="hidden w-4 h-4 text-indigo-500 pointer-events-none fill-current" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
    </div>
</span>

<style>
    input:checked + svg {
        display: block;
    }
</style>
