<script>
import Steps from "@/Components/app/Steps.svelte";
import Etap1 from "@/Components/sections/GestionClient/Create/Etap1.svelte";
import Etap2 from "@/Components/sections/GestionClient/Create/Etap2.svelte";
import Etap3 from "@/Components/sections/GestionClient/Create/Etap3.svelte";
import Layout from "@/Pages/Layouts/AdminLayout.svelte"
import SaveBtn from "@/Components/sections/GestionClient/Create/SaveBtn.svelte";

const components = [Etap1, Etap2, Etap3]
let step = 0;

function next() {
    if (step < components.length) {
        step = step + 1;
    }
}

function previous() {
    if (step > 0) {
        step = step - 1;
    }
}

</script>
<Layout>
    <div class="p-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl">Ajouter Un Client</h2>
            <hr class="mt-2 mb-4"/>
        </div>
        <Steps step={step + 1} />

        <div class="max-w-2xl px-20 py-4 mx-auto mt-4">
            <svelte:component this={components[step] ?? components[step - 1]} />
            <div class="flex justify-between">
                {#if step > 0}
                    <button on:click={previous} class="flex px-4 py-2 text-white bg-green-400 rounded-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Precedant
                    </button>
                {/if}
                {#if step < (components.length - 1)}
                    <button on:click={next} class="flex px-4 py-2 text-white bg-green-400 rounded-md justify-self-end">
                        Suivant
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                {/if}
                {#if step === (components.length - 1)}
                    <SaveBtn />
                {/if}
            </div>
        </div>
    </div>
</Layout>
