<script>
    import { gsap } from "gsap";
    import { onMount } from "svelte";

    let show = true;
    let sidebarWidth = 0;
    let documentWidth = 0;

    onMount(() => {
        sidebarWidth = document
            .getElementsByClassName("sidebar")[0]
            .getBoundingClientRect().width;
        documentWidth = document.body.getBoundingClientRect().width;

        window.onresize = () => {
            documentWidth = document.body.getBoundingClientRect().width;
        };
    });

    function closeSidebar() {
        show = false;
        gsap.to(".sidebar", { x: -sidebarWidth, width: 0, duration: 0.3 });
    }

    function openSidebar() {
        show = true;
        gsap.to(".sidebar", { x: 0, width: sidebarWidth, duration: 0.3 });
    }

    // handle lef margin for containers
    $: {
        if (document) {
            let elements = document.querySelectorAll("body .mrg-left");
            elements.forEach((el) => {
                if (show) {
                    el.classList.remove("ml-10");
                } else {
                    el.classList.add("ml-10");
                }
            });
        }
    }
</script>

<slot {show} {openSidebar} {closeSidebar} />
