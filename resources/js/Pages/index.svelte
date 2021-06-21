<script>
import SalesCard from "@/Components/app/SalesCard.svelte";

    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    let name = "Index Page";

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

<Layout>
    <!-- <div>{name}</div>
    <div>paiementsTotal: {paiementsTotal} DH</div>
    <div>resiliationsTotal: {resiliationsTotal} DH</div>
    <div>chargesTotal: {chargesTotal} DH</div>
    <div>contratsTotal: {contratsTotal} DH</div> -->

    <div class="p-4">
        <div class="grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
            <SalesCard label="Paiements" price={paiementsTotal} />
            <SalesCard label="Resiliations" price={resiliationsTotal} />
            <SalesCard label="Charges" price={chargesTotal} />
            <SalesCard label="Contrats" price={contratsTotal} />
            <SalesCard label="Revenu" price={revenu} />
        </div>
    </div>
</Layout>
