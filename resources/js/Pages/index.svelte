<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
</script>

<script>
    import SalesCard from "@/Components/app/SalesCard.svelte";

    export let contrats = [];
    export let charges = [];
    export let resiliations = [];
    export let paiements = [];

    $: paiementsTotal = paiements.reduce((sum, paiement) => sum += paiement.montant, 0);
    $: resiliationsTotal = resiliations.reduce((sum, resiliation) => sum += resiliation.montant, 0);
    $: chargesTotal = charges.reduce((sum, charge) => sum += charge.montant, 0);
    $: contratsTotal = contrats.reduce((sum, contrat) => sum += contrat.montant_total, 0);

    $: revenu = contratsTotal + paiementsTotal - resiliationsTotal - chargesTotal;
</script>

<div class="mrg-left px-4 py-8">
    <div class="text-2xl text-gray-700">Les statistiques du mois</div>
    <hr class="mt-2" />
    <div class="lg:grid-cols-2 xl:grid-cols-3 grid gap-4 mt-6">
        <SalesCard label="Paiements" price={paiementsTotal} />
        <SalesCard label="Resiliations" price={resiliationsTotal} />
        <SalesCard label="Charges" price={chargesTotal} />
        <SalesCard label="Contrats" price={contratsTotal} />
        <SalesCard label="Revenu" price={revenu} />
    </div>
</div>
