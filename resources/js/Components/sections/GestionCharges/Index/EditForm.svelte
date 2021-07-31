<script>
import Modal from "@/Components/app/Modal.svelte";
import { useForm } from "@inertiajs/inertia-svelte"

export let charge;

$: form = useForm({
    montant: charge.montant,
    description: charge.description,
})

let show = false;
const onSuccess = () => show = false;
function modifier () {
    $form.put(route("gestion-charges.update", charge.id), {
         onSuccess
    });
}
</script>

<Modal bind:show>
    <button slot="trigger" class="text-green-500">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
    </button>
    <!-- form -->
    <div class="max-w-sm p-4 bg-white rounded-lg">
        <input bind:value={$form.montant} type="number" placeholder="Montant (DH)" class:!border-red-500={$form.errors.montant} class="w-full px-4 py-2 border border-gray-200 rounded-md" />
        {#if $form.errors.montant}
            <p class="ml-1 text-sm text-red-500">{$form.errors.montant}</p>
        {/if}
        <textarea bind:value={$form.description} type="text" placeholder="Description" class:!border-red-500={$form.errors.description} class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md"></textarea>
        {#if $form.errors.description}
            <p class="text-red-500">{$form.errors.description}</p>
        {/if}
        <div class="flex justify-end">
            <button on:click={modifier} class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">Modifier</button>
        </div>
    </div>
</Modal>
