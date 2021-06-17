<script>
import Dropdown from "@/Components/app/Dropdown.svelte";
import { fade } from "svelte/transition"
import { clientInfo } from "@/store/client"

let options = [
    {
        text: "Diesel",
        selected: false,
    },
    {
        text: "Essance",
        selected: false,
    },
    {
        text: "Gaz",
        selected: false,
    },
]
</script>

<div transition:fade={{ duration: 200 }}>
    <Dropdown bind:selectedValue={$clientInfo.vehicule.puissance_energie} bind:options placeHolder="Puissance energie" className="mb-4" />
    <input bind:value={$clientInfo.vehicule.numero_immatriculation} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Numero d'immatriculation" />
    <input bind:value={$clientInfo.vehicule.marque_type} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Marque et type" />
    <input bind:value={$clientInfo.vehicule.type_carrosserie} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Type de carrosserie" />
    <input bind:value={$clientInfo.vehicule.poids_total_en_charge} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Poids total en charge" />
    <input bind:value={$clientInfo.vehicule.date_1er_mise_en} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Date 1er mise en" />
    <input bind:value={$clientInfo.vehicule.usage} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Usage: exp: C1X" />
    <input bind:value={$clientInfo.vehicule.cylindree} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Cylindree" />
    <input bind:value={$clientInfo.vehicule.remorques} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Remorques" />
</div>
