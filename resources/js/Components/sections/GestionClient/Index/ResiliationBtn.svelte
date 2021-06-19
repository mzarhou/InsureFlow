<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    export let contrat;

    let showModal = false;

    let form = useForm({
        montant: "",
        montant_total: "",
        contrat_id: contrat.id,
    })

    function resilier() {
        $form.post(route("reliation.store"));
    }

    $: montant_restant = contrat.montant_total - contrat.credit?.paiements.reduce((sum, paiement) => sum += paiement.montant, 0)

    $: hasCredit = (contrat.credit != null) && (contrat.credit.completed == null)
</script>

<Modal bind:show={showModal}>
    <button slot="trigger" class="text-green-500">Resilier</button>
    <!-- form -->
    <div class="max-w-sm overflow-hidden bg-white rounded-lg">
        <form on:submit|preventDefault={resilier} class="p-4">
            <div class="flex">
                <span class="text-gray-600">Matricule:</span>
                <span class="ml-2 font-semibold text-gray-800">{contrat.vehicule.numero_immatriculation}</span>
            </div>
            {#if hasCredit}
                <div class="flex items-center mt-2 text-red-500">
                    <span>Montant Restant (credit): {montant_restant} DH</span>
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <input bind:value={$form.montant_total} type="number" placeholder="Montant Total (DH)" class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md" />
            {/if}
            <input bind:value={$form.montant} type="number" placeholder="Montant (DH)" class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md" />
            <div class="flex justify-end">
                <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">Resilier</button>
            </div>
        </form>
        {#if hasCredit}
        <div class="px-4 py-6 border-t-2 border-gray-200 bg-gray-50 sm:px-10">
            <p class="text-xs leading-5 text-gray-500">
                Montant: negative le
            </p>
        </div>
        {/if}
    </div>
</Modal>
