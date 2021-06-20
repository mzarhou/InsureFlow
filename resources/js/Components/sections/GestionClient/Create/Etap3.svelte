<script>
    import Dropdown from "@/Components/app/Dropdown.svelte";
    import { fade } from "svelte/transition"
    import { clientInfo } from "@/store/client"
    import TypePaiement from "@/Components/app/TypePaiement.svelte";


    let options = [
        {
            text: "Espece",
            selected: false,
        },
        {
            text: "Cheque",
            selected: false,
        },
        {
            text: "Credit",
            selected: false,
        },
        {
            text: "Virement",
            selected: false,
        },
    ]

    let montant_anticipe_type_paiement_options = ["Espece", "Cheque", "Virement"].map(item => ({
        text: item,
        selected: item === "Espece"
    }));
</script>

<div transition:fade={{ duration: 200 }}>
    <Dropdown bind:selectedValue={$clientInfo.contrat.type_paiement} bind:options placeHolder="Type de paiement" className="mb-4" />
    {#if $clientInfo.contrat.type_paiement === 'Credit'}
        <div class="flex items-center mb-4">
            <input type="number" bind:value={$clientInfo.contrat.montant_anticipe} placeHolder="Montant Anticipe" class="w-full px-4 py-2 border rounded-md" />
            <TypePaiement className="!mb-0 ml-2" bind:options={montant_anticipe_type_paiement_options} bind:selectedValue={$clientInfo.contrat.montant_anticipe_type_paiement} />
        </div>
    {/if}
    <input type="number" bind:value={$clientInfo.contrat.montant_total} id="montant_total" class="w-full px-4 py-2 mb-3 border rounded-md" placeholder="montant total" />
    <label for="du">Du:</label>
    <input type="date" bind:value={$clientInfo.contrat.du_date} id="du" class="w-full px-4 py-2 mb-3 border rounded-md" placeholder="du: 24/07/2021" />
    <label for="au">Au:</label>
    <input type="date" bind:value={$clientInfo.contrat.au_date} id="au" class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="au: 23/07/2022" />
</div>
