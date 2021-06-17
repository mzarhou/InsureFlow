<script>
    import Dropdown from "@/Components/app/Dropdown.svelte";
    import { fade } from "svelte/transition"
    import { clientInfo } from "@/store/client"


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
</script>

<div transition:fade={{ duration: 200 }}>
    <Dropdown bind:selectedValue={$clientInfo.contrat.type_paiement} bind:options placeHolder="Type de paiement" className="mb-4" />
    <label for="du">Du:</label>
    <input type="date" bind:value={$clientInfo.contrat.du_date} id="du" class="w-full px-4 py-2 mb-3 border rounded-md" placeholder="du: 24/07/2021" />
    <label for="au">Au:</label>
    <input type="date" bind:value={$clientInfo.contrat.au_date} id="au" class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="au: 23/07/2022" />
</div>
