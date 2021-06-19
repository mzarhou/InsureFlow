{#if links.length > 3}
<div class="flex justify-center">
    <div class="flex flex-wrap mx-auto mt-4 -mb-1">
    <!-- previous -->
    {#if firstLink.url === null}
        <div class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded cursor-not-allowed">
            {@html firstLink.label}
        </div>
    {:else}
        <a use:inertia={{ preserveScroll: true }} href={firstLink.url + searchPart} class="px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded">
            {@html firstLink.label}
        </a>
    {/if}

    {#each firstLinks as link}
        {#if link.url === null}
            <div class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded">
                {@html link.label}
            </div>
        {:else}
            <a use:inertia={{ preserveScroll: true }} href={link.url + searchPart} class="{  link.active && 'bg-indigo-600 text-white' } px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded">
                {@html link.label}
            </a>
        {/if}
    {/each}

    {#each lastLinks as link}
        {#if link.url === null}
            <div class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded">
                {@html link.label}
            </div>
        {:else}
            <a use:inertia={{ preserveScroll: true }} href={link.url + searchPart} class="{  link.active && 'bg-indigo-600 text-white' } px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded">
                {@html link.label}
            </a>
        {/if}
    {/each}

    <!-- next -->
    {#if lastLink.url === null}
        <div class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded cursor-not-allowed">
            {@html lastLink.label}
        </div>
    {:else}
        <a use:inertia={{ preserveScroll: true }} href={lastLink.url + searchPart} class="px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded">
            {@html lastLink.label}
        </a>
    {/if}
    </div>
</div>
{/if}

<script>
    import { inertia } from "@inertiajs/inertia-svelte"
    import { onMount } from "svelte";

    export let links = [];
    export let search;
    export let searched;

    $: firstLink = links[0];
    $: lastLink = links[links.length - 1];

    $: indexOfActiveLink = links.findIndex((link) => link.active);

    $: firstLinks = links.slice(indexOfActiveLink - 3 >= 1 ? indexOfActiveLink - 3 : 1, indexOfActiveLink + 1);
    $: lastLinks = links.slice(indexOfActiveLink + 1, indexOfActiveLink + 4 >= links.length ? links.length - 1 : indexOfActiveLink + 4);

    $: searchPart = search !== "" && searched ? "&search=" + search : "";
</script>
