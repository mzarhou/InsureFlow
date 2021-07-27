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
</script>

<slot {show} {openSidebar} {closeSidebar} />
