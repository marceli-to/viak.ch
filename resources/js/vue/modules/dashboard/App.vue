<template>
<div v-if="isLoaded">
  <header class="site-header">
    <div>
      <div class="sm:span-4">
        <a href="/dashboard">
          <icon-logo />
        </a>
        <div class="site-header__title sm:hide">
          <h1>Dashboard</h1>
        </div>
      </div>
      <div class="sm:span-8">
        <nav class="site-menu-dashboard js-menu">
          <div>
            <div class="site-menu__items">
              <ul>
                <li>
                  <router-link :to="{name: 'courses'}" :class="[isActive ? 'is-active' : '', '']">
                    Kurse
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'experts'}">
                    Experten
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'students'}">
                    Studenten
                  </router-link>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="" title="Profil">
                    <icon-profile />
                  </a>
                </li>
               <li>
                  <a href="/logout">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
       </div>
    </div>
  </header>
  <router-view></router-view>
</div>
</template>
<script>
import NProgress from 'nprogress';
import IconLogo from "@/shared/components/ui/icons/Logo.vue";
import IconProfile from "@/shared/components/ui/icons/Profile.vue";

export default {

  components: {
    NProgress,
    IconLogo,
    IconProfile,
  },

  data() {
    return {
      isLoaded: false,
      isActive: false,
    }
  },

  mounted() {
    this.fetchUser();
  },

  methods: {
    fetchUser() {
      if (!this.$store.state.user) {
        this.isLoaded = false;
        this.axios.get(`/api/user`).then(response => {
          this.$store.commit('user', response.data);
          this.isLoaded = true;
        });
      }
    },
  },
  watch: {
    '$route'() {

    }
  },
}
</script>