<template>
    <div class="sidebar-wrapper">
        <router-link :to="getHomeUrl()" class="logo-route">
            <div class="logo-wrapper">
                <img src="../assets/images/logo.png" class="logo-img" alt="">
                <h2 class="title">IDSDP</h2>
            </div>
        </router-link>
        <div class="sidebar-navigation">
            <CollapseMenu :items="items" :open="true" :horizontal="horizontal" :sidebarGroupTitle="sidebarGroupTitle"/>
        </div>
    </div>
</template>
<script>
import CollapseMenu from './menus/CollapseMenu.vue'
import { mapGetters } from 'vuex'
import { EventBus } from '@/EventBusLayout'
export default {
    Name: 'Sidebar',
    props: ['name'],
    components: {
        CollapseMenu
    },
    data () {
        return {
        items: [],
        homeURL: { type: Object, default: () => ({ path: '/auth/dashboard' }) },
        logo: { type: String, default: require('../assets/images/logo.png') },
        horizontal: true,
        toggleButton: true,
        logoShow: true,
        onlyLogo: true,
        onlyLogoText: true,
        sidebarGroupTitle: true
        }
    },
    beforeMount () {
        /** This EventBus should emitted before loading menus of external panels
         * for those user whose profile not updated yet */
        EventBus.$on('RESET_EXTERNAL_MENUS', this.resetExternalMenus)
    },
    created () {
        if (this.authUser.user_type === 2) {
            this.getExternalUserMenus()
        } else {
            this.items = this.$store.state.Auth.activeMenus
        }
    },
    watch: {
        isInsidePanel: function (newVal) {
            if (newVal) {
                this.getExternalUserMenus()
            }
        }
    },
    computed: {
        // items: function () {
        //     return this.$store.state.Auth.activeMenus
        // },
        lang: function () {
            return this.$i18n.locale
        },
        ...mapGetters({
            authUser: 'Auth/authUser',
            isInsidePanel: 'ExternalUserService/isInsidePanel'
        })
    },
    methods: {
        getHomeUrl () {
            if (this.authUser.user_type === 1) {
                return '/auth/dashboard'
            } else {
                return '/external-user/panel'
            }
        },
        getExternalUserMenus () {
            const tmpRoutes = this.$store.state.ExternalUserService.externalMenus
            if (this.isInsidePanel || tmpRoutes.length > 0) {
                this.items = tmpRoutes
                this.$store.dispatch('Auth/setActiveMenus', tmpRoutes)
                this.$store.dispatch('ExternalUserService/isInsidePanel', false)
            } else {
                const commonRoutes = [
                    {
                        title: 'Profile',
                        title_bn: 'প্রোফাইল',
                        name: this.lang === 'en' ? 'Profile' : 'প্রোফাইল',
                        is_heading: false,
                        is_active: false,
                        link: '/external-user/profile',
                        class_name: '',
                        is_icon_class: true,
                        icon: 'ri-bank-line'
                    },
                    {
                        title: 'Panel',
                        title_bn: 'প্যানেল',
                        name: this.lang === 'en' ? 'Panel' : 'প্যানেল',
                        is_heading: false,
                        is_active: false,
                        link: '/external-user/panel',
                        class_name: '',
                        is_icon_class: true,
                        icon: 'ri-dashboard-line'
                    }
                ]
                this.items = commonRoutes
                this.$store.dispatch('Auth/setActiveMenus', commonRoutes)
            }
        },
        resetExternalMenus () {
            this.$store.dispatch('ExternalUserService/setExternalMenus', [])
            this.getExternalUserMenus()
        }
    }
}
</script>
