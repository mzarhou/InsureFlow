<script>
    import { fade } from "svelte/transition"

    import { clientInfo } from "@/store/client"
</script>

<div transition:fade={{ duration: 200 }}>
    <input bind:value={$clientInfo.personnelles.nom} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Nom" />
    <input bind:value={$clientInfo.personnelles.cin} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="CIN" />
    <input bind:value={$clientInfo.personnelles.tele} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Tele" />
    <input bind:value={$clientInfo.personnelles.addresse} class="w-full px-4 py-2 mb-6 border rounded-md" placeholder="Addresse" />
</div>
