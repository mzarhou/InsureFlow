<script>
    import { tweened } from "svelte/motion";

    export let index;
    export let currentStep;
    export let step;
    export let nbSteps;

    const duration = 350;
    const width = tweened(0, {
        duration,
    });

    $: {
        setTimeout(
            () => {
                if (index <= currentStep - 1) width.set(100);
                else if (index === currentStep) width.set(30);
                else width.set(0);
            },
            index === currentStep ? duration : 0
        );
    }
</script>

<div style="width: {100 / nbSteps}%;">
    <div class="relative mb-2">
        {#if index !== 0}
            <div
                class="align-center absolute flex items-center content-center align-middle"
                style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)"
            >
                <div
                    class="align-center items-center flex-1 w-full align-middle bg-gray-200 rounded"
                >
                    <div
                        class="w-0 py-1 bg-green-400 rounded"
                        style={`width: ${$width}%;`}
                    />
                </div>
            </div>
        {/if}

        <div
            class={`${ $width === 100
                ? 'bg-green-400'
                : 'bg-gray-300'} flex items-center w-10 h-10 mx-auto text-lg text-white rounded-full`}
        >
            <span class="w-full p-1 text-center text-white">
                {@html step?.icon}
            </span>
        </div>
    </div>

    <div class="md:text-base text-xs text-center">{step?.title}</div>
</div>
