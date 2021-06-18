<script>
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    import ContratSection from "@/Components/sections/GestionClient/Show/ContratSection.svelte"
    import InfoPersonnelles from "@/Components/sections/GestionClient/Show/InfoPersonnelles.svelte"
    import VehiculesSection from "@/Components/sections/GestionClient/Show/VehiculesSection.svelte"

    export let client;
</script>

<Layout>
    <main class="p-4">
        <div class="max-w-2xl mx-auto">
            <InfoPersonnelles client={client} />
            <VehiculesSection vehicules={client.vehicules} />
            <ContratSection contrats={client.contrats}/>
        </div>
    </main>
</Layout>
