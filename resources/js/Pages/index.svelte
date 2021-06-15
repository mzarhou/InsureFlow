<script>
    let name = "Elyamani"

    function ch () {
        name = name === "Jamal" ? "Elyamani" : "Jamal";
    }
</script>


<div class="test">{name}</div>

<button on:click={ch}>change</button>


<style>
.test {
    color: green;
}
</style>
