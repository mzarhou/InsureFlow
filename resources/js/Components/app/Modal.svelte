<script>
    import { onMount } from "svelte";
    import { fade } from "svelte/transition"
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();

    export let show = false;
    let triggerParent = null;

    function open() {
        show = true;
        dispatch("open");
    }

    function close() {
        show = false;
        dispatch("close");
    }

    onMount(() => {
        if (triggerParent?.firstChild) {
            triggerParent?.firstChild?.addEventListener("click", open);
            return () => triggerParent?.firstChild?.removeEventListener("click", open)
        }
    })
</script>

<div bind:this={triggerParent} class="inline-block">
    <slot name="trigger" />
</div>
{#if show}
<div class="absolute inset-0" style="z-index: 999" transition:fade={{ duration: 100 }}>
    <div class="opacity-40 place-content-center grid h-screen bg-gray-400" on:click={() => show = false}></div>
    <div class="top-1/2 left-1/2 absolute transform -translate-x-1/2 -translate-y-1/2">
        <slot {close} {open} />
    </div>
    <button on:click={() => show = false} class="absolute top-0 right-0 mt-4 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
{/if}
