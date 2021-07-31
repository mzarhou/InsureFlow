<script>
    import { tweened } from "svelte/motion";
    import StepIcon from "./StepIcon.svelte"
    import { getContext } from "svelte"
    import { stepKey } from "@/Pages/GestionClient/Create.svelte"

    export let index; // index of this step (fixed) (0, 1, 2, ....)
    export let step; // object: step info (title icon ....)
    export let nbSteps;
    const { step: stepStore } = getContext(stepKey)
    export let width; // store

    let wdt;
    $: {
        let wt = $width - ((index + 1) * 100)
        if (wt > 100)
            wt = 100
        if (wt < 0)
            wt = 0;
        wdt = wt;
    }
</script>

<div style="width: {100 / nbSteps}%;">
    <div class="relative mb-2">
        {#if index !== 0}
            <div
                class="absolute flex items-center content-center align-middle align-center"
                style="width: calc(100% - 3.5rem); top: 50%; transform: translate(-50%, -50%)"
            >
                <div
                    class="items-center flex-1 w-full align-middle bg-gray-200 rounded align-center"
                >
                    <div
                        class="w-0 py-1 bg-green-400 rounded"
                        style={`width: ${wdt}%;`}
                    />
                </div>
            </div>
        {/if}

        <StepIcon on:click={() => $stepStore = index} errorKey={step?.key} full={wdt === 100} icon={step?.icon} />
    </div>

    <div class="text-xs text-center md:text-base">{step?.title}</div>
</div>
