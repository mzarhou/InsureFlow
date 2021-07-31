<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    export let contrat;

    let showModal = false;

    let form = useForm({
        montant: "",
        montant_total: undefined,
        contrat_id: contrat.id,
    })

    $: hasCredit = (contrat.credit != null) && (contrat.credit.completed == null)
    $: montant_restant = contrat.montant_total - contrat.credit?.paiements.reduce((sum, paiement) => sum += paiement.montant, 0)

    $: {
        if (hasCredit && $form.montant_total) {
            $form.montant = $form.montant_total - montant_restant;
        }
    }

    function resilier() {
        $form.post(route("resiliation.store"));
    }
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
                <input
                    bind:value={$form.montant_total} type="text" placeholder="Montant Total (DH)"
                    class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md"
                    class:border-red-500={$form.errors.montant_total}
                />
                {#if $form.errors.montant_total}
                    <p class="ml-1 text-sm text-red-500">{$form.errors.montant}</p>
                {/if}
            {/if}
            <input
                bind:value={$form.montant} type="text" placeholder="Montant (DH)"
                class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md"
                class:border-red-500={$form.errors.montant}
                disabled={hasCredit}
            />
            {#if $form.errors.montant}
                <p class="ml-1 text-sm text-red-500">{$form.errors.montant}</p>
            {/if}
            <div class="flex justify-end">
                <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">Resilier</button>
            </div>
        </form>
    </div>
</Modal>
