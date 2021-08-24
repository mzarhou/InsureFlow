<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
</script>

<script>
    import ContratSection from "@/Components/sections/GestionClient/Show/ContratSection.svelte"
    import InfoPersonnelles from "@/Components/sections/GestionClient/Show/InfoPersonnelles.svelte"
    import VehiculesSection from "@/Components/sections/GestionClient/Show/VehiculesSection.svelte"

    export let client;
</script>

<main class="p-4">
    <div class="max-w-screen-md mx-auto">
        <InfoPersonnelles client={client} />
        <VehiculesSection vehicules={client.vehicules} />
        <ContratSection contrats={client.contrats}/>
    </div>
</main>
