<script>
    let name = "Elyamani"

    function ch () {
        name = name === "Jamal" ? "Elyamani" : "Jamal";
    }
</script>


<div class="text-red-500 text-center mt-4">{name}</div>

<button on:click={ch}>change</button>
