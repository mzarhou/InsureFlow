<script>
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    import { inertia } from "@inertiajs/inertia-svelte"
    import { Inertia } from "@inertiajs/inertia"

    export let client;
</script>

<Layout>
    <main class="p-4">
        <div>{client.nom}</div>
    </main>
</Layout>
