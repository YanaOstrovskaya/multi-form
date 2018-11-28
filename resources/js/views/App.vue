<template>
    <div class="row">
        <div class="col-md-3 bg-dark">
            <the-menu></the-menu>
        </div>
        
        <div class="col-md-9">
            <div class="container">
            <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import TheMenu from '../components/layouts/TheMenu';
export default {
    components:{
        TheMenu
    }
}
</script>

