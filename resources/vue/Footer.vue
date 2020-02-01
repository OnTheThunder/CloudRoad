<template>
    <footer class="container-fluid text-small bg-color-header d-none d-sm-block">
        <!-- Footer Links -->
        <div class="row d-flex align-items-center h-100">
            <!-- Copyright -->
            <p class="offset-md-2 col-3 col-md-2 ml-1 mb-0 text-nowrap">CloudRoad</p>
            <img id="img-footer" :src="logo" alt="img-equipo"
                 class="offset-4 col-2img-fluid mb-0 mr-3 figure-img rounded-circle">
            <span>© 2020 OnTheThunder: </span>
            <a class="text-dark ml-2" href="https://github.com/OnTheThunder/CloudRoad">
                <i class="fab fa-github-square"></i>
            </a>
        </div>
    </footer>
</template>

<script>
    export default {
        props: ['logo'],
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>
