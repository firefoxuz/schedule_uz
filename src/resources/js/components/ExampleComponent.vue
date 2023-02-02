<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <router-link to="create">Navbar</router-link>
                    <router-link to="update">Navbar</router-link>
                    <router-view></router-view>
                    <div class="card-header">example</div>
                    <div class="card-body">I'm an example component.</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {

    },
};
</script>
