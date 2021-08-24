<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
    export const stepKey = {}
</script>

<script>
    import { writable } from "svelte/store"
    import { setContext } from "svelte"
    import Steps from "@/Components/sections/GestionClient/Create/Steps";
    import Etap1 from "@/Components/sections/GestionClient/Create/Etap1.svelte";
    import Etap2 from "@/Components/sections/GestionClient/Create/Etap2.svelte";
    import Etap3 from "@/Components/sections/GestionClient/Create/Etap3.svelte";
    import SaveBtn from "@/Components/sections/GestionClient/Create/SaveBtn.svelte";

    const components = [Etap1, Etap2, Etap3]
    let step = writable(0);

    setContext(stepKey, {
        step,
    })

    // handle errors
    export let errors = {};
    $: displayErrors = Object.keys(errors).map(key =>{
            let message = errors[key];
            return message.replace("personnelles.", "")
                .replace("vehicule.", "")
                .replace("contrat.", "")
        });

    function next() {
        if ($step < components.length) {
            $step = $step + 1;
        }
    }

    function previous() {
        if ($step > 0) {
            $step = $step - 1;
        }
    }
</script>

<div class="px-4 pb-10">
    <div class="sticky top-0 py-4 bg-white" style="z-index: 100;">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl">Ajouter Un Client</h2>
            <hr class="mt-2 mb-4"/>
        </div>
        <Steps />
    </div>

    {#if displayErrors?.length > 0}
        <div class="max-w-lg px-4 mx-auto mb-4">
            <ul class="p-4 bg-white rounded-lg">
                {#each displayErrors as err}
                    <li class="text-red-500">- {err}</li>
                {/each}
            </ul>
        </div>
    {/if}

    <div class="max-w-2xl px-20 py-4 mx-auto mt-1">
        <svelte:component this={components[$step] ?? components[$step - 1]} />
        <div class="flex justify-between">
            {#if $step > 0}
                <button on:click={previous} class="flex px-4 py-2 text-white bg-green-400 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Precedant
                </button>
            {/if}
            {#if $step < (components.length - 1)}
                <button on:click={next} class="justify-self-end flex px-4 py-2 text-white bg-green-400 rounded-md">
                    Suivant
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            {/if}
            {#if $step >= (components.length - 1)}
                <SaveBtn on:open={next} on:close={previous} />
            {/if}
        </div>
    </div>
</div>
