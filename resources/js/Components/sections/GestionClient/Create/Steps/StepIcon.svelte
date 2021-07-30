<script>
    import { page } from "@inertiajs/inertia-svelte"

    export let full = true;
    export let icon;
    export let errorKey;

    let hasError = false;
    $: {
        if (errorKey) {
            let keys = Object.keys($page.props.errors)
            for (let i = 0; i < keys.length; i++) {
                let key = keys[i];
                hasError = key?.startsWith(errorKey)
                if (key?.startsWith(errorKey)) {
                    break;
                }
            }
        }
    }
</script>
<button
    on:click
    class={`${ full
        ? 'bg-green-400'
        : 'bg-gray-300'} flex items-center w-10 h-10 mx-auto text-lg text-white rounded-full`}
>
    <span class="w-full p-1 text-center text-white">
        {@html icon}
    </span>
    {#if hasError}
        <span class="absolute top-0 right-0 flex w-3 h-3">
            <span class="absolute inline-flex w-full h-full bg-red-500 rounded-full opacity-75 animate-ping"></span>
            <span class="relative inline-flex w-3 h-3 bg-red-500 rounded-full"></span>
        </span>
    {/if}
</button>

<style>
    button {
        position: relative;
    }
</style>
