<script>
    import { onMount } from "svelte";
    import { fade } from "svelte/transition"

    export let show = false;
    let triggerParent = null;


    onMount(() => {
        if (triggerParent?.firstChild) {
            const showModal = () => show = true;
            triggerParent?.firstChild?.addEventListener("click", showModal);
            return () => triggerParent?.firstChild?.removeEventListener("click", showModal)
        }
    })
</script>

<div bind:this={triggerParent} class="inline-block">
    <slot name="trigger" />
</div>
{#if show}
<div class="absolute inset-0 z-50" transition:fade={{ duration: 100 }}>
    <div class="grid h-screen bg-gray-400 opacity-40 place-content-center" on:click={() => show = false}></div>
    <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <slot />
    </div>
    <button on:click={() => show = false} class="absolute top-0 right-0 mt-4 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
{/if}
