<script>
    import { clickOutside } from "@/Actions/clickOutSide"
    import { fade } from 'svelte/transition'
    import { createEventDispatcher, onMount } from "svelte"

    const dispatch = createEventDispatcher();

    export let className;
    export let selectedValue;

    let open = false;

    export let placeHolder = "options";
    export let options = []

    $: selectedValue = options?.filter(o => o.selected)[0]?.text ?? selectedValue;

    function selectOption (option) {
        options = options.map(o => {
            o.selected = option.text === o.text
            return o;
        });
        open = false;
        dispatch('select', option?.text);
    }
</script>

<div use:clickOutside on:click_outside={() => open = false} class="relative block text-left {className}">
    <div>
        <button on:click={() => open = !open} type="button" class="inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
            <span class:text-gray-500={selectedValue == null}>{selectedValue || placeHolder}</span>
            <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </button>
    </div>

    {#if open}
    <div transition:fade={{ duration: 150 }} class="absolute inset-x-0 z-50 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            {#each options as option}
                <option on:click={() => selectOption(option)} selected={option.selected} class="block cursor-pointer px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900 {option.selected ? 'bg-gray-100 text-gray-900' : 'text-gray-700'}" tabindex="-1">{option.text}</option>
            {/each}
        </div>
    </div>
    {/if}
</div>
