{#if links.length > 3}
<div class="flex justify-center">
    <div class="flex flex-wrap mx-auto mt-4 -mb-1">
    {#each links as link}
        {#if link.url === null}
            <div class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded">
                {@html link.label}
            </div>
        {:else}
            <a use:inertia={{ preserveScroll: true }} href={link.url} class="{  link.active && 'bg-blue-700 text-white' } px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500">
                {@html link.label}
            </a>
        {/if}
    {/each}
    </div>
</div>
{/if}

<script>
    import { inertia } from "@inertiajs/inertia-svelte"
    export let links = [];
</script>
