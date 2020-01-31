<template>
    <footer class="container-fluid text-small mt-5 pt-4 bg-secondary d-none d-sm-block">
        <!-- Footer Links -->
        <div class="row">
            <!-- Copyright -->
            <p class="offset-md-2 offset-1 col-3 col-md-2 text-nowrap">Road Tech Assistance SL</p>
            <img id="img-footer" :src="logo" alt="img-equipo"
                 class="offset-2 col-2img-fluid figure-img rounded-circle">
            <span>© 2020 OnTheThunder: </span>
            <a class="text-dark" href="https://github.com/OnTheThunder/CloudRoad">
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
